@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Reservoirs list</div>
                <div class="card-body">
                    <div class="mt-3">{{$reservoirs->links()}}</div>

                    <ul class="list-group">
                        @foreach ($reservoirs as $reservoir)
                        <li class="list-group-item">
                            <div class="listBlock">
                                <div  class="listBlock__content">
                                    <h4>{{$reservoir->title}}</h4>
                                </div>

                                <div  class="listBlock__content">
                                    <h4>Area: {{$reservoir->area}}<i> kv. km.</i></h4>
                                </div>

                                <div class="listBlock__buttons">
                                    <a href="{{route('reservoir.edit',[$reservoir])}}" class="btn btn-info">Edit</a>
                                    <form method="POST" action="{{route('reservoir.destroy', $reservoir)}}">
                                        <button class="btn btn-danger" type="submit">DELETE</button>
                                        @csrf
                                    </form>
                                </div>
                            </div> 
                        </li>
                        @endforeach
                    </ul>   
                    <div class="mt-3">{{$reservoirs->links()}}</div>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('title') Reservoirs list @endsection