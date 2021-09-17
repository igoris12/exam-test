@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New member</div>
                    <div class="card-body">
                        <div class="block__form">
                            <form method="POST" action="{{ route('member.store') }}">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text" name="member_name"
                                        value="{{ old('member_name') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Surname</label>
                                    <input class="form-control" type="text" name="member_surname"
                                        value="{{ old('member_surname') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Live</label>
                                    <input class="form-control" type="text" name="member_live"
                                        value="{{ old('member_live') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Experience</label>
                                    <input class="form-control" type="text" name="member_experience"
                                        value="{{ old('member_experience') }}">
                                </div>


                                <div class="form-group">
                                    <label class="form-label">Registered</label>
                                    <input class="form-control" type="text" name="member_registered"
                                        value="{{ old('member_registered') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Reservoir</label>
                                    <select name="reservoir_id">
                                        <option value="0" selected disabled>Select reservoir</option>
                                        @foreach ($reservoirs as $reservoir)
                                            <option value="{{ $reservoir->id }}" @if (old('reservoir_id') == $reservoir->id) selected @endif>
                                                {{ $reservoir->title }}
                                            </option>
                                        @endforeach
                                    </select>
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
@endsection

@section('title') New member @endsection
