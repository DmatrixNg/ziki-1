<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/main-style.css') }}" />
  <link rel="short icon" type="image/png" sizes="16x16" href="{{ asset('img/luci-logo.png') }}">
  <title>Page under construction - Lucid</title>
  <style>
    body{
      text-align: center;
    }
    .container {
      margin-top: 6vh
    }
    img{
      width: 300px;
      margin-top: 0.7rem;
    }
    a{
      color: #ffffff;
      background: var(--secondary-color);
      padding: 1rem 0.7rem;
      display: inline-block;
      text-decoration: none;
    }
    p {
      font-size: 1.2rem;
    }
    @media screen and (max-width: 425px){
      img{
        width: 250px;
      }
    }
  </style>
</head>
<body>
    <main class="container">
      <h2>I see you’ve found an incomplete page </h2>
      <img src="{{ asset('img/under-construction.svg') }}" alt="illustration of construction workers">
      <p>The team is working round the clock to get all pages up, do come back some time.</p>
      <a href="javascript: history.go(-1)">Click this button to return</a>
    </main>
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
</body>
</html>
