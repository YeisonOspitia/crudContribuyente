<?php

namespace App\Http\Controllers;

use App\Models\Contribuyente; 
use App\Http\Requests\StoreContribuyenteRequest;
use Illuminate\Http\Request;
use App\Helpers\EmailValidator;
use App\Helpers\LetterCounter;

class ContribuyenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contribuyente::query();

        // Aplicar filtros si existen
        if ($request->filled('tipo_documento')) {
            $query->where('tipo_documento', $request->tipo_documento);
        }

        if ($request->filled('documento')) {
            $query->where('documento', 'like', '%' . $request->documento . '%');
        }

        if ($request->filled('nombre')) {
            $query->where('nombre_completo', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('telefono')) {
            $query->where('telefono', 'like', '%' . $request->telefono . '%');
        }

        $contribuyentes = $query->get();

        return view('contribuyentes.index', compact('contribuyentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = auth()->user()->name; 
        return view('contribuyentes.create', compact('usuario'));
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contribuyente = Contribuyente::find($id);
        // Combinar nombres y apellidos y contar letras
        $letterCounts = LetterCounter::countLetters($contribuyente->nombre_completo);
        if (!$contribuyente) {
            return redirect()->route('home');
        }
        return view('contribuyentes.show',compact('contribuyente', 'letterCounts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = auth()->user()->name;
        $contribuyente = Contribuyente::find($id);
        if (!$contribuyente) {
            return redirect()->route('home');
        }
        return view('contribuyentes.edit', compact(['contribuyente', 'usuario']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContribuyenteRequest $request)
    {
        if (!EmailValidator::isValidEmail($request->email)) {
            return response()->json([
                'success' => false,
                'message' => 'El correo electrónico no es válido.',
            ]);
        }

        $data = $this->processRequestData($request);

        $contribuyente = Contribuyente::create($data);

        if ($contribuyente) {
            return response()->json([
                'success' => true,
                'message' => 'Contribuyente creado con éxito.',
                'data' => $request->all()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el contribuyente.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContribuyenteRequest $request, string $id)
    {   
        if (!EmailValidator::isValidEmail($request->email)) {
            return response()->json([
                'success' => false,
                'message' => 'El correo electrónico no es válido.',
            ]);
        }

        $contribuyente = Contribuyente::find($id);
        if ($contribuyente) {
            $data = $this->processRequestData($request);

            $contribuyente->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Contribuyente actualizado con éxito.',
                'data' => $request->all()
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Contribuyente no encontrado.',
        ], 404);
    }

    /**
     * Process request data for storing or updating a contribuyente.
     */
    private function processRequestData(StoreContribuyenteRequest $request)
    {
        if ($request->tipo_documento === 'NIT') {
            // Dividir la razón social por espacios
            $nombre_completo = $request->validated('razon_social');
            $partes = explode(' ', $nombre_completo);

            if (count($partes) > 2) {
                // Asignar las primeras palabras a nombres y las últimas dos a apellidos
                $nombres = implode(' ', array_slice($partes, 0, count($partes) - 2));
                $apellidos = implode(' ', array_slice($partes, -2));
            } else {
                // Manejo en caso de tener menos de 3 palabras
                $nombres = $partes[0];
                $apellidos = isset($partes[1]) ? $partes[1] : '';
            }
        } else {
            // Manejo estándar para CC
            $nombres = $request->nombres;
            $apellidos = $request->apellidos;
        }

        $nombre_completo = $nombres . ' ' . $apellidos;
        return [
            'tipo_documento' => $request->validated('tipo_documento'),
            'documento' => $request->validated('documento'),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'nombre_completo' => $nombre_completo,
            'direccion' => $request->validated('direccion'),
            'telefono' => $request->validated('telefono'),
            'celular' => $request->validated('celular'),
            'email' => $request->validated('email'),
            'usuario' => auth()->user()->name,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contribuyente = Contribuyente::find($id);
        if ($contribuyente) {
            $contribuyente->delete();
        }
        return redirect()->route('home');
    }
}
