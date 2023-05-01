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
</style>

@section('content')
<section id="layout">
    <h1 style="text-align: center;">INSTRUCTORS LIST</h1>

    <form action="/instructors">
        <div class="input-group mb-3 px-2">
            <input type="text" class="form-control" placeholder="Search Instructors Name..." name="search" value="{{request('search')}}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>

    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <span>Total Instructors: {{$instructors->count()}}</span>
        <a href="/instructors/add" class="btn btn-success" style="font-weight: bold; padding: 10px;">+ Add Instructor</a>
    </div>
    

    <table id="instructorlist">
        <tr class="bg-success">
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        @foreach ($instructors as $instructor)    
            <tr>
                <td>{{$instructor->username}}</td>
                <td>{{$instructor->email}}</td>
                <td>{{$instructor->phone}}</td>
                <td>{{$instructor->address}}</td>
                <td style="display: flex; justify-content: space-evenly;">
                    <a href="/instructors/delete/{{$instructor->id}}" class="btn btn-danger">Delete</a>
                    <a href="/instructors/update/{{$instructor->id}}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
</section>
@endsection