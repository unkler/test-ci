@foreach ($article->comments as $comment)
<div class="card">
    <div class="card-header">
      コメント
    </div>
    <div class="card-body">
      <p class="card-text">{{ $comment->body }}</p>
    </div>
  </div>
@endforeach