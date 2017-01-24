<div class="form-group">
	<label class="col-md-2 control-label" for="question">Question:</label>
	<div class="col-md-10">
		@if(!isset($question))
		<textarea name="question" class="form-control"></textarea>
		@else
		<textarea name="question" class="form-control">{{ $question->question }}</textarea>
		@endif
	</div>
</div> 

<div class="form-group">
	<label class="col-md-2 control-label" for="question">Option #1:</label>
	<div class="col-md-10">
		@if(!isset($question))
		<textarea name="option1" class="form-control"></textarea>
		@else
		<textarea name="option1" class="form-control">{{ $question->option1 }}</textarea>
		@endif
	</div>
</div> 

<div class="form-group">
	<label class="col-md-2 control-label" for="question">Optiona #2:</label>
	<div class="col-md-10">
		@if(!isset($question))
		<textarea name="option2" class="form-control"></textarea>
		@else
		<textarea name="option2" class="form-control">{{ $question->option2 }}</textarea>
		@endif
	</div>
</div> 

<div class="form-group">
	<label class="col-md-2 control-label" for="question">Options #3:</label>
	<div class="col-md-10">
		@if(!isset($question))
		<textarea name="option3" class="form-control"></textarea>
		@else
		<textarea name="option3" class="form-control">{{ $question->option3 }}</textarea>
		@endif
	</div>
</div> 

<div class="form-group">
	<label class="col-md-2 control-label" for="question">Option #4:</label>
	<div class="col-md-10">
		@if(!isset($question))
		<textarea name="option4" class="form-control"></textarea>
		@else
		<textarea name="option4" class="form-control">{{ $question->option4 }}</textarea>
		@endif
	</div>
</div> 

<div class="form-group">
	<label class="control-label col-md-2">Answer:</label>
	<div class="col-md-10">
		<select name="answer">
			@foreach($answer as $key => $value)
				@if(isset($question))
					@if($question->answer === $value)
						<option value="{{ $key }}" selected="selected"> {{ $value }}</option>
					@else
						<option value="{{ $key }} ">{{ $value }}</option>
					@endif
				@else
				<option value="{{ $key }}">{{ $value }}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>

{{ csrf_field() }}

<div class="form-group">
	<div class="col-md-offset-2 col-md-2">
		<button type="submit" class="btn btn-primary">{{ $title_button }}</button>
	</div>
	 @if(isset($question))
        <div class="col-sm-offset-1 col-sm-2">
            <a class="btn btn-danger" id="btn-delete" href="{{action('ExamController@deleteQuestion', [$course->id,$topic->id,$question->id])}}">Delete</a>

        </div>
@endif
</div>
</form>