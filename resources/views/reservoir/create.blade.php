@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New reservoir</div>
                <div class="card-body">
                    <div class="block__form">
                        <form method="POST" action="{{route('reservoir.store')}}">
                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input class="form-control" 
                                type="text" 
                                name="reservoir_title" 
                                value="{{old('reservoir_title')}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Area</label>
                                <input class="form-control" 
                                    type="text" 
                                    name="reservoir_area" 
                                    value="{{old('reservoir_area')}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">About</label>                       
                                    <textarea  id="summernote" name="reservoir_about">
                                         {{old('reservoir_about')}}
                                    </textarea>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success">Add</button>
                        </form> 
                    </div>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection

@section('title') News reservoir @endsection
