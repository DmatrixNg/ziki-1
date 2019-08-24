@extends('layouts.lucid')
@section('title')
  {{ $user->name }} - Lucid
@endsection
@php
$location= 'subscribe';
@endphp
@section('sidebar')
@parent

@endsection
@section('content')
<form method="POST" action="{{URL::to('/')}}/{{Auth::user()->username}}/extrss">
    @csrf

  <div class="form-group">
    <input type="text" name="rss" class="form-control h-25" placeholder="Enter External Rss"/>
  </div>
  <div class="text-right">
    <button type="submit" class="btn bg-alt text-white">Add</button>
  </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
const j = jQuery.noConflict();
 j(document).ready(function (){
    const check = "{{ route('notif',['username'=>$user->username])  }}"
    j.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content')
        }
     })

function load_unseen_notification(view = '')
{
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

@endsection
