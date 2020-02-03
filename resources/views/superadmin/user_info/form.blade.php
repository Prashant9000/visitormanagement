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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div class="x_content">
                        @if(isset($user_data))
                       {{Form::open(['url'=>route('users_info.update',$user_data->id),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}
                            @method('PUT')

                        @else
                        {{Form::open(['url'=>route('users_info.store'),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}

                        @endif

                        <div class="form-group row">
                            {{ Form::label('name', 'Name: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                            {{Form::select('user_id',isset($return_user) ? $return_user : [],@$user_data->user_id,['class'=>'form-control','id'=>'','placeholder'=>'--Select any one--']) }}
                                @if($errors->has('name'))
                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('address', 'Address: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::text('address', @$user_data->address ,['class'=>'form-control','id'=>'address']) }}
                                @if($errors->has('address'))
                                <span class="alert-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('land_line', 'land_line: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::tel('land_line', @$user_data->land_line ,['class'=>'form-control','id'=>'land_line']) }}
                                @if($errors->has('land_line'))
                                <span class="alert-danger">{{ $errors->first('land_line') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('mob_1', 'mob_1: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::tel('mob_1', @$user_data->mob_1 ,['class'=>'form-control','id'=>'mob_1']) }}
                                @if($errors->has('mob_1'))
                                <span class="alert-danger">{{ $errors->first('mob_1') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('mob_2', 'mob_2: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::tel('mob_2', @$user_data->mob_2 ,['class'=>'form-control','id'=>'mob_2']) }}
                                @if($errors->has('mob_2'))
                                <span class="alert-danger">{{ $errors->first('mob_2') }}</span>
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