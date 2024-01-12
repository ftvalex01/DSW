<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueStoreRequest;
use App\Http\Requests\VenueUpdateRequest;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VenueController extends Controller
{
    public function index(Request $request): Response
    {
        $venues = Venue::all();

        return view('venue.index', compact('venues'));
    }

    public function create(Request $request): Response
    {
        return view('venue.create');
    }

    public function store(VenueStoreRequest $request): Response
    {
        $venue = Venue::create($request->validated());

        $request->session()->flash('venue.id', $venue->id);

        return redirect()->route('venue.index');
    }

    public function show(Request $request, Venue $venue): Response
    {
        return view('venue.show', compact('venue'));
    }

    public function edit(Request $request, Venue $venue): Response
    {
        return view('venue.edit', compact('venue'));
    }

    public function update(VenueUpdateRequest $request, Venue $venue): Response
    {
        $venue->update($request->validated());

        $request->session()->flash('venue.id', $venue->id);

        return redirect()->route('venue.index');
    }

    public function destroy(Request $request, Venue $venue): Response
    {
        $venue->delete();

        return redirect()->route('venue.index');
    }
}
