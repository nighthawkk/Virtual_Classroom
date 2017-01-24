@extends('layouts.app')


@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h3 class="h3 m-t-l p-v-l">Exam : <b>{{ $topic->name }}</b></h3>
                <h3 class="h3 m-t-l p-v-l">Duration : <b>{{ $topic->duration }} minutes</b></h3>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
                <!-- Clock counter -->
        	   <div id="counter1"></div>

               <!-- js for the clock running -->
               @section('script_clock')
                    $(function() {
                        var clock = $('#counter1').FlipClock({{$duration*60}}, {
                            autoStart: false,
                            countdown: true,
                            clockFace: 'MinuteCounter',
                            callbacks: {
                                 interval: function () {
                                     var time = clock.getTime().time;
                                     //alert(time);
                                    @foreach($questions as $q)
                                        $('#time_taken{{$q->id}}').val(time);
                                    @endforeach
                                },
                            stop: function(){
                            alert("The time has run out!");
                            }

                    }
                    });
                    clock.start();

                @endsection



                @foreach($questions as $question)
                    <div class="jumbotron" id="jumbotron{{$question->id}}"
                            @if($question->id != $current_question_id )
                                    style="display:none";
                            @endif
                            >
                        <p>Question #{{ $question->id }}</p>
                        <p>{{ $question->question }}</p>

                        <form class="form-horizontal" method="post" id="frm{{$question->id}}" action="{{ action('ExamController@postSaveQuestionResult',[$course->id,$topic->id]) }}">
                            
                            <ul id="answer-radio{{$question->id}}">
                                <div class="btn-group" data-toggle="buttons">
                                    <li>
                                        <label><input type="radio" name="option" value="1" /> {{ $question->option1 }}</label>
                                    </li>
                                    <li>
                                        <label><input type="radio" name="option" value="2" /> {{ $question->option2 }}</label>
                                    </li>
                                    <li>
                                        <label><input type="radio" name="option" value="3" /> {{ $question->option3 }}</label>
                                    </li>
                                    <li>
                                        <label><input type="radio" name="option" value="4" /> {{ $question->option4 }}</label>
                                    </li>
                                </div>
                            </ul>
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <input type="hidden" name="time_taken{{ $question->id }}" id="time_taken{{$question->id}}">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @if($question->id == $last_question_id)
                                <button type="submit" class="btn btn-primary">Last</button>
                            @else
                                <button type="submit" class="btn btn-primary">Next</button>
                            @endif
                        </form>
                    </div>




                     @if($questions->count()>1)
                        @section('script_form')
                            $(function() {

                            console.log({{$question->id}});
                            console.log({{$last_question_id}});

                                $('#frm{!!$question->id!!}').on('submit', function(e){
                                    e.preventDefault();
                                    var form = $(this);
                                    var $formAction = form.attr('action');
                                    var $userAnswer = $('input[name=option]:checked', $('#frm{{$question->id}}')).val();
                                    $.post($formAction, $(this).serialize(), function(data){
                                        //console.log(this);
                                        $('#jumbotron{{$question->id}}').hide();
                                        $('#jumbotron' + data.next_question_id+'').show();
                                   });



                                });
                            });

                            });
                        @endsection
                    @endif
                @endforeach

        </div>
    </div>
</section>


@endsection