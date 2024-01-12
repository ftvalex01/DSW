<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request): Response
    {
        $videos = Video::all();

        return view('video.index', compact('videos'));
    }

    public function show(Request $request, Video $video): Response
    {
        return view('video.show', compact('video'));
    }
}
