@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('authentication.register') }}
@stop


@section('content')

    {!! Form::open(array('route' => 'register', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
        <div class="well well-large">
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }} {{ in_array('first_name', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('first_name', Translate::recursive('members.first_name') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::text('first_name', $input['first_name'], array('class' => 'form-control')) !!}
                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }} {{ in_array('last_name', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('last_name', Translate::recursive('members.last_name') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::text('last_name', $input['last_name'], array('class' => 'form-control')) !!}
                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} {{ in_array('email', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('email', Translate::recursive('members.email') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-6">
                    {!! Form::text('email', $input['email'], array('class' => 'form-control')) !!}
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} {{ in_array('password', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('password', Translate::recursive('members.password') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }} {{ in_array('password_confirm', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('password_confirm', Translate::recursive('authentication.password.confirm') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::password('password_confirm', array('class' => 'form-control')) !!}
                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('terms') ? 'has-error' : '' }} {{ in_array('terms', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('terms', Translate::recursive('authentication.terms') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::checkbox('terms', 'terms', $input['terms']) !!}
                    {!! $errors->first('terms', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="action-button">
            {!! Form::submit(Translate::recursive('common.submit'), array('class' => 'btn btn-primary')) !!}
        </div>
    {!! Form::close() !!}

@stop