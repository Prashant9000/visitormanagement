<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#change_password').change(function(e){

                var checked =$('#change_password').prop('checked');
                if(checked){
                    $('#password').attr('required');
                    $('#password_confirm').attr('required');
                    $('#change_password_div').removeClass('hidden');
                }else{
                    $('#password').removeAttr('required');
                    $('#password_confirm').removeAttr('required');
                    $('#change_password_div').addClass('hidden');
                }
            });
        });
    </script>  

    <script>
        function myFunction() {
    var x = document.getElementById("password");
    var y = document.getElementById("confirm_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    if(y.type=== "password"){
        y.type = "text";
    }else{
        y.type = "password";
    }
    }


    </script>

<title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div class="x_content">
                        @if(isset($user_data))
                       {{Form::open(['url'=>route('user.update',$user_data->id),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}
                            @method('PUT')

                        @else
                        {{Form::open(['url'=>route('user.store'),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}

                        @endif


                        <div class="form-group row">
                            {{ Form::label('name', 'Name: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::text('name', @$user_data->name ,['class'=>'form-control','id'=>'name']) }}
                                @if($errors->has('name'))
                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row" style="display: {{ isset($user_data) ? 'none' : 'hidden'}}">
                            {{ Form::label('email', 'Email: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::text('email', @$user_data->email ,['class'=>'form-control','id'=>'email','rows'=>5,'style'=>'resize:none']) }}
                                @if($errors->has('email'))
                                <span class="alert-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>



<div class="form-group row">
    {{ Form::label('password', 'Password: ',['class'=>'col-sm-3']) }}
    <div class="col-sm-9">
        {{Form::password('password',['id'=>'password','class'=>'form-control']) }}
        @if($errors->has('password'))
        <span class="alert-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('confirm_password', 'Reenter password: ',['class'=>'col-sm-3']) }}
    <div class="col-sm-9">
        {{Form::password('password_confirmation',['id'=>'confirm_password','class'=>'form-control']) }}
       
        <input type="checkbox" onclick="myFunction()">Show Password
        @if($errors->has('confirm_password'))
        <span class="alert-danger">{{ $errors->first('confirm_password') }}</span>
        @endif
    </div>
</div>



                       


                        <div class="form-group row">
                            {{ Form::label('role', 'Role: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::select('role',['admin'=>'Admin','superAdmin'=>'Super Admin','student'=>'Student','visitor'=>'Visitor'],@$user_data->role ,['class'=>'form-control','id'=>'role']) }}
                                @if($errors->has('role'))
                                <span class="alert-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('status', 'Status: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::select('status',['active'=>"Active",'inactive'=>'Inactive'],@$user_data->status ,['class'=>'form-control','id'=>'status']) }}
                                @if($errors->has('status'))
                                <span class="alert-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            {{ Form::label('', '',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::button('Submit',['class'=>'btn btn-success','id'=>'submit','type'=>'submit']) }}
                                {{Form::button('Cancel',['class'=>'btn btn-danger','id'=>'cancel','type'=>'reset']) }}

                            </div>
                        </div>


                        {{Form::close()}}

                    </div>
            </div>
        </div>
    </div>

    
</body>
</html>