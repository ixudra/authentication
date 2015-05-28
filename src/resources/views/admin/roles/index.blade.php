@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('admin.menu.title.index', array('model' => 'role')) }}
@endsection


@section('content')

    <div class="row">
        <p>
            {!! HTML::linkRoute('admin.roles.create', Translate::recursive('common.new'), array(), array('class' => 'btn btn-default')) !!}
        </p>
    </div>

    @include('authentication::admin.roles.filter')

    @include('authentication::admin.roles.table')

@endsection