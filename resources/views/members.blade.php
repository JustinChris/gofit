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

    #instructorlist tr:nth-child(even){background-color: #f2f2f2;}

    #instructorlist tr:hover {background-color: #c2c2c2;}

    #instructorlist {
        width: 100%;
        border-collapse: collapse;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #instructorlist th, #instructorlist td{
        border: 1px solid white;
        padding: 8px;
    }

    #instructorlist th{
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
    <h1 style="text-align: center;">MEMBERS LIST</h1>
    <form action="/members">
        <div class="input-group mb-3 px-2">
            <input type="text" class="form-control" placeholder="Search Members Name..." name="search" value="{{request('search')}}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <span>Total Members: {{$members->count()}}</span>
        <a href="/members/add" class="btn btn-success" style="font-weight: bold; padding: 10px;">+ Add Member</a>
    </div>
    <table id="instructorlist">
        <tr class="bg-success">
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Membership</th>
            <th>Balance</th>
            <th>Action</th>
            <th>Transaction</th>
        </tr>

        @foreach ($members as $member)    
            <tr>
                <td>{{$member->username}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->phone}}</td>
                <td>{{$member->address}}</td>
                <span class="hidden">{{$flag = 0}}</span>
                @foreach ($memberships as $membership)
                    @if ($membership->user_id == $member->id && $flag == 0)
                        <span class="hidden">{{$flag = 1}}</span>
                        <td>
                            <span>{{$membership->subscribed_on}}</span> <br>
                            <span>{{$membership->expired_on}}</span>
                        </td>
                    @endif
                @endforeach
                @if ($flag == 0) 
                    <td>
                        <span>Not A Member</span>
                    </td>
                @endif
                <td>@money($member->balance)</td>
                <span class="hidden">{{$flag = 0}}</span>
                <td style="display: flex; justify-content: space-evenly;">
                    <a href="/members/print/{{$member->id}}" class="btn btn-primary">Print</a>
                    <a href="/members/delete/{{$member->id}}" class="btn btn-danger">Delete</a>
                    <a href="/members/update/{{$member->id}}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="/members/deposit/{{$member->id}}" class="btn btn-success">Deposit</a>
                    <a href="/members/class/{{$member->id}}" class="btn btn-success">Class</a>
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