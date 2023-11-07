<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        if ($request->imageUpload) {
            
            //$path = $request->file('imageUpload')->store('images', 'public');
            $requestImage = $request->file('imageUpload');
            $img = Image::make($requestImage);

            $img->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
            });

            $name = $requestImage->hashName();
            $path = config('filesystems.disks.public.root') . '/images/' . $name;
            $img->save($path);
            Profile::updateOrCreate(
                ['user_id' => Auth::id()],
                ['imageUpload' => 'images/' . $name]
                );

            return back()->with('success', "Your image has been uploaded.");
            }
        return back()->with('error', 'Error al subir tu imagen');
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
    public function edit()
    {
        // Obtén el usuario actual
        $user = Auth::user();
    
        // Puedes cargar el perfil relacionado si es necesario
        $profile = $user->profile;
    
        return view('profile.edit', compact('user', 'profile'));
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
