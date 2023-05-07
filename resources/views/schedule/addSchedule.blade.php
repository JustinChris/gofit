@extends('layout.FullPage')
<style>
    #layout {
        display: flex;
        margin: 10px 10%;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
        flex-direction: column;
    }

    #scheduleList tr:nth-child(even){background-color: #f2f2f2;}

    #scheduleList tr:hover {background-color: #c2c2c2;}

    #scheduleList {
        width: 100%;
        border-collapse: collapse;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #scheduleList th, #scheduleList td{
        border: 1px solid white;
        padding: 8px;
    }

    #scheduleList th{
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: rgb(44, 44, 44);
        color: white;
    }
</style>

@section('content')
    <section id="layout">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <h1 style="text-align: center;">ADD SCHEDULE</h1>
        <form action="/schedule/add" method="post">
            @csrf

            <label for="inputName">Title<span class="text-danger">*</span></label><br>
            <input type="text" id="inputName" name="name" class="w-100" placeholder="(5-20 letters)"><br>
            @if ($errors->has('inputName'))
                <span class="error">{{ $errors->first('inputName') }}</span>
            @endif

            <label for="inputInstructor">Instructor<span class="text-danger">*</span></label><br>
            <select name="instructor" id="inputInstructor" class="w-100">
                @foreach ($instructors as $instructor)
                    <option value="{{$instructor->id}}">{{$instructor->username}}</option>
                @endforeach
            </select>
            <br>
            @if ($errors->has('inputInstructor'))
                <span class="error">{{ $errors->first('inputInstructor') }}</span>
            @endif

            <label for="inputStart">Start<span class="text-danger">*</span></label><br>
            <input type="datetime-local" id="inputStart" name="start" class="w-100"> <br>
            @if ($errors->has('inputStart'))
                <span class="error">{{ $errors->first('inputStart') }}</span>
            @endif

            <label for="inputEnds">Ends<span class="text-danger">*</span></label><br>
            <input type="datetime-local" id="inputEnds" name="ends" class="w-100"> <br>
            @if ($errors->has('inputEnds'))
                <span class="error">{{ $errors->first('inputEnds') }}</span>
            @endif

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

    <section id="layout">
        <form action="/schedule/add" method="get">
            <label for="checkAvailability">Check Instructor Availibility</label> <br>
            <select name="search" value="{{request('search')}}" id="checkAvailability">
                @foreach ($instructors as $instructor)
                <option value="{{$instructor->id}}">{{$instructor->username}}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <table id="scheduleList">
            <tr class="bg-success">
                <th>Class Id</th>
                <th>Title</th>
                <th>Instructor</th>
                <th>Class Start</th>
                <th>Class Ends</th>
            </tr>
    
            @foreach ($schedule as $sch)
                <tr>
                    <td>{{$sch->id}}</td>
                    <td>{{$sch->name}}</td>
                    @foreach ($instructors as $instructor)
                        @if ($sch->instructor_id == $instructor->id)
                            <td>{{$instructor->username}}</td>
                        @endif
                    @endforeach
                    <td>{{$sch->schedule_for}}</td>
                    <td>{{$sch->finished_on}}</td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
