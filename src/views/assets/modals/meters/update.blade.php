<div class="modal fade" id="update-reading-modal-{{ $meter->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Meter Reading</h4>
            </div>
            
            {{ Form::open(array(
                        'url'=>route('maintenance.assets.meters.update', array($asset->id, $meter->id)), 
                        'class'=>'form-horizontal ajax-form-post clear-form',
                        'method'=>'PATCH',
                        'data-status-target' => '#update-reading-modal-status-'.$meter->id,
                        'data-refresh-target' => '#asset-meters-table',
                    ))
            }}
            
            <div class="modal-body">
                <div id="update-reading-modal-status-{{ $meter->id }}"></div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Reading</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            {{ Form::text('reading', NULL, array('class'=>'form-control', 'placeholder'=>'ex. 45')) }}
                            <span class="input-group-addon">{{ $meter->metric->name }}</span>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
            </div>
            
            {{ Form::close() }}
            
        </div>
        
    </div>
</div>