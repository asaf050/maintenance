<?php

namespace Stevebauman\Maintenance\Viewers;

use Stevebauman\Maintenance\Viewers\BaseViewer;

class WorkOrderViewer extends BaseViewer {
    
    public function profile()
    {
        return view('maintenance::viewers.work-order.profile', array('workOrder'=>$this->entity));
    }

    public function workRequest()
    {
        return view('maintenance::viewers.work-order.work-request', array('workOrder'=>$this->entity));
    }

    public function calendar()
    {
        return view('maintenance::viewers.work-order.calendar', array('workOrder'=>$this->entity));
    }
    
    public function report()
    {
        return view('maintenance::viewers.work-order.report', array('workOrder'=>$this->entity));
    }
    
    public function sessions()
    {
        return view('maintenance::viewers.work-order.sessions', array('workOrder'=>$this->entity));
    }
    
    public function attachments()
    {
        return view('maintenance::viewers.work-order.attachments', array('workOrder'=>$this->entity));
    }
    
    public function parts()
    {
        return view('maintenance::viewers.work-order.parts', array('workOrder'=>$this->entity));
    }
    
    public function updates()
    {
        return view('maintenance::viewers.work-order.updates', array('workOrder'=>$this->entity));
    }
    
    public function startedAtFormatted()
    {
        if($this->entity->started_at)
        {
            $date = new \DateTime();
            
            $date->setTimestamp(strtotime($this->entity->started_at));
            
            return $date->format('M dS Y - h:ia');
        }
    }
    
    public function completedAtFormatted()
    {
        if($this->entity->completed_at)
        {
            $date = new \DateTime();
            
            $date->setTimestamp(strtotime($this->entity->completed_at));
            
            return $date->format('M dS Y - h:ia');
        }
    }

    public function btnEdit()
    {
        return view('maintenance::viewers.work-order.buttons.edit', array('workOrder'=>$this->entity));
    }
    
    public function btnDelete()
    {
        return view('maintenance::viewers.work-order.buttons.delete', array('workOrder'=>$this->entity));
    }

    public function btnDeleteArchive()
    {
        return view('maintenance::viewers.work-order.buttons.delete-archive', array('workOrder'=>$this->entity));
    }

    public function btnEvents()
    {
        return view('maintenance::viewers.work-order.buttons.events', array('workOrder'=>$this->entity));
    }
    
    public function btnCheckIn()
    {
        return view('maintenance::viewers.work-order.buttons.check-in', array('workOrder'=>$this->entity));
    }
    
    public function btnWorkers()
    {
        return view('maintenance::viewers.work-order.buttons.workers', array('workOrder'=>$this->entity));
    }
    
    public function btnNotifications()
    {
        return view('maintenance::viewers.work-order.buttons.notifications', array('workOrder'=>$this->entity));
    }
    
    public function btnComplete()
    {
        return view('maintenance::viewers.work-order.buttons.complete', array('workOrder'=>$this->entity));
    }
    
    public function btnAddParts()
    {
        return view('maintenance::viewers.work-order.buttons.add-parts', array('workOrder'=>$this->entity));
    }
    
    public function btnAddAttachments()
    {
        return view('maintenance::viewers.work-order.buttons.add-attachments', array('workOrder'=>$this->entity));
    }

    public function btnEventTag()
    {
        return view('maintenance::viewers.work-order.buttons.event-tag', array(
            'workOrder' => $this->entity,
        ));
    }

    public function btnRestore()
    {
        return view('maintenance::viewers.work-order.buttons.restore', array('workOrder'=>$this->entity));
    }

    public function btnActions()
    {
        return view('maintenance::viewers.work-order.buttons.actions', array('workOrder'=>$this->entity));
    }

    public function btnActionsArchive()
    {
        return view('maintenance::viewers.work-order.buttons.actions-archive', array('workOrder'=>$this->entity));
    }

    public function lblStartedAt()
    {
        return view('maintenance::viewers.work-order.labels.started-at', array('workOrder'=>$this->entity));
    }
    
    public function lblCompletedAt()
    {
        return view('maintenance::viewers.work-order.labels.completed-at', array('workOrder'=>$this->entity));
    }
    
    public function lblCheckCompleted()
    {
        return view('maintenance::viewers.work-order.labels.check-completed', array('workOrder'=>$this->entity));
    }
    
}