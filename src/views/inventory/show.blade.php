@extends('maintenance::layouts.main')

@section('header')
	<h1>{{ $title }}</h1>
@stop

@section('breadcrumb')

@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_profile" data-toggle="tab">Profile</a></li>
            <li><a href="#tab_movements" data-toggle="tab">Movements</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_profile">
                @include('maintenance::inventory.tabs.profile', array(
                    'item'=>$item
                ))
            </div>
            <div class="tab-pane" id="tab_movements">
                @include('maintenance::inventory.tabs.movements', array(
                    'item'=>$item
                ))
            </div>
        </div>
    </div>

@stop