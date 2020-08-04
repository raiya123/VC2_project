@extends('layouts.frontend.menuTamplate')

@section('body')

    <div class="container mt-5">
    
        <div class="row">
            
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <h5>Find your event !</h5><br>
                <div class="row">
                     
                <div class="col-6">
                    <div class="row">
                        {{-- Search form --}}
                        {{-- <form action="" method="post"> --}}
                        <div class="input-icons col-md-12" style="margin: 0 auto"> 
                        <span class="material-icons">search</span> 
                        <input class="form-control" id="search"  type="text" autocomplete="off" placeholder="Search"> 
                        </div> <br><br><br>
                        {{-- </form> --}}
                        {{-- end search form --}}

                        {{--====== checkbox  ==========--}}
                        <div class="form-check " style="margin-left:30px">
                            @if (Auth::user()->check == 1)
                                <input type="checkbox" id="checkbox" name="checkbox[]" checked value="{{Auth::user()->check}}" class="form-check-input">  
                            @endif
                            <label class="form-check-label" for="checkbox">Event you join only</label>
                        </div>
                        <form id="ifCheck" action="{{route('ifCheck',0)}}" method="post">
                            @csrf
                            @method('put')
                        </form>
                          {{--======end checkbox  ==========--}}
                    </div>   
                </div> 
                {{-- find city --}}
                <div class="col-6">  
                    <div class="row">
                        <div class="col-4"   >
                            <p >Not to far from </p>
                        </div>
                        <div class="col-8">
                            <div class="form-group" >
                                <input name="city"  value="{{Auth::user()->city}}" class="form-control autoSuggestion" list="result" placeholder="City" required>
                                <datalist id="result"> 
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>
                 {{--end find city --}}
                </div>
            </div>    
        </div><br><br>
        {{--================== view all explore event ================================--}}
        
        <div class="row">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <?php $data = $exploreEvents;?>
                <?php               
                    $date = date('Y-m-d');
                 ?>
                @foreach ($data as $item => $exploreEvents)
                    @foreach ($exploreEvents as $exploreEvent)
                        @if (Auth::id() != $exploreEvent->owner_id && $exploreEvent->endDate >= $date)
                        @foreach ($joinEvent as $joins)
                            @if ($joins->user_id == Auth::id() && $joins->event_id == $exploreEvent->id)
                            <div class="card-event">
                                <h6>
                                    {{-- get data to group by --}}
                                    <?php
                                
                                        $startDate =(new DateTime($item));
                                        echo date_format($startDate, "l, F j");
                                    ?>  
                                </h6>
                                <div class="card p-2 card-event" id="exploreEvent">
                                    <div class="row" >
                                        <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}">
                                            {{-- get current time and convert to AM or PM --}}
                                            <?php
                                            $startTime = $exploreEvent['startTime'];
                                            echo $newDateTime = date(' h:i A', strtotime($startTime));
                                            ?>
                                            {{--  --}}
                                        </div>
                    
                                        <div class="col-8 col-sm-6 col-md-5 col-lg-4" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}">
                                            <b>{{$exploreEvent->category->category}}</b>
                                            <br> 
                                            <strong class="h5">{{$exploreEvent->title}}</strong>
                                            {{-- <strong class="h5" >{{$exploreEvent->endDate}}</strong> --}}
                                            <br>
                                            {{-- user join only event --}}
                                                @foreach ($exploreEvent->joins as $user)
                                                @if ($user->user_id == Auth::id())
                                                    <p style="display: none"><a class="only-event-user-join">{{Auth::id()}}</a></p>
                                                @else 
                                                    <p style="display: none"><a class="only-event-user-join">N</a></p>
                                                @endif
                                                @endforeach
                                            {{-- end user join only --}}
                                            {{--  counter member --}}
                                            @if ($exploreEvent->joins->count("user_id")> 1)
                                            {{$exploreEvent->joins->count("user_id")}}
                                            members going.
                                            @else
                    
                                            {{$exploreEvent->joins->count("user_id")}}
                                            member going.
                                            @endif
                                            
                                            <br>
                                            {{-- <strong hidden class="h5">{{$exploreEvent->city}}</strong> --}}
                                            
                                        </div>
                                        
                                        <div class="col-4 col-sm-3 col-md-4 col-lg-2" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}">   
                                                {{-- get profile from user insert --}}
                                            <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img">
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="row" style="display: flex; justify-content:center; align-items:center">
                                                @foreach ($exploreEvent->joins as $join)
                                                    @if ($exploreEvent->id == $join->event_id && $join->user_id == Auth::id())
                                                        <form action="{{route('quit', $join->id)}}" method="post">
                                                            @csrf
                                                            @method("delete")
                                                            <button type="submit" class="btn btn-sm btn btn-danger mt-4 quit-nutton">
                                                                <i class="fa fa-times-circle"></i>
                                                                <b>Quit</b> 
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endforeach
                                                {{-- important don't chnage anythink --}}
                                                <form action="{{route('join', $exploreEvent->id)}}" method="post">
                                                    @csrf
                                                    <div class="join_button">
                                                        <input type="hidden" class="event_id" value="{{$exploreEvent->id}}">
                                                    </div>
                                                    <div class="join_button_display" >
                                                    </div>
                                                </form>
                                                {{-- end --}}
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <br>  
                            @endif
                        @endforeach 
                        @endif  
                    @endforeach
                @endforeach
                </div>
        </div>
        {{--==================end view all explore event ==============================--}}
    </div>
    
    <script type="text/javaScript">
    // for search
        $(document).ready(function(){

            // Filter explore event
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(".card-event").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            
            // check only user event
            $("#checkbox").on('click', function () {
                var data = event_check();
                if (data == 1) {
                    $('#ifCheck').submit();
                }
            });
            
        });    
    
        // ------------------- importand ---------------------//
        joinButton()
        function joinButton(){
            var eventJoin = {!! json_encode($joinEvent, JSON_HEX_TAG) !!}
            var user_id = {!! json_encode(Auth::id(), JSON_HEX_TAG) !!}
            var event_id = document.getElementsByClassName('join_button');
            var join_button_display = document.getElementsByClassName('join_button_display');
            var data;
            var arrayEvent = [];
            for (let i = 0; i < event_id.length; i++) {
                eventJoin.forEach(items => {
                    data = event_id[i].getElementsByClassName('event_id')[0];
                    if(data.value == items.event_id){
                        arrayEvent.push(items.event_id)
                    }
                });
                if (arrayEvent[i] === undefined){
                    arrayEvent.push('had join');
                    join_button_display[i].innerHTML = `
                    <button class="btn btn-sm btn btn-success mt-4 float-right join-button">
                        <i class="fa fa-check-circle"></i>
                        <b>Join</b>
                    </button>
                    `;
                }
            }            
        }
        // -----------------------end---------------------------
    // return value of checkbox
    function event_check(){
            var checkBox = document.getElementById('checkbox');
            if (checkBox.checked === true)
            {
                var value = document.getElementById('checkbox').value;
                return value;
            }
            else
            {
                var value = document.getElementById('checkbox').value;
                return value;
            }      
    }
    // end click

    </script>

@endsection
