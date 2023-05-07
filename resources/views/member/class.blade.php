@extends('layout/FullPage')
<style>
    #layout {
        display: flex;
        margin: 10px 5%;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
        flex-direction: column;
    }



</style>
@section('content')
    <section id="layout">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <h1 style="text-align: center;">CLASS BOOKING</h1>
        <form action="/members/class/{{$member->id}}" method="post" style="width: 60%;">
            @csrf

            <label for="inputTitle">Class ID</label><br>
            <select name="classid" class="w-100">
                @foreach ( $classes as $class)
                    <option value="{{$class->id}}">{{$class->id}} - {{$class->name}}</option>
                @endforeach
            </select>
            <br>

            <br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button class="w-100 btn btn-success" type="submit">Submit</button>
        </form>
    </section>
@endsection
