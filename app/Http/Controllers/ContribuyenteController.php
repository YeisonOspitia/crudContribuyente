<?php

namespace App\Http\Controllers;

use App\Models\Contribuyente; // Asegúrate de importar el modelo
use Illuminate\Http\Request;

class ContribuyenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contribuyentes = Contribuyente::all();
        return view('contribuyentes.index', compact('contribuyentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contribuyentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Contribuyente::create($request->all());
        return redirect()->route('contribuyentes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('contribuyentes.show', compact('contribuyente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('contribuyentes.edit', compact('contribuyente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contribuyente->update($request->all());
        return redirect()->route('contribuyentes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contribuyente->delete();
        return redirect()->route('contribuyentes.index');
    }
}
