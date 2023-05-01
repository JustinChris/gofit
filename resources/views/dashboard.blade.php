@extends('layout.FullPage')

<style>
    #layout {
        display: flex;
        margin: 10px 10%;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
        flex-direction: row;
    }

    #layout div {
        max-width: 300px;
    }

    .container p {
        padding: 10px;
        font-weight: bold;
        font-size: 2rem;
        text-align: center;
    }

    .container a {
        display: flex;
        background-color: white;
        width: 100%;
        margin-bottom: 10px;
        text-decoration: none;
        color: black;
        padding: 5px;
    }

    .instructor {
        background-color: red;
    }

    .member {
        background-color: greenyellow;
    }

    .employee {
        background-color: cyan;
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

    @if($user->role == "admin")
    <div class="instructor container">
        <p>Instructors</p>
        <a href="/instructors">View Details</a>
    </div>
    @endif
    @if ($user->role == "admin" || $user->role == "kasir")
    <div class="member container">
        <p>Members</p>
        <a href="/members">View Details</a>
    </div>
    @endif
    @if ($user->role == "admin" || $user->role == "mo")
    <div class="employee container">
        <p>Schedule</p>
        <a href="/schedule">View Details</a>
    </div>
    @endif

</section>

<div style="margin-top: 50px; margin-left: 3%; margin-right: 3%;">
    @if ($user->role == "admin" || $user->role == "mo")
    <section>
        <table id="scheduleList">
            @foreach (array_keys($schedules) as $schedule)
                <tr>
                    <th>
                        {{ $schedule }}
                    </th>
                </tr>

                @foreach ($schedules[$schedule] as $sch)
                <tr>
                    <td>
                        <div class="bg-warning" style="padding: 10px; border-radius: 20px;">
                            {{ $sch->name }} <br>
                            {{ $sch->schedule_for }} - {{ $sch->finished_on }}
                        </div>
                    </td>
                </tr>
                @endforeach
            @endforeach

        </table>
    </section>
    @endif
</div>

@endsection