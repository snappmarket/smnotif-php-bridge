<?php
declare(strict_types=1);

namespace Notifier\Sms;

use Notifier\Exceptions\InvalidNotifierTypeException;
use Notifier\Http\ApiCall;
use Notifier\NotifierApi;
/**
 * Class SmsTemplate
 * @package Notifier\Sms
 */
class SmsTemplate extends NotifierApi
{
    protected $name;
    protected $title;
    protected $template_code;
    protected $template_body;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return SmsTemplate
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return SmsTemplate
     */
    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateCode()
    {
        return $this->template_code;
    }

    /**
     * @param mixed $template_code
     * @return SmsTemplate
     */
    public function setTemplateCode($template_code): self
    {
        $this->template_code = $template_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateBody()
    {
        return $this->template_body;
    }

    /**
     * @param mixed $template_body
     * @return SmsTemplate
     */
    public function setTemplateBody($template_body): self
    {
        $this->template_body = $template_body;
        return $this;
    }

    /**
     * NotifierApi constructor.
     * @param string $api_key
     * @param int $api_version
     * @param bool $secure
     * @param string $app_env
     * @throws InvalidNotifierTypeException
     */
    public function __construct(string $api_key, int $api_version, bool $secure = true, string $app_env = self::PRODUCTION)
    {
        parent::__construct($api_key, $api_version, $secure, $app_env);
    }

    /**
     * @return array
     */
    protected function getPayload(){
        return [
            'name' => $this->getName(),
            'title' => $this->getTitle(),
            'template_code' => $this->getTemplateCode(),
            'template_body' => $this->getTemplateBody()
        ];
    }

    /**
     * @return string
     */
    public function registerTemplate()
    {
        $url = $this->getApiPath() . 'sms/template';
        $headers = ['client-token'=>$this->getApiKey(),'content-type'=>'application/json'];
        $payload = json_encode($this->getPayload());
        $api_call = new ApiCall($url, 'POST', $headers, $payload);
        return $api_call->execute();
    }

    /**
     * @return string
     */
    public function getTemplates()
    {
        $url = $this->getApiPath() . 'sms/template';
        $headers = ['client-token'=>$this->getApiKey(),'content-type'=>'application/json'];
        $payload = json_encode($this->getPayload());
        $api_call = new ApiCall($url, 'GET', $headers, $payload);
        return $api_call->execute();
    }
}