@extends('bootstrap.layouts.master')


@section('content-title')
    {{ Translate::recursive('authentication.email.change') }}
@stop


@section('content')

    {!! Form::open(array('url' => '/change-email', 'method' => 'POST', 'id' => 'changeEmail', 'class' => 'form-horizontal', 'role' => 'form')) !!}
        {!! Form::hidden('user_id', $user->id) !!}
        <div class="well well-large">
            <div class="form-group {{ $errors->has('email_old') ? 'has-error' : '' }} {{ in_array('email_old', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('email_old', Translate::recursive('authentication.email.old') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::text('email_old', $input['email_old'], array('class' => 'form-control')) !!}
                    {!! $errors->first('email_old', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email_new') ? 'has-error' : '' }} {{ in_array('email_new', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('email_new', Translate::recursive('authentication.email.new') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::text('email_new', $input['email_new'], array('class' => 'form-control')) !!}
                    {!! $errors->first('email_new', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email_confirm') ? 'has-error' : '' }} {{ in_array('email_confirm', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('email_confirm', Translate::recursive('authentication.email.confirm') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::text('email_confirm', $input['email_confirm'], array('class' => 'form-control')) !!}
                    {!! $errors->first('email_confirm', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} {{ in_array('password', $requiredFields) ? 'required' : '' }}">
                {!! Form::label('password', Translate::recursive('members.password') .': ', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-4">
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="action-button">
            {!! Form::submit(Translate::recursive('common.submit'), array('class' => 'btn btn-primary')) !!}
            {!! HTML::linkRoute('admin.users.show', Translate::recursive('common.cancel'), array($user->id), array('class' => 'btn btn-danger')) !!}
        </div>
    {!! Form::close() !!}

@stop