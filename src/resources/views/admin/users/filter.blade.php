<div class="row">
    {!! Form::open(array('url' => '/admin/users/filter', 'method' => 'POST', 'id' => 'filterUsers', 'class' => 'form-inline', 'role' => 'form')) !!}
        <div class="form-group">
                {!! Form::label('query', Translate::recursive('common.query') .': ', array('class' => 'sr-only')) !!}
            {!! Form::text('query', $input['query'], array('placeholder' => Translate::recursive('common.query'), 'class' => 'form-control', 'id' => 'query')) !!}
        </div>
        <div class="form-group">
            {!! Form::submit(Translate::recursive('common.submit'), array('class' => 'btn btn-primary')) !!}
            {!! HTML::linkRoute('admin.users.index', Translate::recursive('common.clear'), array(), array('class' => 'btn btn-default')) !!}
        </div>
    {!! Form::close() !!}
</div>
