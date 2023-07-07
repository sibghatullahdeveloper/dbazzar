@extends('layouts.backend')
@section('content')
  <!-- background image started-->
    <div class="hero-bg">
        <div class="container">
            <span class="location" >
                <h5>Location</h5>
            </span>
            <div class="row">
                <div class="col-md-10">
                    <div class="input-group mb-3">

                        <input type="text" class="form-control input-p" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1"><img src="{{asset('homeassets/images/place-24px.png')}}" width="30px"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{route('browse')}}"  class="btn btn-primary">Search</a>
                </div>

            </div>
            <div class="hero-text">
                <h1 class="pt-4">love to eat ?</h1>
                <span>ORDER ONLINE</span>
            </div>

        </div>
    </div>
    <!-- background image ended-->

    <div class="container">
        <h1 class="text-center pt-5 mt-5 category-h1">Categories</h1>
    </div>
    <!-- tab list started -->
    <div class="container">
        <!-- Nav pills -->
        <ul class="nav nav-pills" role="tablist">

            <li class="nav-item mx-auto pt-5">
                <a class="nav-link active p-0" data-toggle="pill" href="#home">
                    <div class="text-center">
                        <div class="border tab-bg p-4">
                            <svg id="local_hospital-24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="139.498" height="139.498" viewBox="0 0 164.358 164.358">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="-0.232" y1="0.604" x2="1" y2="0.344" gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#ff8134" />
                                        <stop offset="1" stop-color="#be0a5e" />
                                    </linearGradient>
                                </defs>
                                <path id="Path_203" data-name="Path 203" d="M0,0H164.358V164.358H0Z" fill="none" />
                                <path id="Path_204" data-name="Path 204" d="M112.572,3H16.7A13.678,13.678,0,0,0,3.068,16.7L3,112.572a13.737,13.737,0,0,0,13.7,13.7h95.876a13.737,13.737,0,0,0,13.7-13.7V16.7A13.737,13.737,0,0,0,112.572,3Zm0,109.572H16.7V16.7h95.876Zm-58.21-13.7H74.907V74.907H98.876V54.362H74.907V30.393H54.362V54.362H30.393V74.907H54.362Z" transform="translate(17.545 17.545)" fill="url(#linear-gradient)" />
                            </svg>

                        </div>
                    </div>
                </a>
            </li>

            <li class="nav-item mx-auto pt-5">
                <a class="nav-link p-0" data-toggle="pill" href="#menu1">
                    <div class=" text-center">
                        <div class="border tab-bg p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="139.498" height="139.498" viewBox="0 0 139.498 139.498">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="0.964" y1="0.415" x2="0.058" y2="0.859" gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#be0a5e" />
                                        <stop offset="1" stop-color="#ff8134" />
                                    </linearGradient>
                                </defs>
                                <path id="Path_205" data-name="Path 205" d="M0,0H148V148H0Z" fill="none" />
                                <path id="Path_202" data-name="Path 202" d="M1,134.03a6.387,6.387,0,0,0,6.4,6.4H89.771a6.387,6.387,0,0,0,6.4-6.4v-6.214H1ZM48.556,51.663C24.778,51.663,1,64.408,1,89.771H96.112C96.112,64.408,72.334,51.663,48.556,51.663ZM17.613,77.09c7.038-9.828,22-12.745,30.943-12.745S72.461,67.261,79.5,77.09ZM1,102.453H96.112v12.682H1Zm107.794-76.09V1H96.112V26.363h-31.7l1.458,12.682h60.618l-8.877,88.771h-8.814V140.5H119.7a10.532,10.532,0,0,0,10.335-9.321L140.5,26.363Z" transform="translate(-1 -1)" fill="url(#linear-gradient)" />
                            </svg>

                        </div>
                    </div>
                </a>
            </li>

            <li class="nav-item mx-auto pt-5">
                <a class="nav-link p-0" data-toggle="pill" href="#menu2">
                    <div class="text-center">
                        <div class="border tab-bg  p-4">
                            <svg id="shopping_basket-24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="148" height="148" viewBox="0 0 148 148">
                                <defs>
                                    <linearGradient id="linear-gradient" x1="0.964" y1="0.415" x2="0.058" y2="0.859" gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#be0a5e" />
                                        <stop offset="1" stop-color="#ff8134" />
                                    </linearGradient>
                                </defs>
                                <path id="Path_205" data-name="Path 205" d="M0,0H148V148H0Z" fill="none" />
                                <path id="Path_206" data-name="Path 206" d="M130.5,45.063H100.962L73.952,4.61a6.121,6.121,0,0,0-5.118-2.59,6.027,6.027,0,0,0-5.118,2.652L36.7,45.063H7.167A6.185,6.185,0,0,0,1,51.23,5.194,5.194,0,0,0,1.247,52.9L16.91,110.06a12.264,12.264,0,0,0,11.84,9h80.167a12.393,12.393,0,0,0,11.9-9L136.482,52.9l.185-1.665A6.185,6.185,0,0,0,130.5,45.063Zm-61.667-25.9L86.1,45.063H51.567Zm40.083,87.567-80.1.062L15.245,57.4H122.483Zm-40.083-37A12.333,12.333,0,1,0,81.167,82.063,12.37,12.37,0,0,0,68.833,69.73Z" transform="translate(5.167 10.437)" fill="url(#linear-gradient)" />
                            </svg>

                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <!-- tab list Ended -->

    <!-- Tab panels started -->
    <div class="tab-content mt-5 pt-5">

        <div id="home" class="tab-panel px-3 pt-5 active">
            <div class="container">
                <span class="triangle">◢</span>
                <div class="row">
                    @foreach($sponsored as $info)
                        <div class="col-md-6 col-sm-6 col-12 col-lg-4 col-xl-4 mt-5">
                            <div class="card-slider p-3">
                                <div class="owl-carousel owl-theme">
                                    @foreach($info->pic_path as $pics)
                                    <div class="item" style="width:140px"><img src="{{url('images/entitybranch/'.$pics->picture)}}"></div>
                                    @endforeach
                                </div>
                                <h2 class="pt-2 menu-button"><a href="{{route('entity', ['slug' => $info->entitybranches->slug])}}"><b>{{$info->entitybranches->title}}</b></a></h2>
                                <?php
                                      $a = 0;

                                      ?>
                                @foreach($info->tags_name as $tag)
                                <?php $a ++; ?>
                                @if($a == 1 || $a == 5 || $a == 9 || $a == 13)
                                <span class="badge px-3 mr-2 py-2 badge-primary">{{$tag->name}}</span>
                                @elseif($a == 2 || $a == 6 || $a == 10 || $a == 14)
                                <span class="badge px-3 mr-2 py-2 badge-secondary">{{$tag->name}}</span>
                                @elseif($a == 3 || $a == 7 || $a == 11 || $a == 15)
                                <span class="badge px-3 mr-2 py-2 badge-success">{{$tag->name}}</span>
                                @elseif($a == 4 || $a == 8 || $a == 12 || $a == 16)
                                <span class="badge px-3 mr-2 py-2 badge-danger">{{$tag->name}}</span>
                                @endif
                               
                                @endforeach


                                <div class="pt-2 rating">
                                @foreach($info->timings as $time)
                                    <span><img style="opacity:0" src="{{asset('homeassets/images/icons-tabbar-Favorites.png')}}"><span class="float-right">Opens At {{$time->start_time}} - RN : {{$info->check}}</span></span>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div id="menu1" class="container tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="menu2" class="container tab-pane fade">
                <h3 class="pt-2">Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
        </div>

        
    <!-- Tab panes Ended -->

    <div class="summer-offer display-mob-none">
        <div class="offer-inner-bg pb-4 ">
            <div class="text-center py-4">
                <h5>Featured</h5>
                <span>speaical</span>
                <div>
                    <span>summer offer</span>
                </div>
            </div>
            <div class="container">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xl-4 px-4 mb-2">
                                <div class="row p-2 pt-3 bg-card-slider">
                                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12  col-lg-5 col-xl-5">
                                        <img src="{{asset('homeassets/images/delicious-tasty-burgers-on-wooden-background-PN68GSD.png')}}" width="100%">
                                    </div>
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 offer-inner-text">
                                        <h4>Cricket Deal 1</h4>
                                        <span>Zinger Burger, fries & drink</span>
                                        <p class="mb-0">PKR 330.00
                                            <a href="" class="float-right"><img src="{{asset('homeassets/images/Symbol 82.png')}}"></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 px-4 ">
                                 <div class="row p-2 pt-3 bg-card-slider">
                                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12  col-lg-5 col-xl-5">
                                        <img src="{{asset('homeassets/images/delicious-tasty-burgers-on-wooden-background-PN68GSD.png')}}" width="100%">
                                    </div>
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 offer-inner-text">
                                        <h4>Cricket Deal 1</h4>
                                        <span>Zinger Burger, fries & drink</span>
                                        <p class="mb-0">PKR 330.00
                                            <a href="" class="float-right"><img src="{{asset('homeassets/images/Symbol 82.png')}}"></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 px-4 ">
                               <div class="row p-2 pt-3 bg-card-slider">
                                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12  col-lg-5 col-xl-5">
                                        <img src="{{asset('homeassets/images/delicious-tasty-burgers-on-wooden-background-PN68GSD.png')}}" width="100%">
                                    </div>
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 offer-inner-text">
                                        <h4>Cricket Deal 1</h4>
                                        <span>Zinger Burger, fries & drink</span>
                                        <p class="mb-0">PKR 330.00
                                            <a href="" class="float-right"><img src="{{asset('homeassets/images/Symbol 82.png')}}"></a>
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                        <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xl-4 px-4 mb-2">
                                <div class="row p-2 pt-3 bg-card-slider">
                                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12  col-lg-5 col-xl-5">
                                        <img src="{{asset('homeassets/images/delicious-tasty-burgers-on-wooden-background-PN68GSD.png')}}" width="100%">
                                    </div>
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 offer-inner-text">
                                        <h4>Cricket Deal 1</h4>
                                        <span>Zinger Burger, fries & drink</span>
                                        <p class="mb-0">PKR 330.00
                                            <a href="" class="float-right"><img src="{{asset('homeassets/images/Symbol 82.png')}}"></a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 px-4 ">
                                 <div class="row p-2 pt-3 bg-card-slider">
                                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12  col-lg-5 col-xl-5">
                                        <img src="{{asset('homeassets/images/delicious-tasty-burgers-on-wooden-background-PN68GSD.png')}}" width="100%">
                                    </div>
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 offer-inner-text">
                                        <h4>Cricket Deal 1</h4>
                                        <span>Zinger Burger, fries & drink</span>
                                        <p class="mb-0">PKR 330.00
                                            <a href="" class="float-right"><img src="{{asset('homeassets/images/Symbol 82.png')}}"></a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 px-4 ">
                                 <div class="row p-2 pt-3 bg-card-slider">
                                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12  col-lg-5 col-xl-5">
                                        <img src="{{asset('homeassets/images/delicious-tasty-burgers-on-wooden-background-PN68GSD.png')}}" width="100%">
                                    </div>
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 offer-inner-text">
                                        <h4>Cricket Deal 1</h4>
                                        <span>Zinger Burger, fries & drink</span>
                                        <p class="mb-0">PKR 330.00
                                            <a href="" class="float-right"><img src="{{asset('homeassets/images/Symbol 82.png')}}"></a>
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
  <img src="{{asset('homeassets/images/56.png')}}" width="25px">
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    
  <img src="{{asset('homeassets/images/56.png')}}" width="25px">
  </a>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="restaurants-food">
        <div class="container">
            <div class="row pb-5">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <h1 class="text-white py-11">Download the food you love</h1>
                    <p class="font-weight-bold media-text text-white">It's all at your fingertips -- the restaurants you love. Find the right food to suit your mood, and make the first bite last.</p>
                    <p class="text-white font-weight-bold pb-3">Go ahead, download us.</p>
                    <a href=""><img src="{{asset('homeassets/images/Mask Group 1.png')}}" width="35%" class="pb-3 mr-2"></a>
                    <a href=""><img src="{{asset('homeassets/images/Mask Group 2.png')}}" width="35%" class="mx-2 pb-3"></a>
                </div>
                <div class="col-xl-6 col-lg-6 display-mob-none col-md-6 col-sm-12 col-12">
                    <img src="{{asset('homeassets/images/5.png')}}" class="position-absolute res-img-mt" width="100%" class="media-img">
                </div>
            </div>
        </div>
    </div>
    <div class="restaurant-bg mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5"></div>
                    <div class="col-xl-7">
                        <div class="bk-c">
                            <h3 class=" font-weight-bold">BECOME OUR PARTNER</h3>
                            <p>Would you like thousands of new customers to taste your amazing food? So would we!</p>

                            <p>It's simple: we list your menu online, help you process orders, pick them up, and deliver them to hungry pandas - in a heartbeat!</p>

                            <p> Interested? Let's start our partnership today!</p>
                            <div class="text-right">
                                <button type="button" class="btn btn-style">GET STARTED</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
  <div class="container">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row py-5 my-5">
          <div class="col-md-4 pt-5 caro-home-inner">
              <p class="mb-0">Partners</p>
              <h1>Our</h1>
              <h1>Best Partners</h1>
          </div>
          <div class="col-md-8">
              <div class="row">
                  <div class="col-md-4">
                    <div class="carousel-shadow p-3 mx-2">
                      <img src="{{asset('homeassets/images/whatta.jpeg')}}" alt="" class="img-fluid">  
                    </div>
                      
                  </div>
                   <div class="col-md-4">
                    <div class="carousel-shadow p-3 mx-2">
                      <img src="{{asset('homeassets/images/whatta.jpeg')}}" alt="" class="img-fluid">  
                    </div>
                      
                  </div>
                   <div class="col-md-4">
                    <div class="carousel-shadow p-3 mx-2">
                      <img src="{{asset('homeassets/images/whatta.jpeg')}}" alt="" class="img-fluid">  
                    </div>
                      
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="row py-5 my-5">
          <div class="col-md-4 pt-5 caro-home-inner">
              <p class="mb-0">Partners</p>
              <h1>Our</h1>
              <h1>Best Partners</h1>
          </div>
          <div class="col-md-8">
              <div class="row">
                  <div class="col-md-4">
                    <div class="carousel-shadow p-3 mx-2">
                      <img src="{{asset('homeassets/images/whatta.jpeg')}}" alt="" class="img-fluid">  
                    </div>
                      
                  </div>
                   <div class="col-md-4">
                    <div class="carousel-shadow p-3 mx-2">
                      <img src="{{asset('homeassets/images/whatta.jpeg')}}" alt="" class="img-fluid">  
                    </div>
                      
                  </div>
                   <div class="col-md-4">
                    <div class="carousel-shadow p-3 mx-2">
                      <img src="{{asset('homeassets/images/whatta.jpeg')}}" alt="" class="img-fluid">  
                    </div>
                      
                  </div>
              </div>
          </div>
      </div>
    </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
  <img src="{{asset('homeassets/images/56.png')}}" width="25px">
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    
  <img src="{{asset('homeassets/images/56.png')}}" width="25px">
  </a>

</div>
  </div></div>

@endsection
