<?php
declare(strict_types=1);

namespace Notifier\Push;

/**
 * Interface PushNotificationInterface
 * @package Notifier\Push
 */
interface PushNotificationInterface
{
    public function send();
}