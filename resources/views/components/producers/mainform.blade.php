{{-- 
    required variables:
    
    $form_open = <form> HTML generated by LaravelCollective
--}}

{{ $form_open }}
<div class='form-group'>
    {!! Form::label("producer_fullname", "Name", ['class' => 'form_label']) !!}
    {!! Form::text("producer_fullname", null, ['class' => 'form-control', 'required']) !!}
</div>
<div class='form-group'>
    {!! Form::label("email", "E-mail", ['class' => 'form_label']) !!}
    {!! Form::email("email", null, ['class' => 'form-control', 'required']) !!}
</div>

<div class='form-group'>
    {!! Form::label("website", "Web site (https://...)", ['class' => 'form-label', ]) !!}
    {!! Form::url("website", null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::submit($submit_button, ['class'=> 'btn btn-primary']) !!}
{!! Form::close() !!}