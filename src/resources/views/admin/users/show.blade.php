@extends('bootstrap.layouts.master')


@section('content-title')
    {{ $user->present()->fullName }}
@endsection


@section('content')

    <div class="row">
        {!! Form::open(array('url' => '/admin/users/'. $user->id, 'method' => 'delete')) !!}
            {!! HTML::linkRoute('admin.users.edit', Translate::recursive('common.edit'), array($user->id), array('class' => 'btn btn-default')) !!}
            {!! Form::submit(Translate::recursive('common.delete'), array('class' => 'btn btn-danger')) !!}
        {!! Form:: close() !!}
    </div>

    <div class="row">
        <div class="well well-large col-md-12">
            <div class="col-md-12">
                <div class="col-md-4">{{ Translate::recursive('members.email') }}:</div>
                <div class="col-md-8">{{ $user->email }}</div>
            </div>
        </div>
    </div>

    @include('bootstrap.customers.show.customerProjects', array('projects' => $user->customerProjects))

@endsection