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

    .hidden {
        display: none;
    }

</style>

@section('content')
<section id="layout">
    <h1 style="text-align: center;">Schedule</h1>
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <span>Total Schedule: {{$schedule->count()}}</span>
        <span>
            <a href="/schedule/add" class="btn btn-success" style="font-weight: bold; padding: 10px;">+ Add Schedule</a>
            <a href="/schedule/generate" class="btn btn-primary" style="font-weight: bold; padding: 10px;">Generate Daily Schedule</a>
        </span>
    </div>
    <table id="scheduleList">
        <tr class="bg-success">
            <th>Class Id</th>
            <th>Title</th>
            <th>Instructor</th>
            <th>Class Start</th>
            <th>Class Ends</th>
            <th>Action</th>
        </tr>

        @foreach ($schedule as $sch)
            <tr @if ($sch->isHoliday == true)
                class="bg-dark text-white"
                @endif
            >
                <td>{{$sch->id}}</td>
                <td>{{$sch->name}}</td>
                @foreach ($instructors as $instructor)
                    @if ($sch->instructor_id == $instructor->id)
                        <td>{{$instructor->username}}</td>
                    @endif
                @endforeach
                <td>{{$sch->schedule_for}}</td>
                <td>{{$sch->finished_on}}</td>
                <td style="display: flex; justify-content: space-evenly;">
                    <a href="/schedule/delete/{{$sch->id}}" class="btn btn-danger">Delete</a>
                    <a href="/schedule/update/{{$sch->id}}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>

    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
</section>
@endsection