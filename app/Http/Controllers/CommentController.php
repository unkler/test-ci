<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->only(['article_id', 'body']);

        $result = Comment::create($params);

        return json_encode([
            'body' => $result->body,
        ]);
    }
}
