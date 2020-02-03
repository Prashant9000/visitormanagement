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
                       {{Form::open(['url'=>route('visitors_log.update',$user_data->id),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}
                            @method('PUT')

                        @else
                        {{Form::open(['url'=>route('visitors_log.store'),'class'=>'form', 'enctype'=>'multipart/form-data'])  }}

                        @endif


                        <div class="form-group row">
                            {{ Form::label('name', 'Name: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                            {{Form::select('user_id',isset($return_user) ? $return_user : [],@$user_data->user_id,['class'=>'form-control','placeholder'=>'--Select any one--']) }}
                                @if($errors->has('name'))
                                <span class="alert-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('purpose', 'purpose: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::textarea('purpose', @$user_data->purpose ,['class'=>'form-control','id'=>'purpose','style'=>'resize:none']) }}
                                @if($errors->has('purpose'))
                                <span class="alert-danger">{{ $errors->first('purpose') }}</span>
                                @endif
                            </div>
                        </div>

     
                        <div class="form-group row">
                            {{ Form::label('followUp_status', 'followUp_status: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::select('followUp_status',['Yes'=>'Yes','No'=>'No'], @$user_data->followUp_status ,['class'=>'form-control','id'=>'followUp_status']) }}
                                @if($errors->has('followUp_status'))
                                <span class="alert-danger">{{ $errors->first('followUp_status') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('visit_date', 'visit_date: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::date('visit_date', @$user_data->visit_date ,['class'=>'form-control','id'=>'visit_date']) }}
                                @if($errors->has('visit_date'))
                                <span class="alert-danger">{{ $errors->first('visit_date') }}</span>
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