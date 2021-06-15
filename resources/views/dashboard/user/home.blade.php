<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard | Home</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="margin-top: 45px">
                 <h1>{{ strtoupper(Auth::guard('web')->user()->role) }} Dashboard</h1><br>
                 <a href="{{ route('home',['domain' => Auth::guard('web')->user()->role]) }}">Dashboard</a>|
                 <a href="{{ route('member',['domain' => Auth::guard('web')->user()->role]) }}">Memeber</a>|
                 <a href="{{ route('support',['domain' => Auth::guard('web')->user()->role]) }}">Support</a>
                 @if (Auth::guard('web')->user()->role=='admin')
                    |<a href="{{ route('system',['domain' => Auth::guard('web')->user()->role]) }}">System</a>
                 @endif
                 
                 <hr>
                 <table class="table table-striped table-inverse table-responsive">
                     <thead class="thead-inverse">
                         <tr>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Action</th>
                         </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>{{ Auth::guard('web')->user()->name }}</td>
                                 <td>{{ Auth::guard('web')->user()->email }}</td>
                                 <td>
                                     <a href="{{ route('logout',['domain' => Auth::guard('web')->user()->role]) }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                     <form action="{{ route('logout',['domain' => Auth::guard('web')->user()->role]) }}" method="post" class="d-none" id="logout-form">@csrf</form>
                                 </td>
                             </tr>
                         </tbody>
                 </table>
            </div>
        </div>
    </div>
    
</body>
</html>