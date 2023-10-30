<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\CommunityLink;
use App\Http\Requests\CommunityLinkForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Queries\CommunityLinksQuery;

class CommunityLinkController extends Controller
{
    private $communityLinksQuery;

    public function __construct(CommunityLinksQuery $communityLinksQuery)
    {
        $this->communityLinksQuery = $communityLinksQuery;
    }

 
    public function index(Channel $channel = null)
    {
        $channels = Channel::orderBy('title', 'asc')->get();
        
        $search = request()->input('search');
        $popular = request()->exists('popular'); 
    
        if ($search) {
            $search = trim($search);
            $searchValues = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);
            
            $links = $this->communityLinksQuery->getSearch($searchValues);
        } else if($search) {
            $links = $this->communityLinksQuery->getByChannel($channel, $popular);
        }
        
    
        return view('community/index', compact('links', 'channels', 'channel'))
            ->with('popular', $popular);
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
    public function store(CommunityLinkForm  $request)
    {
        $data = $request->validated();
        $approved = Auth::user()->isTrusted();
        $data['user_id'] = Auth::id();
        $data['approved'] = $approved;
        $link = new CommunityLink();
        $link->user_id = Auth::id();

        if ($link::hasAlreadyBeenSubmitted($data['link'])) {
            //usuario no confiable sube un enlace duplicado que ya ha sido aprobado no se actualizará el timestamp
            if ($approved == false) {
                return back()->with('info', 'El enlace ya está publicado y aprobado pero usted es un usuario no verificado, por lo que no se actualizará en la lista');
            }
            if ($approved == true) {
                return back()->with('success', 'Item actualizado correctamente!');
            } else {
                return back()->with('info', 'object successfully updated, waiting for a moderator to accept it');
            }
        } else {
            $link::create($data);
            if ($approved == true) {
                return back()->with('success', 'Item created successfully!');
            } else {
                return back()->with('info', 'object successfully created, waiting for a moderator to accept it');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
