{!! Form::open(array('url' => $url, 'method' => $method, 'id' => $formId, 'class' => 'form-horizontal', 'role' => 'form')) !!}

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
        @if( $formId == 'createUser' )
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} {{ in_array('email', $requiredFields) ? 'required' : '' }}">
            {!! Form::label('email', Translate::recursive('members.email') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-4">
                {!! Form::text('email', $input['email'], array('class' => 'form-control')) !!}
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        @else
        {!! Form::hidden('email', $input[ 'email' ]) !!}
        @endif
    </div>
    <div class="action-button">
        {!! Form::submit(Translate::recursive('common.submit'), array('class' => 'btn btn-primary')) !!}
        {!! HTML::linkRoute($redirectUrl, Translate::recursive('common.cancel'), $redirectParameters, array('class' => 'btn btn-default')) !!}
    </div>

{!! Form::close() !!}