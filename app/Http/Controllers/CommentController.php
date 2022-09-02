<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $params = $request->only(['article_id', 'body']);
        Comment::create($params);

        return redirect()->route('articles.index');
    }
}
