<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceStoreRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use App\Models\Conference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function index(Request $request): Response
    {
        $conferences = Conference::all();

        return view('conference.index', compact('conferences'));
    }

    public function create(Request $request): Response
    {
        return view('conference.create');
    }

    public function store(ConferenceStoreRequest $request): Response
    {
        $conference = Conference::create($request->validated());

        $request->session()->flash('conference.id', $conference->id);

        return redirect()->route('conference.index');
    }

    public function show(Request $request, Conference $conference): Response
    {
        return view('conference.show', compact('conference'));
    }

    public function edit(Request $request, Conference $conference): Response
    {
        return view('conference.edit', compact('conference'));
    }

    public function update(ConferenceUpdateRequest $request, Conference $conference): Response
    {
        $conference->update($request->validated());

        $request->session()->flash('conference.id', $conference->id);

        return redirect()->route('conference.index');
    }

    public function destroy(Request $request, Conference $conference): Response
    {
        $conference->delete();

        return redirect()->route('conference.index');
    }
}
