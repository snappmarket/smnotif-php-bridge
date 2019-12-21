<?php


namespace Notifier;


interface NotifierInterface
{
    /**
     * @var string $api_key
     */
    public function send();
}