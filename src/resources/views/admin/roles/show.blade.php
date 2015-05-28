@extends('bootstrap.layouts.master')


@section('content-title')
    {{ $role->name }}
@endsection


@section('content')

    <div class="row">
        {!! Form::open(array('url' => '/admin/roles/'. $role->id, 'method' => 'delete')) !!}
            {!! HTML::linkRoute('admin.roles.edit', Translate::recursive('common.edit'), array($role->id), array('class' => 'btn btn-default')) !!}
            {!! Form::submit(Translate::recursive('common.delete'), array('class' => 'btn btn-danger')) !!}
        {!! Form:: close() !!}
    </div>

    <div class="row">
        <div class="well well-large col-md-12">
            <div class="col-md-12">
                <div class="col-md-4">{{ Translate::recursive('members.name') }}:</div>
                <div class="col-md-8">{{ $role->name }}</div>
            </div>
        </div>
    </div>

@endsection