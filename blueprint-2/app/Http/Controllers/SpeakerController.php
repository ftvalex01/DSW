<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpeakerStoreRequest;
use App\Http\Requests\SpeakerUpdateRequest;
use App\Models\Speaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpeakerController extends Controller
{
    public function index(Request $request): Response
    {
        $speakers = Speaker::all();

        return view('speaker.index', compact('speakers'));
    }

    public function create(Request $request): Response
    {
        return view('speaker.create');
    }

    public function store(SpeakerStoreRequest $request): Response
    {
        $speaker = Speaker::create($request->validated());

        $request->session()->flash('speaker.id', $speaker->id);

        return redirect()->route('speaker.index');
    }

    public function show(Request $request, Speaker $speaker): Response
    {
        return view('speaker.show', compact('speaker'));
    }

    public function edit(Request $request, Speaker $speaker): Response
    {
        return view('speaker.edit', compact('speaker'));
    }

    public function update(SpeakerUpdateRequest $request, Speaker $speaker): Response
    {
        $speaker->update($request->validated());

        $request->session()->flash('speaker.id', $speaker->id);

        return redirect()->route('speaker.index');
    }

    public function destroy(Request $request, Speaker $speaker): Response
    {
        $speaker->delete();

        return redirect()->route('speaker.index');
    }
}
