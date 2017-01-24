@extends('layouts.app')

@section('content')

<section class="bg-dark">
	<div class="container">
	    <div class="row p-t-xxl">
	        <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
	            <h1 class="h1 m-t-l p-v-l">Library</h1>
	        </div>
	    </div>
	</div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl content">

    		@if(Auth::guest() || Auth::user()->role_id == 1)
    		<div class="col-sm-12">
    		@else
            <div class="col-sm-9 ">
            @endif
            	<div class="panel" style="padding: 20px;">
            		@if(count($books) > 0)
	            	<ul>
	            		<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>Thumb</th>
						        <th>Book</th>
						        <th>Author</th>
						        <th>Course</th>
						      </tr>
						    </thead>
						    <tbody>
		                		@foreach($books as $book)
						    	<tr>
						        	<td><a href="{{ asset('library/books') }}/{{ $book->book_link }}" target="_blank" class="text-info" title="Click to download or read"><img src="{{ asset('library/imgs') }}/{{ $book->book_thumb }}" class="thumb-sm"></a></td>
						        	<td><a href="{{ asset('library/books') }}/{{ $book->book_link }}" target="_blank" class="text-info" title="Click to download or read">{{ $book->book_name }}</a></td>
						        	<td>{{ $book->author_name }}</td>
						        	<td><a href="{{ url('course') }}/{{ $book->course_id }}" class="text-info">{{ $book->title }}</a></td>
						        </tr>
			            		@endforeach

						    </tbody>
						  </table>
	            	</ul>
	            	@else
			    	<div class="pos-rlt wrapper b b-light r r-2x bg-danger">
	                	<span class="arrow left pull-up arrow-danger"></span>
	                	<p class="m-b-none">No books found in the library!</p>
	              	</div>
	            	@endif
            	</div>
            </div>
            @if(Auth::check())
	            @if(Auth::user()->role_id ==2)
	            <div class="col-sm-3">
	            	<div class="panel wrapper-xl bg-offWhite text-center">
			        	<a href="{{ url('vc/library/new') }}" class="btn btn-lg">+ Add New Book</a>
			    	</div>
	            </div>
	            @endif
            @endif
            @if(Auth::guest() || Auth::user()->role_id == 1)
            	<div class="col-sm-12">
            @else
            	<div class="col-sm-9">
            @endif
             	<div class="panel">
	            	{{ $books->links() }}
	            </div>
            </div>
        </div>
    </div>
</section>

@endsection