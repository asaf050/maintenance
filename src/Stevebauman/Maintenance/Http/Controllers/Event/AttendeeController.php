<?php

namespace Stevebauman\Maintenance\Http\Controllers\Event;

use Stevebauman\Maintenance\Http\Controllers\Controller;
use Stevebauman\Maintenance\Services\Event\EventService;

class AttendeeController extends Controller
{
    public function __construct(EventService $event)
    {
        $this->event = $event;
    }

    public function destroy($api_id, $email)
    {
        $event = $this->event->findByApiId($api_id);

        if (count($event->attendees) > 0) {
            foreach ($event->attendees as $key => $attendee) {
                if ($attendee->email === $email) {
                    unset($event->attendees[$key]);
                }
            }

            $this->event->setInput()->updateByApiId($event->id);
        } else {
            return false;
        }
    }
}
