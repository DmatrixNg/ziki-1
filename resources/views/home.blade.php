@extends('layouts.lucid')
@section('title')
  {{ $user->name }} - Lucid
@endsection
@php
$location= 'home';
@endphp
@section('sidebar')
@parent

@endsection
@section('content')
<!-- Editor -->




<!-- Beginning of Post Content -->

<!-- End of Post Content -->

{{-- @foreach ($posts as $feeds)
@if (empty($feeds['image']))

<div class="post-content">
  <a class="no-decoration" href="{{$feeds['link']}}">
    <div class="post-content-body">
      <p class="post-date">{{$feeds['date']}}</p>
      <h3 class="post-title">
        {{$feeds['title']}}
      </h3>
      <p class="post-body">
        {{$feeds['des']}}
      </p>
    </div>
  </a>
</div>
@else
<div class="post-content">
  <div class="post-image d-none d-lg-flex d-xl-flex d-md-flex">
    <img src="{{URL::to('/')}}/storage/{{$feeds['image']}}" class="img-fluid post-img" alt="Looking For Where To Spend Christmas in the comform of your home" />
  </div>
  <a class="no-decoration" href="{{$feeds['link']}}">
    <div class="post-content-body">
      <p class="post-date">{{$feeds['date']}}</p>
      <h3 class="post-title">
        {{$feeds['title']}}
      </h3>
      <p class="post-body">
        {{$feeds['des']}}
      </p>
    </div>
  </a>
</div>
@endif
@endforeach --}}


@foreach($userposts as $userpost)

@if($userpost['image'] !== '')

<div class="post-content">
  <div class="post-image d-none d-lg-flex d-xl-flex d-md-flex">
    <img src="{{$userpost['image']}}" class="img-fluid post-img" alt="Looking For Where To Spend Christmas in the comform of your home" />
  </div>
  <a class="no-decoration" href="/{{$user->username}}/post/{{$userpost['slug']}}">
    <div class="post-content-body">
      <p class="post-date">{{$userpost['date']}}</p>
      <h3 class="post-title">
        @php
         echo strip_tags($userpost['title'])
        @endphp
      </h3>
      <p class="post-body">
        @php
            echo  strip_tags($userpost['body'])
        @endphp
      </p>
    </div>
  </a>
</div>
@else

<div class="post-content">
  <a class="no-decoration" href="/{{$user->username}}/post/{{$userpost['slug']}}">
    <div class="post-content-body">
      <p class="post-date">{{$userpost['date']}}</p>
      <h3 class="post-title">
        @php
         echo strip_tags($userpost['title'])
        @endphp
      </h3>
      <p class="post-body">
        @php
        echo  strip_tags($userpost['body'])
        @endphp
      </p>
    </div>
  </a>
</div>

@endif

@endforeach


@php
 if(count($userposts) > 30) {
@endphp
  <div class="text-center">
    <button class="btn btn-primary pagination">
      Previous articles <i class="pl-2 icon ion-ios-arrow-forward"></i>
    </button>
  </div>
@php
 }
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  @guest
  @else
<script>
const j = jQuery.noConflict();
 j(document).ready(function (){
    const check = "{{ route('notif',['username'=>$user->username])  }}"

function load_unseen_notification(view = '')
{
  j.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content')
    }
  })
j.ajax({
  url:check,
  method:"POST",
  data:{view:view},
  dataType:"json",
  })
.then (
  function(data) {
  //  console.log(data);

   if(data.unseen_notification > 0)
   {
    j('.count').html(data.unseen_notification);
   }


 })
.catch(function(err) {
    //console.log('Fetch Error :-S', err);
    });
  }
  const view_notif = "{{ route('getNotif',['username'=>$user->username])  }}"

  view = "";
  j.ajax({
    url:view_notif,
    method:"Get",
    data:{view:view},
    dataType:"json",
    })
  .then (
    function(data) {
  //    console.log(data);
  j(document).on('click', '#load', function(){
    j('#notif').html(data.notification);
  });

     })

  setInterval(function(){
load_unseen_notification();
}, 2000);

j(document).on('click', '#notif', function(){
 j('.count').html('');
 load_unseen_notification('yes');
  });



})

</script>
  @endguest
@endsection
