<?php

namespace Botble\AuditLog\Listeners;

use Botble\AuditLog\Events\AuditHandlerEvent;
use Botble\Base\Events\DeletedContentEvent;
use Exception;
use Botble\AuditLog\Facades\AuditLog;

class DeletedContentListener
{
    public function handle(DeletedContentEvent $event): void
    {
        try {
            if ($event->data->id) {
                event(new AuditHandlerEvent(
                    $event->screen,
                    'deleted',
                    $event->data->id,
                    AuditLog::getReferenceName($event->screen, $event->data),
                    'danger'
                ));
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
