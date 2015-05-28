@extends('bootstrap.layouts.master')


@section('content-title')
    Confirm registration
@stop


@section('content')

    {{ Form::open(array('url' => '/confirm-registration', 'method' => 'post', 'id' => 'confirmRegistration', 'class' => 'form-horizontal', 'role' => 'form')) }}
        <div class="well well-large">
            <p>Only one more step left in your registration. We have sent you an email with a unique registration code. Enter the code in the field below and hit submit to complete the procedure.</p>
        </div>
        <div class="well well-large">
            <div class='form-group'>
                {{ Form::label('code', 'Confirmation code: ', array('class' => 'control-label col-lg-3')) }}
                <div class="col-lg-6">
                    {{ Form::text('code', '', array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
        <div class="action-button">
            {{ Form::submit(Translate::recursive('common.submit'), array('class' => 'btn btn-primary')) }}
        </div>
    {{ Form::close() }}

@stop