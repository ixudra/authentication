@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('authentication.login') }}
@stop


@section('content')

    {!! Form::open(array('url' => '/login', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
        <div class="well well-large">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', Translate::recursive('members.email') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::text('email', $input['email'], array('class' => 'form-control')) !!}
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', Translate::recursive('members.password') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('remember') ? 'has-error' : '' }}">
                {!! Form::label('remember', Translate::recursive('authentication.remember') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::checkbox('remember', 'rememberMe', $input['remember'], array('class' => '')) !!}
                    {!! $errors->first('remember', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-9">
                    {!! HTML::linkRoute('resetPassword', Translate::recursive('authentication.resetPassword.title')) !!}
                </div>
            </div>
        </div>
        <div class="action-button">
            {!! Form::submit(Translate::recursive('common.submit'), array('class' => 'btn btn-primary')) !!}
        </div>
    {!! Form::close() !!}

@stop