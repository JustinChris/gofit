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
        <h1 style="text-align: center;">MEMBERSHIP</h1>
        <form action="/members/membership/add/{{$member->id}}" method="post">
            @csrf
            
            <label for="subscribed_on">Membership Start<span class="text-danger">*</span></label>
            <input type="date" id="subscribed_on" name="subscribed_on" class="w-100">

            <label for="subscribed_on">Membership Ends<span class="text-danger">*</span></label>
            <input type="date" id="subscribed_on" name="expired_on" class="w-100">
            
            <label for="inputPrice">Price<span class="text-danger">*</span></label><br>
            <input type="text" id="inputPrice" name="price" class="w-100" placeholder="(eg. 1000)"><br>
            @if ($errors->has('inputPhone'))
                <span class="error">{{ $errors->first('inputPhone') }}</span>
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
        <div style="margin-top: 20px;">
            @if ($subscription->count() >= 1)
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <span>Membership: <span class="text-success" style="font-weight: bolder">Active</span></span>
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
                <table id="membershipList">
                    <tr>
                        <th>Transaction Id</th>
                        <th>Subscribed On</th>
                        <th>Expired On</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                       <td colspan="4" style="text-align: center;">No Data!</td>
                    </tr>
                </table>
            @endif
        </div>
    </section>
@endsection
