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
        <h1 style="text-align: center;">EDIT MEMBER</h1>
        <form action="/members/update/{{$member->id}}" method="post" style="width: 60%;">
            @csrf

            <label for="inputName">Username</label><br>
            <input type="text" id="inputName" name="username" class="w-100" placeholder="(5-20 letters)" value="{{$member->username}}" readonly><br>
            @if ($errors->has('inputName'))
                <span class="error">{{ $errors->first('inputName') }}</span>
            @endif

            <label for="inputEmail">Email</label><br>
            <input type="text" id="inputEmail" name="email" class="w-100" placeholder="(Email with valid domain)" value="{{$member->email}}" readonly><br>
            @if ($errors->has('inputEmail'))
                <span class="error">{{ $errors->first('inputEmail') }}</span>
            @endif

            <label for="inputPhone">Phone Number</label><br>
            <input type="text" id="inputPhone" name="phone" class="w-100" placeholder="(10-13 numbers)" value="{{$member->phone}}"><br>
            @if ($errors->has('inputPhone'))
                <span class="error">{{ $errors->first('inputPhone') }}</span>
            @endif

            <label for="inputAddress">Address</label><br>
            <input type="text" id="inputAddress" name="address" class="w-100" placeholder="(min 5 letters)" value="{{$member->address}}"><br>
            @if ($errors->has('inputAddress'))
                <span class="error">{{ $errors->first('inputAddress') }}</span>
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
        <a href="/members/password/reset/{{$member->id}}" class="btn btn-danger" style="margin: 20px 10%; ">Reset Password</a>
        <div style="margin-top: 20px;">
            @if ($subscription->count() >= 1)
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <span>Membership: <span class="text-success" style="font-weight: bolder">Active</span></span>
                    <a href="/members/membership/add/{{$member->id}}" class="btn btn-primary">Renew Subscription</a>
                </div>
                <table id="membershipList">
                    <tr>
                        <th>Transaction Id</th>
                        <th>Subscribed On</th>
                        <th>Expired On</th>
                        <th>Price</th>
                    </tr>
                    @foreach ($subscription as $subs)
                        <tr>
                            <td><span>{{$subs->id}}</td>
                            <td><span>{{$subs->subscribed_on}}</td>
                            <td><span>{{$subs->expired_on}}</td>
                            <td><span>@money($subs->price)</span></td>   
                        </tr>
                    @endforeach
                </table>
            @else
                <span>Membership: <span class="text-danger" style="font-weight: bolder">Not Active</span></span> <br>
                <a href="/members/membership/add/{{$member->id}}" class="btn btn-primary">Register</a>
            @endif
        </div>
    </section>
@endsection
