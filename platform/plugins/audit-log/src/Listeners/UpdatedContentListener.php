<?php

namespace Botble\AuditLog\Listeners;

use Botble\AuditLog\Events\AuditHandlerEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Exception;
use Botble\AuditLog\Facades\AuditLog;

class UpdatedContentListener
{
    public function handle(UpdatedContentEvent $event): void
    {
        try {
            if ($event->data->id) {
                event(new AuditHandlerEvent(
                    $event->screen,
                    'updated',
                    $event->data->id,
                    AuditLog::getReferenceName($event->screen, $event->data),
                    'primary'
                ));
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
