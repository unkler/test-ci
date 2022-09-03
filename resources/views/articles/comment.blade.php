@foreach ($article->comments as $comment)
<div class="card">
  @if($loop->first)
  <div class="card-header">
    コメント
  </div>
  @endif
  <div class="card-body">
    <div class="small font-weight-lighter">
      {{ $comment->created_at->format('Y/m/d H:i') }}
    </div>
    <div class="card-text">
      {{ $comment->body }}
    </div>
  </div>
</div>
@endforeach