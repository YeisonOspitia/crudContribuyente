<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\EmailValidator;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileUpdateRequest $request)
    {
        if (!EmailValidator::isValidEmail($request->email)) {
            return response()->json([
                'success' => false,
                'message' => 'El correo electrónico no es válido.',
            ]);
        }
        $data = $this->processRequestData($request);

        $data['password'] = Hash::make($request['password']);
        $user = User::create($data);
       

        if ($user) {
            $role = Role::findOrFail($request->role_id);
            $user->assignRole($role->name);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado con éxito.',
                'data' => $request->all()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario.',
            ], 500);
        }
    }



    public function update(ProfileUpdateRequest $request, string $id)
    {
        if (!EmailValidator::isValidEmail($request->email)) {
            return response()->json([
                'success' => false,
                'message' => 'El correo electrónico no es válido.',
            ]);
        }
        $data = $this->processRequestData($request);
        
        $usuario = User::findOrFail($id);
        $role = Role::findOrFail($request->role_id);

        if ($usuario && $role) {
            $usuario->update($data);
            $usuario->syncRoles($role->name);

            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado con éxito.',
                'data' => $request->all()
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Usuario o rol no encontrado no encontrado.',
        ], 404);

    }


    public function destroy(string $id)
    {
        $User = User::find($id);
        if ($User) {
            $User->delete();
        }
        return redirect()->route('usuarios');
    }

     /**
     * Process request data for storing or updating a contribuyente.
     */
    private function processRequestData(ProfileUpdateRequest $request)
    {
        return [
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
        ];
    }
}
