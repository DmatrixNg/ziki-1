<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- convert to markdown script ends -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<ul style="padding: initial;">
@forelse($comments as $comment)

<div class="post-content mt-3 mb-2 pb-0">
    <img src="{{ $comment->image }}" class="img-fluid" style="border-radius:50%;object-fit:cover;" alt="user" width="55" height="56"/>
    <div class="post-content-body">
    <p class="font-weight-bold m-0">{{ '@'.$comment->username  }} - <small class="text-muted">@php
           $created_at = $carbon->parse($comment->created_at);

           echo $created_at->format('M jS, Y h:i A');
          @endphp</small></p>
        <p class="m-0">
            {{$comment->comment}}
        </p>
    </div>
</div>
@forelse($replies as $reply)

@if($reply->parent_comment_id == $comment->id)

<div  id="reply">{{ $reply->comment }}</div>


@endif
@empty
@endforelse
<button onclick="reply({{$comment->id}},{{$comment->sender_id}},'{{ $comment->username  }}')" class="btn bg-alt text-white float-right ">
        Reply
    </button>

@empty
<div class="post-content">This post has no comment yet.</div>
@endforelse
</ul>
