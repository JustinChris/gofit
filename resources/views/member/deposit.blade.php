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

    #membershipList tr:nth-child(even){background-color: #f2f2f2;}

    #membershipList tr:hover {background-color: #c2c2c2;}

    #membershipList {
        width: 100%;
        border-collapse: collapse;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #membershipList th, #membershipList td{
        border: 1px solid white;
        padding: 8px;
    }

    #membershipList th{
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
        <h1 style="text-align: center;">ADD DEPOSIT</h1>
        <form action="/members/deposit/{{$member->id}}" method="post" style="width: 60%;">
            @csrf

            <label for="inputTitle">Title</label><br>
            <input type="text" id="inputTitle" name="title" class="w-100" placeholder="(title)"><br>

            <label for="inputDeposit">Deposit</label><br>
            <input type="text" id="inputDeposit" name="deposit" class="w-100" placeholder="(eg. 1000)"><br>

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
