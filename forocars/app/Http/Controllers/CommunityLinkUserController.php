<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityLink;
use App\Models\CommunityLinkUser;

class CommunityLinkUserController extends Controller
{
    public function store(CommunityLink $link)
    {
        $vote = CommunityLinkUser::firstOrNew(['user_id' => Auth::id(), 'community_link_id' => $link->id]);
        $vote->toggle();
        return back();
    }
}
