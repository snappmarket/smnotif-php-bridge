<?php
declare(strict_types=1);

namespace Notifier\Sms;

/**
 * Interface SmsNotificationInterface
 * @package Notifier\Sms
 */
interface SmsNotificationInterface
{
    public function send();
}