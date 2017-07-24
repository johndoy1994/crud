@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                @if(session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif      
                @if(session()->has('error_message'))
                    <div class="alert alert-info">
                        {{ session()->get('error_message') }}
                    </div>
                @endif          
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('posteditcrud',['Id'=>$data->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$data->name}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Country</label>
                            <div class="col-md-6">
                                 <select class="form-control" id="country" name="country">
                                  <option value="">select country</option>
                                  @foreach($Countries as $Country)
                                  <option value="{{$Country->id}}" {{($Country->id==$data->country) ? "selected":""}}>{{$Country->name}}</option>
                                  @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">State</label>
                            <div class="col-md-6">
                                <select class="form-control" id="state" name="state">
                                    <option value="">select state</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="hidstateId" id="hidstateId" value="{{$data->state}}">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">textare</label>
                            <div class="col-md-6">
                                <textarea rows="4" cols="48" name="textarea" id="textarea" value="">{{$data->textarea}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">image</label>
                            <div class="col-md-6">
                                   <input type="file" class="form-control" name="file">
                                   <br>
                                   <img src="{{asset('image/'.$data->file)}}" height="150" width="345"></img>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">checkbox</label>
                            <div class="col-md-6">
                                <input type="checkbox" name="checkbox[]" value="Bike" {{(in_array('Bike',explode(',', $data->checkbox))) ? "checked" : ""}}> I have a bike<br>
                                <input type="checkbox" name="checkbox[]" value="Car" {{(in_array('Car',explode(',', $data->checkbox))) ? "checked" : ""}}> I have a car<br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">radio</label>
                            <div class="col-md-6">
                                <input type="radio" name="gender" {{($data->gender=='male') ? "checked" : ""}} value="male" > Male<br>
                                  <input type="radio" name="gender" {{($data->gender=='female') ? "checked" : ""}} value="female"> Female<br>
                                  <input type="radio" name="gender" {{($data->gender=='other') ? "checked" : ""}} value="other"> Other  
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">multi add</label>
                            <div class="col-md-6">
                                <button id="add">Add Field</button>
                                <div id="items">
                                 <div><input type="text" name="input[]"></div>
                                 @foreach(explode(',',$data->input) as $multiData)
                                    <div>
                                    <input type="text" name="input[]" value="{{$multiData}}">
                                    <button class="delete">Delete</button>
                                    </div>
                                 @endforeach   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

