<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\CommunityLink;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityLinkForm;
use Illuminate\Support\Facades\Auth;

class CommunityLinkControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Búsqueda por variable text en la URL
        if ($request->has('text')) {
            $text = $request->input('text');
            $links = CommunityLink::where('url', 'like', "%$text%")->get();
            return response()->json(['Links' => $links], 200);
        }

        // Obtener los más populares
        if ($request->has('popular')) {
            $links = CommunityLink::withCount('users')->orderBy('users_count', 'desc')->get();
            return response()->json(['Links' => $links], 200);
        }

        // Obtener todos los links
        $links = CommunityLink::all();

        return response()->json(['Links' => $links], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityLinkForm $request)
    {
        // Validar los datos utilizando la request (CommunityLinkForm)
    
    
        // Obtener si el usuario está aprobado
        $approved = Auth::user()->isTrusted();
    
        // Añadir el user_id y el estado de aprobación a los datos
        $data['user_id'] = Auth::id();
        $data['approved'] = $approved;
    
        // Crear una instancia de CommunityLink
        $link = new CommunityLink();
        $link->user_id = Auth::id();
    
        // Verificar si el enlace ya ha sido enviado
        if ($link::hasAlreadyBeenSubmitted($data['link'])) {
            // Usuario no confiable sube un enlace duplicado que ya ha sido aprobado
            // No se actualizará el timestamp
            if ($approved == false) {
                return back()->with('info', 'El enlace ya está publicado y aprobado, pero usted es un usuario no verificado, por lo que no se actualizará en la lista');
            }
    
            // Usuario confiable sube un enlace duplicado que ya ha sido aprobado
            // Se puede actualizar el timestamp
            if ($approved == true) {
                return back()->with('success', 'Item actualizado correctamente!');
            } else {
                return back()->with('info', 'Object successfully updated, waiting for a moderator to accept it');
            }
        } else {
            // El enlace no ha sido enviado anteriormente, crear un nuevo enlace
            $link::create($data);
    
            if ($approved == true) {
                return back()->with('success', 'Item created successfully!');
            } else {
                return back()->with('info', 'Object successfully created, waiting for a moderator to accept it');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        // Lógica para mostrar un enlace específico
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        // Lógica para actualizar un enlace
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        // Lógica para eliminar un enlace
    }
}

