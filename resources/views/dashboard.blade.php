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

<section>
    <table>
        <thead></thead>
    </table>
</section>
@endsection