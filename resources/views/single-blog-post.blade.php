@extends('layouts.lucid')
@section('title')
@if(Auth::user() && Auth::user()->username == $user->username)
{{ $post['title'] }} - {{ $user->username }} - Lucid
@else
{{ $post['title'] }} - {{ $user->name }} (@ {{ $user->username }})
@endif
@php
$location= 'singlePost';
@endphp
@endsection
@section('sidebar')
@parent

@endsection
@section('content')
<!-- Beginning of Post Content -->
<div class="post-content">
    <div class="post-content-body">
        <p class="post-date">
            <a href="{{URL::to('/')}}/{{$user->username}}/home" class="text-secondary"> Home </a> /
            <a href="../home" class="text-secondary"> Blog </a> / <span class="text-muted">{{ $post['title'] }}</span></p>
        <cite class="post-body">
            Published on {{ $post['date'] }}
        </cite>
        <h3 class="post-title mb-1">
            {{ $post['title'] }}
        </h3>

        <div class="blog-content">
            {!! $post['body'] !!}
        </div>
    </div>
</div>
<div class="">
    <p>Write a comment</p>
    <form method="POST" action="" autocomplete="off" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="form-group">
            <textarea type="text" name="body" class="form-control h-25" placeholder=""></textarea>
            @if($errors->has('body'))
            <span class="text-danger">Fill out this field to make a comment </span>
            @endif
        </div>
        <div class="text-right">
            <button type="submit" class="btn bg-alt text-white">Publish</button>
        </div>
    </form>
</div>
<div class="">
    <h6 class="font-weight-bold">Comments: </h6>
    <!--     <div class="post-content">
        <div>

        </div>
        <div class="post-content-body">
            <p class="mb-1 font-weight-bold">Lucid-<small class="text-muted">August 22, 2019</small></p>
            <p class="">
                This is a well written article. Interesting and illuminating read. I will be looking forward to more of your work
            </p>
        </div>
    </div> -->
    <div class="post-content">
        <img src="{{ asset('img/mb-1.png') }}" class="img-fluid" alt="user" />
        <div class="post-content-body">
            <h5 class="font-weight-bold">Maybe You Don't Need Kubernetes</h5>
            <p class="">
                Kubernetes is the 800-pound gorilla of container orchestration. It powers some of the biggest deployments worldwide, but it comes with a price tag
            </p>
            <p class="">Tyler Elliot -<small class="text-muted">March 28, 2019 </small></p>
        </div>
    </div>

    <div class="post-content">
        <img src="{{ asset('img/mb-2.png') }}" class="img-fluid" alt="user" />
        <div class="post-content-body">
            <h5 class="font-weight-bold">What Is Rust Doing Behind the Curtains? </h5>
            <p class="">
                Rust allows for a lot of syntactic sugar, that makes it a pleasure to write. It is sometimes hard, however, to look behind the curtain and see what the compiler is really doing with our code.
            </p>
            <p class="">Jayne Lee -<small class="text-muted">March 26, 2019 </small></p>
        </div>
    </div>

    <div class="post-content">
        <img src="{{ asset('img/mb-3.png') }}" class="img-fluid" alt="user" />
        <div class="post-content-body">
            <h5 class="font-weight-bold">The Unreasonable Effectiveness of Excel Macros</h5>
            <p class="">
                I never was a big fan of internships, partially because all the exciting companies were far away from my little village in Bavaria and partially because I was too shy to apply. Only once I applied for an internship in Ireland as part of a school program. Our teacher assigned the jobs and so my friend got one at Apple and I ended up at a medium-sized IT distributor — let's call them PcGo.
            </p>
            <p class="">Eric Elliot -<small class="text-muted">March 24, 2019 </small></p>
        </div>
    </div>

    <div class="post-content">
        <img src="{{ asset('img/mb-1.png') }}" class="img-fluid" alt="user" />
        <div class="post-content-body">
            <h5 class="font-weight-bold">Switching from a German to a US Keyboard Layout - Is It Worth It? </h5>
            <p class="">
                For the first three decades of my life, I've used a German keyboard layout. A few months ago, I switched to a US layout. This post summarizes my thoughts around the topic. I was looking for a similar article before jumping the gun, but I couldn't find one — so I'll try to fill this gap. Why switch?
            </p>
            <p class="">Tyler Elliot -<small class="text-muted">March 22, 2019 </small></p>
        </div>
    </div>

    <div class="post-content">
        <img src="{{ asset('img/mb-2.png') }}" class="img-fluid" alt="user" />
        <div class="post-content-body">
            <h5 class="font-weight-bold">fastcat - A Faster `cat` Implementation Using Splice</h5>
            <p class="">
                Lots of people asked me to write another piece about the internals of well-known Unix commands. Well, actually, nobody asked me, but it makes for a good intro. I'm sure you’ve read the previous parts about `yes` and `ls` — they are epic.
            </p>
            <p class="">Jaynee Lee -<small class="text-muted">March 20, 2019 </small></p>
        </div>
    </div>

</div>

<!-- End of Post Content -->
@endsection