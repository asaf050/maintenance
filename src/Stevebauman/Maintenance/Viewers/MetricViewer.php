<?php

namespace Stevebauman\Maintenance\Viewers;

class MetricViewer extends BaseViewer {
    
    public function btnActions()
    {
        return view('maintenance::viewers.metric.buttons.actions', ['metric'=>$this->entity]);
    }
    
}