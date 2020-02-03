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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   
<title>Document</title>
</head>
<body>
       
@include('layouts.notification')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div class="col-sm-12">
            <th>Name: </th> <td> {{ $user->name}}</td><br>
          
            </div>
            <div class="col-sm-12">
            <th>Email: </th> <td> {{ $user->email}}</td><br>
            </div>

            <div class="col-sm-12">
            <th>Status: </th> <td> {{ $user->status}}</td><br>
            </div>

            <div class="col-sm-12">
            <th>Role: </th> <td> {{ $user->role}}</td><br>
            </div>
            <div class="col-sm-12">
                
            <th>address: </th> <td> </td>{{ $userDetails[0]->address}}<br>
            </div>
            <div class="col-sm-12">
            <th>land_line: </th> <td> </td>{{ $userDetails[0]->land_line}}<br>
            </div>
            <div class="col-sm-12">
            <th>mobile 1: </th> <td> </td>{{ $userDetails[0]->mob_1}}<br>
            </div>
            <div class="col-sm-12">
            <th>mobile 2: </th> <td> </td>{{ $userDetails[0]->mob_2}}<br>
            </div>
            
            <table class="table table-striped">
            <thead  class="thead_dark">
                <th>S.n</th>
                <th>visit date</th>
                <th>purpose</th>
                <th>followUp_status</th>
            </thead>
            <tbody>
            @foreach($visitors_log as $key=>$value)
            <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $value->visit_date }}</td>
            <td>{{ $value->purpose }}</td>
            <td>{{ $value->followUp_status }}</td>
            </tr>
            @endforeach
            </tbody>
            </table>
            <h3>Notes</h3>
            <a class="btn btn-success" href="{{ route('addNotes',$user->id) }}">Add Notes</a>
            <div class="col-sm-12">
                <table  class="table table-striped">
                    <thead class="thead_dark">
                        <th>S.n</th>
                        <th>Note date</th>
                        <th>Notes</th>
                    </thead>
                    @foreach($visitors_note as $key=>$value)
                       <tr>
                       <td>{{$key+1}}</td>
                        <td>{{$value->note_date}}</td>
                        <td>{{$value->notes}}</td>
                       </tr>
                    @endforeach
                </table>
               
              
            </div>

         



           
           
           
           
            </div>
        </div>
    </div>

    
</body>
</html>