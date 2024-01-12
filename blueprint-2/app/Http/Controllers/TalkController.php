<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalkStoreRequest;
use App\Http\Requests\TalkUpdateRequest;
use App\Models\Talk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TalkController extends Controller
{
    public function index(Request $request): Response
    {
        $talks = Talk::all();

        return view('talk.index', compact('talks'));
    }

    public function create(Request $request): Response
    {
        return view('talk.create');
    }

    public function store(TalkStoreRequest $request): Response
    {
        $talk = Talk::create($request->validated());

        $request->session()->flash('talk.id', $talk->id);

        return redirect()->route('talk.index');
    }

    public function show(Request $request, Talk $talk): Response
    {
        return view('talk.show', compact('talk'));
    }

    public function edit(Request $request, Talk $talk): Response
    {
        return view('talk.edit', compact('talk'));
    }

    public function update(TalkUpdateRequest $request, Talk $talk): Response
    {
        $talk->update($request->validated());

        $request->session()->flash('talk.id', $talk->id);

        return redirect()->route('talk.index');
    }

    public function destroy(Request $request, Talk $talk): Response
    {
        $talk->delete();

        return redirect()->route('talk.index');
    }
}
