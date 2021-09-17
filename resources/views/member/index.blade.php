@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Member</div>

                    <form action="{{ route('member.index') }}" method="get">
                        <fieldset>
                            <legend>Filter</legend>
                            <div class="block">
                                <div class="form-group">
                                    <select class="form-control" name="reservoir_id">
                                        <option value="0" disabled selected>Select reservoir</option>
                                        @foreach ($reservoirs as $reservoir)
                                            <option value="{{ $reservoir->id }}" @if ($reservoir_id == $reservoir->id) selected @endif>
                                                {{ $reservoir->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select reservoir from the list.</small>
                                </div>
                            </div>
                            <div class="block">
                                <button type="submit" class="btn btn-info" name="filter" value="reservoir">Filter</button>
                                <a href="{{ route('member.index') }}" class="btn btn-danger">Reset</a>
                            </div>

                        </fieldset>
                    </form>
                    <div class="card-body">
                        <div class="mt-3">{{ $members->links() }}</div>

                        <ul class="list-group">
                            @foreach ($members as $member)
                                <li class="list-group-item">
                                    <div class="listBlock">
                                        <div class="listBlock__content">
                                            <div class="item">
                                                <p><b>Name:</b> <i>{{ $member->name }}</i> </p>
                                            </div>
                                            <div class="item">
                                                <p><b>Lastname:</b> <i>{{ $member->surname }}</i> </p>
                                            </div>
                                            <div class="item">
                                                <p><b>Reservoir: </b>{{ $member->getReservoir->title }}</p>
                                            </div>
                                            <div class="item">
                                                <p><b>Registered: </b>{{ $member->registered }} year.</p>
                                            </div>
                                        </div>

                                        <div class="listBlock__buttons">
                                            <a href="{{ route('member.edit', [$member]) }}" class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{ route('member.destroy', $member) }}">
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                        <div class="mt-3">{{ $members->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Member @endsection
