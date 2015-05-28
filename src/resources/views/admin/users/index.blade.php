@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('admin.menu.title.index', array('model' => 'user')) }}
@endsection


@section('content')

    <div class="row">
        <p>
            {!! HTML::linkRoute('admin.users.create', Translate::recursive('common.new'), array(), array('class' => 'btn btn-default')) !!}
        </p>
    </div>

    @include('authentication::admin.users.filter')

    @include('authentication::admin.users.table')

@endsection