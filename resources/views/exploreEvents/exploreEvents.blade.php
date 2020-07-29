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
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="">Event you join only</label>
                          </div>
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
                                <input name="city" class="form-control autoSuggestion" list="result" placeholder="City" required>
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
<<<<<<< HEAD
                <div class="col-sm-12 col-md-1 col-lg-1"></div>
                <div class="col-sm-12 col-md-10 col-lg-9">
                    @foreach ($exploreEvents as $exploreEvent)
                    
                    <div class="card p-2 card-event" id="exploreEvent" data-id="{{$exploreEvent->id}}">
                        <div class="row" >
                            <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                                {{$exploreEvent->startTime}}
                            </div>
                            
                            <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                                <b>{{$exploreEvent->category->category}}</b>
                                <br>
                                <strong class="h5">{{$exploreEvent->title}}</strong>
                                <br>
                                <p>5 members going</p>
                            </div>
    
                            <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                                    {{-- get profile from user insert --}}
                                <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img">
=======
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
             @foreach ($exploreEvents as $exploreEvent)
             @if (Auth::id() != $exploreEvent->owner_id)
             <div class="card p-2 card-event" id="exploreEvent">
                 <div class="row" >
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                        {{$exploreEvent->startTime}}
                    </div>

                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                         <b>{{$exploreEvent->category->category}}</b>
                         <br>
                         <strong class="h5">{{$exploreEvent->title}}</strong>
                         <br>
                         <p>5 members going</p>
                     </div>

                     <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                            {{-- get profile from user insert --}}
                          <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img">
                     </div>

                     <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm mt-4 float-right delete" style="background: rgb(182, 182, 182)" href="#!"><b>Join</b></a>
>>>>>>> 9e8a482128a67b911bbd5d9081ecbd36e1aeda57
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-sm float-right delete" style="margin-top: 43px; background: rgb(182, 182, 182)" href="#!"><b>Join</b></a>
                                    </div>
                                </div>
                                
                            </div> 
                        </div>
                    </div>
                    <br>    
                  <!-- The Modal to show detail of explore event-->
        <div class="modal" id="myModal">
            <div class="modal-dialog" id="dialog" role="dialog">
              <div class="modal-content">
          
                <!-- Modal body -->
                <div class="modal-body">
                  <div class="row">
                      <div class="col-6 mt-3">
                            <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 150px; height:150px" id="img">
                      </div>
                      <div class="col-6">
                            {{$exploreEvent->category->category}}
                            <h4><b>{{$exploreEvent->title}}</b></h4>
                            <i class="material-icons">place</i> {{$exploreEvent->city}} <br>
                            <i class="material-icons">people_outline</i> <br>
                            <i class="material-icons">person_outline</i> Organized by: {{$exploreEvent->user->firstname}} <br>
                            <i class="material-icons">access_time</i> {{$exploreEvent->startDate}}-{{$exploreEvent->startTime}}
                            <a class="btn btn-sm mt-4 float-right delete" style="background: rgb(182, 182, 182)" href="#!"><b><i class="material-icons">access_time</i> Join</b></a>
                      </div>
                  </div>
                </div>
                <!-- Modal footer -->
                    <div class="modal-footer"> 
                        <div class="container ml-5">
                            {{$exploreEvent->description}}
                        </div>
<<<<<<< HEAD
                    </div>
          
                    </div>
                </div>
            </div>

        @endforeach
        </div>
    <div class="col-sm-12 col-md-1 col-lg-2"></div>
    </div>
        {{--==================end view all explore event ==============================--}}
    </div>

   
=======
                    </div> 
                 </div>
             </div>
             <br>   
             @endif   
         @endforeach
            </div>
            <div class="col-sm-12 col-md-1 col-lg-2"></div>
        </div>
        {{--==================end view all explore event ==============================--}}
    </div>
>>>>>>> 9e8a482128a67b911bbd5d9081ecbd36e1aeda57
    <script type="text/javaScript">
        $(document).ready(function(){
          $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".card").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
            // show detail of explore event
        $(document).ready(function(){
            $('.card').click(function(){
                var id = $(this).data('id');
                console.log(id);
                
                if(id) {
                    $('#myModal').modal(id);
                    
                }
            
            });
            
        });
      </script>
@endsection