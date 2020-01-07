<?php


namespace Notifier\Sms;


use Notifier\Http\SmsApiCall;
use Notifier\NotifierApi;
use Notifier\NotifierInterface;

class SmsNotifier extends NotifierApi implements NotifierInterface
{
    protected $sms_body_structure;
    protected $priority;
    protected $mode;
    protected $provider_code;
    protected $provider_number;
    protected $sms_template_code;
    protected $sms_body;
    protected $bypass_limit_control;
    protected $expire_time;
    protected $start_from;
    protected $receivers;
    protected $receivers_file;

    /**
     * @return mixed
     */
    public function getSmsBodyStructure()
    {
        return $this->sms_body_structure;
    }

    /**
     * @param mixed $sms_body_structure
     * @return self
     */
    public function setSmsBodyStructure($sms_body_structure): self
    {
        $this->sms_body_structure = $sms_body_structure;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     * @return self
     */
    public function setPriority($priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     * @return self
     */
    public function setMode($mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderCode()
    {
        return $this->provider_code;
    }

    /**
     * @param mixed $provider_code
     * @return self
     */
    public function setProviderCode($provider_code): self
    {
        $this->provider_code = $provider_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderNumber()
    {
        return $this->provider_number;
    }

    /**
     * @param mixed $provider_number
     * @return self
     */
    public function setProviderNumber($provider_number): self
    {
        $this->provider_number = $provider_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmsTemplateCode()
    {
        return $this->sms_template_code;
    }

    /**
     * @param mixed $sms_template_code
     * @return self
     */
    public function setSmsTemplateCode($sms_template_code): self
    {
        $this->sms_template_code = $sms_template_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmsBody()
    {
        return $this->sms_body;
    }

    /**
     * @param mixed $sms_body
     * @return self
     */
    public function setSmsBody($sms_body): self
    {
        $this->sms_body = $sms_body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBypassLimitControl()
    {
        return $this->bypass_limit_control;
    }

    /**
     * @param mixed $bypass_limit_control
     * @return self
     */
    public function setBypassLimitControl($bypass_limit_control): self
    {
        $this->bypass_limit_control = $bypass_limit_control;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpireTime()
    {
        return $this->expire_time;
    }

    /**
     * @param mixed $expire_time
     * @return self
     */
    public function setExpireTime($expire_time): self
    {
        $this->expire_time = $expire_time;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartFrom()
    {
        return $this->start_from;
    }

    /**
     * @param mixed $start_from
     * @return self
     */
    public function setStartFrom($start_from): self
    {
        $this->start_from = $start_from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @param mixed $receivers
     * @return self
     */
    public function setReceivers($receivers): self
    {
        $this->receivers = $receivers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceiversFile()
    {
        if ($this->receivers_file)
            return fopen($this->receivers_file, 'r+');
        else
            return null;
    }

    /**
     * @param mixed $receivers_file
     * @return self
     */
    public function setReceiversFile($receivers_file): self
    {
        $this->receivers_file = $receivers_file;
        return $this;
    }

    public function __construct(string $api_key, int $api_version, bool $secure = true, string $app_env = self::PRODUCTION)
    {
        parent::__construct($api_key, $api_version, $secure, $app_env);
    }

    protected function getPayload()
    {
        $extra = [];
        if ($this->getSmsTemplateCode() !== null) {
            $extra['sms_template_code'] = $this->getSmsTemplateCode();
        }
        $main = [
            'expire_time' => $this->getExpireTime(),
            'provider_code' => $this->getProviderCode(),
            'priority' => $this->getPriority(),
            'receivers' => $this->getReceivers(),
            'receivers_file' => $this->getReceiversFile(),
            'provider_number' => $this->getProviderNumber(),
            'mode' => $this->getMode(),
            'sms_body_structure' => $this->getSmsBodyStructure(),
            'sms_body' => $this->getSmsBody(),
            'start_from' => $this->getStartFrom(),
            'bypass_limit_control' => $this->getBypassLimitControl()
        ];
        return array_merge($main, $extra);
    }

    /**
     * @throws \Exception
     */
    public function send()
    {
        $url = $this->getApiPath() . 'send/sms';
        $headers = ['client-token' => $this->getApiKey(), 'content-type' => 'application/json'];
        $payload = json_encode($this->getPayload());
        $api_call = new SmsApiCall($url, 'POST', $headers, $payload);
        return $api_call->execute();
    }

    /**
     * @throws \Exception
     */
    public function sendByFile()
    {
        $url = $this->getApiPath() . 'send/sms/file';
        $headers = ['client-token' => $this->getApiKey()];
        $payload = $this->getPayload();
        $api_call = new SmsApiCall($url, 'POST', $headers, $payload);
        return $api_call->executeSendFile();
    }
}