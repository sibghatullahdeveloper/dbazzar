@extends('layouts.backend')

@section('content')


    <div class="hero-bg" >

    </div>
    <div class="container mt-5 pt-3">
        <span class="location"><img src="{{asset('images/Path210.png')}}"></span>
        <div class="row">
            <div class="col-md-10">
                <div class="input-group mb-3">

                    <input type="text" class="form-control input-p" style="border: 1px solid #00000029;border-radius: 27px;" id="search_input" placeholder="Search Your Favorite" aria-label="Search Your Favorite" aria-describedby="basic-addon1">

                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{asset('images/place-24px.png')}}" width="30px"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
               <button type="submit" id="search" class="btn btn-primary">Search</button>
            </div>

        </div>
        <h1 class="h-balck">featured resturants</h1>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <input type="hidden" name="user_lat" value="" class="form-control" placeholder="Latitude" id="user_lat">
        </div>
        <div class="form-group col-md-4">
            <input type="hidden" name="user_long" value="" class="form-control" placeholder="Longitude" id="user_long">
        </div>
        <div class="form-group col-md-4">
            <input type="hidden" name="city" value="" class="form-control" placeholder="City Name" id="city">
        </div>
    </div>
    <div class="container">
        <div class="box-shadow1 p-3">
            <div class="row">
                @foreach($EntityBranches as $info)
                <div class="col-md-6 col-sm-6 col-12 col-lg-4 col-xl-4 mt-5">
                    <div class="card-slider p-3">
                        <div class="owl-carousel owl-theme">
                            @foreach($info->pic_path as $pics)
                            <div class="item" style="width:140px"><img style="height: 81px;" src="{{url('images/entitybranch/'.$pics->picture)}}"></div>
                            @endforeach
                        </div>
                      <a style="text-decoration:none" href="{{route('entity', ['slug' => $info->slug])}}">  <h2 class="mt-2">{{$info->title}}</h2></a>
                        @if($info->tags_name != '')
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
                        @endif
                        <div class="rating mt-2"    @if($info->tags_name == '')   style="padding-bottom: 48px;" @endif>
                            @if($info->timings != '')
                                @foreach($info->timings as $time)
            <span><img src="{{asset('images/icons-tabbar-Favorites.png')}}">4.2<span class="float-right">Open {{$time->start_time}}</span></span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

{{--    <!-- Tab panes -->--}}
{{--<div class="tab-content">--}}
{{--    <div id="home" class="container tab-pane active"><br>--}}
{{--        <div class="container-foulid py-10">--}}
{{--            <div class="infinite-scroll">--}}
{{--                <div class="row" id="show_search_data">--}}
{{--                    @foreach($EntityBranches as $info)--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-6  pt-5  col-sm-12 col-12 ">--}}
{{--                        <div class="border-r p-3">--}}

{{--                            <section class="variable-width slider pt-2  tab-slider ">--}}
{{--                                @if($info->pic_path != '')--}}
{{--                                @foreach($info->pic_path as $pics)--}}
{{--                                <div>--}}
{{--                                    <img src="{{url('images/entitybranch/'.$pics->picture)}}">--}}
{{--                                </div>--}}
{{--                                @endforeach--}}
{{--                                @endif--}}
{{--                            </section>--}}
{{--                            <h6 class="pt-2"><a href="{{route('entity', ['slug' => $info->slug])}}"><b>{{$info->title}}</b></a></h6>--}}
{{--                            <div class="btn-group btn-group-sm">--}}
{{--                                @if($info->tags_name != '')--}}
{{--                                @foreach($info->tags_name as $tags)--}}
{{--                                <button type="button" class="btn btn-dark bs">{{$tags->name}}</button>--}}
{{--                                @endforeach--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <br>--}}
{{--                            @if($info->timings != '')--}}
{{--                            @foreach($info->timings as $time)--}}
{{--                            <h6 class="pt-3"><i class="fas fa-star"></i> <b> 4.2</b> <span class="time">Opens At {{$time->start_time}} - RN : {{$info->check}}</span> </h6>--}}
{{--                            @endforeach--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="table-responsive">--}}
{{--                    <div id="search_records" style="display:none">--}}
{{--                        <h3 align="center">Search Records : <span id="total_records"></span></h3>--}}
{{--                    </div>--}}
{{--                    {{ $EntityBranches->links() }}--}}
{{--                </div>--}}




                <div id="map_currentLocation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                      <div class="modal-content">
                         <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Pin Your Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                         </div>
                         <div class="modal-body">
                            <div id="map_canvas_user" style="width: 1100px;height: 400px;"></div>
                            <div id="current">Nothing yet...</div>
                         </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                      </div>
                   </div>
                </div>


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

    <script type="text/javascript">

        $('ul.pagination').hide();


        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });

        });

        $(document).ready(function(){

            function fetch_search_data(query,city_name)
            {

                $.ajax({
                    url:"{{ route('live_search.action') }}",
                    method:'GET',
                    data:{query:query,city_name:city_name},
                    dataType:'json',

                    success:function(data)
                    {
                        $('#show_search_data').html(data.table_data);
                        $('#search_records').css("display","block");
                        $('#total_records').text(data.total_data);

                    }
                })
            }

            $('#search').click(function(){
                var query = $('#search_input').val();

                //var lat = $('#user_lat').val();
                //var lng = $('#user_long').val();
                var city_name = $('#city').val();



                fetch_search_data(query,city_name);
             });

        });


    //    // Initialize and add the map
   function initMap() {

               if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (p) {
                    var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);

                    var mapOptions = {
                        center: LatLng,
                        zoom: 15,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById('map_canvas_user'),mapOptions);
                    var myMarker = new google.maps.Marker({
                    position: LatLng,
                    draggable: true
                });

            google.maps.event.addListener(myMarker, 'dragend', function (evt) {
                document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
                $('input[name=user_lat]').val(evt.latLng.lat());
                $('input[name=user_long]').val(evt.latLng.lng());
                //alert(evt.latLng.lat());
                //alert(evt.latLng.lng());
                const input = document.querySelector('#longitude')
                input.value = evt.latLng.lat();
                const event = new Event('input', {
                    cancelable: true,
                    bubbles: true
                })
                input.dispatchEvent(event);

                const input1 = document.querySelector('#latitude')
                input1.value = evt.latLng.lat();
                const event1 = new Event('input', {
                    cancelable: true,
                    bubbles: true
                })
                input1.dispatchEvent(event1);
                console.log(evt);
            });

            google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
                document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
            });

            map.setCenter(myMarker.position);
            myMarker.setMap(map);

            });
        }
        else
        {
            alert('Geo Location feature is not supported in this browser.');
        }

    }

    </script>


<script type="text/javascript">

var geocoder;

if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
}
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
    alert("Geocoder failed");
}

$(document).on('ready', function initialize() {
    geocoder = new google.maps.Geocoder();
});

function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
         alert(results[0].formatted_address)
        //find country name
        for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

                //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                    //this is the object you are looking for
                    city = results[0].address_components[i];
                    break;
                }
            }
        }
        //city data
        //alert(city.short_name);
        $('input[name=city]').val(city.short_name);


        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
</script>



    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKuPKvQgXplnAGAblaK7mOT5HoQKAfqaU&callback=initMap">
    </script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('homeassets/css/style3.css')}}">

@endsection

