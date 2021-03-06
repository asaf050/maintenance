<legend>Event Details</legend>

<div class="form-group{{ $errors->first('title', ' has-error') }}">
    <label class="col-sm-2 control-label">Title / Summary</label>

    <div class="col-md-4">
        {!! Form::text('title', (isset($apiObject) ? $apiObject->title : null), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}

        <span class="label label-danger">{{ $errors->first('title', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('description', ' has-error') }}">
    <label class="col-sm-2 control-label">Description</label>

    <div class="col-md-4">
        {!! Form::text('description', (isset($apiObject) ? $apiObject->description : null), ['class'=>'form-control', 'placeholder'=>'Enter Description']) !!}

        <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('location', ' has-error') }}">
    <label class="col-sm-2 control-label">Location</label>

    <div class="col-md-4">
        @include('maintenance::select.location', [
            'location_name' => (isset($event) && isset($event->location) ? $event->location->name : null),
            'location_id' => (isset($event) && isset($event->location) ? $event->location->id : null),
        ])

        <span class="label label-danger">{{ $errors->first('location', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('start_date', ' has-error') }}">
    <label class="col-sm-2 control-label">Start Date & Time</label>

    <div class="col-md-2">
        @include('maintenance::select.date', [
            'name' => 'start_date',
            'value' => (isset($event) ? $event->viewer()->startDateFormatted($apiObject) : null)
        ])

        <span class="label label-danger">{{ $errors->first('start_date', ':message') }}</span>
    </div>

    <div class="col-md-2">
        @include('maintenance::select.time', [
            'name' => 'start_time',
            'value' => (isset($event) ? $event->viewer()->startTimeFormatted($apiObject) : null)
        ])

        <span class="label label-danger">{{ $errors->first('start_time', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('end_date', ' has-error') }}">
    <label class="col-sm-2 control-label">End Date & Time</label>

    <div class="col-md-2">
        @include('maintenance::select.date', [
            'name' => 'end_date',
            'value' => (isset($event) ? $event->viewer()->endDateFormatted($apiObject) : null)
        ])

        <span class="label label-danger">{{ $errors->first('end_date', ':message') }}</span>
    </div>
    <div class="col-md-2">
        @include('maintenance::select.time', [
            'name' => 'end_time',
            'value' => (isset($event) ? $event->viewer()->endTimeFormatted($apiObject) : null)
        ])

        <span class="label label-danger">{{ $errors->first('end_time', ':message') }}</span>
    </div>
</div>

<div class="form-group {{ $errors->first('users', ' has-error') }}">
    <label class="col-sm-2 control-label">Attendees</label>

    <div class="col-md-4">
        @include('maintenance::select.users')
    </div>main
</div>

<div class="form-group{{ $errors->first('all_day', ' has-error') }}">
    <label class="col-sm-2 control-label">All Day</label>

    <div class="col-md-4">
        {!! Form::checkbox('all_day', 'true', (isset($event) ? $event->all_day : null)) !!}

        <span class="label label-danger">{{ $errors->first('all_day', ':message') }}</span>
    </div>
</div>

<legend>Recurrence Options</legend>

@if(isset($event))

    @if(!$event->isRecurrence)

        <div class="form-group">
            <div class="col-md-4 col-md-offset-2">
                <div class="alert alert-warning">
                    <p>
                        <b>Heads Up!</b> Setting a new frequency will change the dates and times of all events in the
                        series.
                        If you've modified a recurrence, it's not recommended to change the recurrence options.
                    </p>
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->first('frequency', ' has-error') }}">
            <label class="col-sm-2 control-label">Frequency</label>

            <div class="col-md-4">
                @include('maintenance::select.recur_frequency', [
                    'frequency' => $event->viewer()->recurFrequency($apiObject)
                ])

                <span class="label label-danger">{{ $errors->first('frequency', ':message') }}</span>
            </div>
        </div>

        <div class="form-group{{ $errors->first('recur_days', ' has-error') }}">
            <label class="col-sm-2 control-label">Specific Days</label>

            <div class="col-md-4">
                @include('maintenance::select.recur_days', [
                    'days' => $event->viewer()->recurDays($apiObject)
                ])

                <span class="label label-danger">{{ $errors->first('recur_days', ':message') }}</span>
            </div>
        </div>

        <div class="form-group{{ $errors->first('recur_months', ' has-error') }}">
            <label class="col-sm-2 control-label">Specific Months</label>

            <div class="col-md-4">
                @include('maintenance::select.recur_months')

                <span class="label label-danger">{{ $errors->first('recur_months', ':message') }}</span>
            </div>
        </div>

    @endif

@else

    <div class="form-group{{ $errors->first('recur_frequency', ' has-error') }}">
        <label class="col-sm-2 control-label">Frequency</label>

        <div class="col-md-4">
            @include('maintenance::select.recur_frequency')

            <span class="label label-danger">{{ $errors->first('recur_frequency', ':message') }}</span>
        </div>
    </div>

    <div class="form-group{{ $errors->first('recur_days', ' has-error') }}">
        <label class="col-sm-2 control-label">Specific Days</label>

        <div class="col-md-4">
            @include('maintenance::select.recur_days')

            <span class="label label-danger">{{ $errors->first('recur_days', ':message') }}</span>
        </div>
    </div>

    <div class="form-group{{ $errors->first('recur_months', ' has-error') }}">
        <label class="col-sm-2 control-label">Specific Months</label>

        <div class="col-md-4">
            @include('maintenance::select.recur_months')

            <span class="label label-danger">{{ $errors->first('recur_months', ':message') }}</span>
        </div>
    </div>

@endif

<div class="form-group">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
