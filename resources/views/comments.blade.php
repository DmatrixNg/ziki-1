@forelse($comments as $comment)
<div class="post-content mt-3 mb-4 pb-0">
    <img src="{{ $comment->image }}" class="img-fluid" style="border-radius:50%;object-fit:cover;" alt="user" width="55" height="56"/>
    <div class="post-content-body">
    <p class="font-weight-bold m-0">{{ $comment->username  }} - <small class="text-muted">@php
           $created_at = $carbon->diffForHumans($comment->created_at);
           echo $created_at;
          @endphp</small></p>
        <p class="m-0">
            {{$comment->comment}}
        </p>
    </div>
</div>
@empty
<div class="post-content">This post has no comment yet.</div>
@endforelse