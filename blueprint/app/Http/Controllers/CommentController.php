<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Http\Requests\CommentStoreRequest;
use App\Mail\CommentCreated;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function create(Request $request): Response
    {
        return view('comment.create');
    }

    public function store(CommentStoreRequest $request): Response
    {
        $comment = Comment::create($request->validated());

        NewComment::dispatch($comment);

        Mail::send(new CommentCreated($comment));

        $request->session()->flash('Comentario creado correctamente', $Comentario creado correctamente);

        return redirect()->route('comment.create');
    }
}
