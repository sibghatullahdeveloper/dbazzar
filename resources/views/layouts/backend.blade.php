<!DOCTYPE html>
<html>
<head>
    <title>dBazzar</title>
    <meta charset="UTF-8" />
    <meta name="description" content="Free Web tutorials" />
    <meta name="keywords" content="HTML,CSS,XML,JavaScript" />
    <meta name="author" content="A" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('homeassets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('homeassets/css/owl.theme.default.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"  type="text/css"  href="{{asset('homeassets/css/bootstrap.min.css')}}"  />
    <link rel="stylesheet" type="text/css" href="{{asset('homeassets/css/style.css')}}" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- jQuery library -->
    <script src="{{asset('homeassets/js/jquery.js')}}"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="{{asset('homeassets/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
    <script src="{{asset('homeassets/js/owl.carousel.js')}}"></script>

  <script
      src="{{asset('homeassets/js/slick.js')}}"
      type="text/javascript"
      charset="utf-8"
      ></script>


  </head>
​
<body>
  @include('layouts.top_header')

  @yield('content')


  @include('layouts.footer')

  ​@yield('js_after')
 <script>
        $('.owl-carousel').owlCarousel({
            margin: 10,
            loop: true,
            autoWidth: true,
            items: 2,
            autoPlay: true,
            dots: false,
        });
    </script>

</body>

</html>
​
​
​
​
