<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
           $(document).ready( function () {
    $('.table').DataTable();
} );
        </script>   
<title>Document</title>
</head>
<body>

<a href="{{ route('visitorsLogCreate')}}" class="btn btn-success pull-right">Add Visitors Logs</a>
        
@include('layouts.notification')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <th>S.n</th>
                        <th>User Name</th>
                        <th>Visitor Date</th>
                        <th>Purpose</th>
                       
                        <th>Followup Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($user as $key=>$value)
                         <tr>
                             <td>{{ $key+1 }}</td>
                             <td>{{$value->getUserName['name'] }}</td>
                             <td>{{$value->visit_date}}</td>
                             <td>{{$value->purpose}}</td>
                             <td>{{$value->followUp_status}}</td>
                             <td>
                                 <a class="btn btn-success" href="{{ route('visitorsLogEdit',$value->id) }}">Edit</a>
                                 <a href="{{ route('viewAllLogAdmin',$value->user_id)}}" class="btn btn-success">View </a>
                                </td>
                         </tr>
                         @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</body>
</html>