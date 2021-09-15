@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit reservoirs</div>
                <div class="card-body">   
                    <div class="block__form">
                    <form method="POST" action="{{route('reservoir.update',[$reservoir])}}">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input class="form-control" 
                            type="text" 
                            name="reservoir_title" 
                            value="{{old('reservoir_name',$reservoir->title)}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Area</label>
                            <input class="form-control" 
                            type="text" 
                            name="reservoir_area" 
                            value="{{old('reservoir_birth',$reservoir->area)}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">about</label>
                            <textarea id="summernote"  name="reservoir_about">
                                {{old('reservoir_about',$reservoir->about)}}
                            </textarea>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-info">Edit</button>
                    </form> 
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

@section('title') Edit reservoirs @endsection