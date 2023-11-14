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
            $links = CommunityLink::withCount('users')->orderBy('users_count', 'desc')->paginate(5);
            return response()->json(['Links' => $links], 200);
        }

        // Obtener todos los links paginados
        $links = CommunityLink::paginate(5);

        return response()->json(['Links' => $links], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityLinkForm $request)
    {
        // Validar los datos utilizando la request (CommunityLinkForm)
        $data = $request->validated();
    
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
         
            if ($data['approved']) {
                return response()->json(['message' => ' El link se ha actualizado']);   
            }else{
                return response()->json(['message' => 'The link is already submitted and approved, but you are an untrusted user, so it will not be updated in the list'], 200);
            }
          
        } else {
    
            $link->fill($data);
            $link->save();
    
            if ($approved == true) {
                return response()->json(['message' => 'Item created successfully!'], 201);
            } else {
                return response()->json(['message' => 'Object created successfully, waiting for a moderator to accept it'], 202);
            }
        }
    }
    
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
        // Verificar si el usuario autenticado es el propietario del enlace o es un administrador
        $user = Auth::user();
        
        if ($user->id !== $communityLink->user_id && !$user->isTrusted()) {
            return response()->json(['message' => 'Unauthorized. You do not have permission to delete this link.'], 403);
        }
    
        // Eliminar el enlace
        $communityLink->delete();
    
        return response()->json(['message' => 'Link deleted successfully.'], 200);
    }
    
    
}
