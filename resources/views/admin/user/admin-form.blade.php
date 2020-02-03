<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
     $(document).ready(function(){
        $('#change_password').change(function(){
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
                
                     
            {{Form::open(['url'=>route('UpdateAdminUpdate',$user_data->id),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}
                            @method('PUT')


                    

                        <div class="form-group row">
                            {{ Form::label('name', 'Name: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::text('name', @$user_data->name ,['class'=>'form-control','id'=>'name']) }}
                                @if($errors->has('name'))
                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        
        



<div class="form-group row" >
    {{ Form::label('password', 'Password: ',['class'=>'col-sm-3']) }}
    <div class="col-sm-9">
        {{Form::password('password',['id'=>'password','class'=>'form-control']) }}
        @if($errors->has('password'))
        <span class="alert-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>

<div class="form-group row" >
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