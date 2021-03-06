@extends('maintenance::layouts.pages.main.panel')

@section('title', 'Create an Event')

@section('panel.head.content')
    Create Event
@stop

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route('maintenance.events.store'),
            'class' => 'form-horizontal'
        ])
    !!}

    @include('maintenance::events.form')

    {!! Form::close() !!}
@stop
