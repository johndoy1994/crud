@extends('layouts.app')

@section('content')
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Gender</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($datas as $data)
      <tr>
        <td>{{$data->name}}</td>
        <td>{{$data->gender}}</td>
        <td>
            <a href="{{route('editcrud',['Id'=>$data->id])}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <a href="{{route('getdelete',['Id'=>$data->id])}}"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" data-original-title="" title=""><span class="glyphicon glyphicon-trash"></span></button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
