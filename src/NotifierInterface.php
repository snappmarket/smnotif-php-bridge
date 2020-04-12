<?php
declare(strict_types=1);

namespace Notifier;

/**
 * Interface NotifierInterface
 * @package Notifier
 */
interface NotifierInterface
{
    /**
     * @var string $api_key
     */
    public function send();
}