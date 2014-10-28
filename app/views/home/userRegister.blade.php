@extends('layouts.register')

@section('title')
	用户注册
@stop

@section('sidebar')
    

    <p>This is appended to the master sidebar--.</p>
    @parent
@stop

@section('content')
    <p>This is my body content.</p>
@stop