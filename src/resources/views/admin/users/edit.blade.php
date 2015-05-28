@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('admin.menu.title.edit', array('model' => 'user')) }}
@endsection


@section('content')

    @include('bootstrap.users.form', array('url' => 'admin/users/'.$user->id, 'method' => 'put', 'input' => $input, 'formId' => 'editUser', 'redirectUrl' => 'admin.users.show', 'redirectParameters' => array($user->id)))

@endsection