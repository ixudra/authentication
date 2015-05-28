@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('admin.menu.title.edit', array('model' => 'role')) }}
@endsection


@section('content')

    @include('authentication::admin.roles.form', array('url' => 'admin/roles/'.$role->id, 'method' => 'put', 'input' => $input, 'formId' => 'editRole', 'redirectUrl' => 'admin.roles.show', 'redirectParameters' => array($role->id)))

@endsection