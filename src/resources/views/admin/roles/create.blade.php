@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('admin.menu.title.new', array('model' => 'role')) }}
@endsection


@section('content')

    @include('bootstrap.roles.form', array('url' => 'admin/roles/', 'method' => 'post', 'input' => $input, 'formId' => 'createRole', 'redirectUrl' => 'admin.roles.index', 'redirectParameters' => array()))

@endsection