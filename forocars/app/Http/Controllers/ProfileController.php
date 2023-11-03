<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'imageUpload' => ['required','file', 'image', 'max:200'],
        ], 
        [
            'imageUpload.required' => 'Debes seleccionar un archivo.',
            'imageUpload.file' => 'El archivo debe ser un archivo válido.',
            'imageUpload.image' => 'El archivo debe ser una imagen.',
            'imageUpload.max' => 'El archivo no debe ser mayor de 200KB.',
        ]);
        return redirect()->route('profile.edit')->with('success', 'Archivo subido exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
