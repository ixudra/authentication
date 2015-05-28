@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('admin.menu.title.new', array('model' => 'user')) }}
@endsection


@section('content')

    @include('authentication::admin.users.form', array('url' => 'admin/users/', 'method' => 'post', 'input' => $input, 'formId' => 'createUser', 'redirectUrl' => 'admin.users.index', 'redirectParameters' => array()))

@endsection