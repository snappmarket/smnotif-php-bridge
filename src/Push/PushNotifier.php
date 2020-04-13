<?php
declare(strict_types=1);

namespace Notifier\Push;

use Exception;
use Notifier\Exceptions\InvalidNotifierTypeException;
use Notifier\Http\ApiCall;
use Notifier\NotifierApi;

/**
 * Class PushNotifier
 * @package Notifier\Push
 */
class PushNotifier extends NotifierApi implements PushNotificationInterface
{
    protected $receivers;
    protected $receiversFile;
    protected $title;
    protected $body;
    protected $deepLink;
    protected $webView;
    protected $webLink;
    protected $image;
    protected $banner;
    protected $modalText;
    protected $sound;
    protected $showName;
    protected $clearOldNotification;
    protected $timeToLive;
    protected $messagePageTitle;
    protected $messagePageBody;
    protected $expireTime;
    protected $priority;
    protected $bodyStructure;
    protected $clientToken;
    protected $mode;
    protected $pushTemplateCode;
    protected $startFrom;
    protected $bypassLimit;
    protected $providerCode;

    /**
     * @return mixed
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @param mixed $receivers
     * @return PushNotifier
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
        if ($this->receiversFile)
            return fopen($this->receiversFile, 'r+');
        else
            return null;
    }

    /**
     * @param mixed $receiversFie
     * @return PushNotifier
     */
    public function setReceiversFile($receiversFie): self
    {
        $this->receiversFile = $receiversFie;
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
     * @return PushNotifier
     */
    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return PushNotifier
     */
    public function setBody($body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeepLink()
    {
        return $this->deepLink;
    }

    /**
     * @param mixed $deepLink
     * @return PushNotifier
     */
    public function setDeepLink($deepLink): self
    {
        $this->deepLink = $deepLink;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebView()
    {
        return $this->webView;
    }

    /**
     * @param mixed $webView
     * @return PushNotifier
     */
    public function setWebView($webView): self
    {
        $this->webView = $webView;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebLink()
    {
        return $this->webLink;
    }

    /**
     * @param mixed $webLink
     * @return PushNotifier
     */
    public function setWebLink($webLink): self
    {
        $this->webLink = $webLink;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return PushNotifier
     */
    public function setImage($image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param mixed $banner
     * @return PushNotifier
     */
    public function setBanner($banner): self
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModalText()
    {
        return $this->modalText;
    }

    /**
     * @param mixed $modalText
     * @return PushNotifier
     */
    public function setModalText($modalText): self
    {
        $this->modalText = $modalText;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param mixed $sound
     * @return PushNotifier
     */
    public function setSound($sound): self
    {
        $this->sound = $sound;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShowName()
    {
        return $this->showName;
    }

    /**
     * @param mixed $showName
     * @return PushNotifier
     */
    public function setShowName($showName): self
    {
        $this->showName = $showName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClearOldNotification()
    {
        return $this->clearOldNotification;
    }

    /**
     * @param mixed $clearOldNotification
     * @return PushNotifier
     */
    public function setClearOldNotification($clearOldNotification): self
    {
        $this->clearOldNotification = $clearOldNotification;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeToLive()
    {
        return $this->timeToLive;
    }

    /**
     * @param mixed $timeToLive
     * @return PushNotifier
     */
    public function setTimeToLive($timeToLive): self
    {
        $this->timeToLive = $timeToLive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessagePageTitle()
    {
        return $this->messagePageTitle;
    }

    /**
     * @param mixed $messagePageTitle
     * @return PushNotifier
     */
    public function setMessagePageTitle($messagePageTitle): self
    {
        $this->messagePageTitle = $messagePageTitle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessagePageBody()
    {
        return $this->messagePageBody;
    }

    /**
     * @param mixed $messagePageBody
     * @return PushNotifier
     */
    public function setMessagePageBody($messagePageBody): self
    {
        $this->messagePageBody = $messagePageBody;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * @param mixed $expireTime
     * @return PushNotifier
     */
    public function setExpireTime($expireTime): self
    {
        $this->expireTime = $expireTime;
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
     * @return PushNotifier
     */
    public function setPriority($priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBodyStructure()
    {
        return $this->bodyStructure;
    }

    /**
     * @param mixed $bodyStructure
     * @return PushNotifier
     */
    public function setBodyStructure($bodyStructure): self
    {
        $this->bodyStructure = $bodyStructure;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientToken()
    {
        return $this->clientToken;
    }

    /**
     * @param mixed $clientToken
     * @return PushNotifier
     */
    public function setClientToken($clientToken): self
    {
        $this->clientToken = $clientToken;
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
     * @return PushNotifier
     */
    public function setMode($mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPushTemplateCode()
    {
        return $this->pushTemplateCode;
    }

    /**
     * @param mixed $pushTemplateCode
     * @return PushNotifier
     */
    public function setPushTemplateCode($pushTemplateCode): self
    {
        $this->pushTemplateCode = $pushTemplateCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartFrom()
    {
        return $this->startFrom;
    }

    /**
     * @param mixed $startFrom
     * @return PushNotifier
     */
    public function setStartFrom($startFrom): self
    {
        $this->startFrom = $startFrom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBypassLimit()
    {
        return $this->bypassLimit;
    }

    /**
     * @param mixed $bypassLimit
     * @return PushNotifier
     */
    public function setBypassLimit($bypassLimit): self
    {
        $this->bypassLimit = $bypassLimit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderCode()
    {
        return $this->providerCode;
    }

    /**
     * @param mixed $providerCode
     * @return PushNotifier
     */
    public function setProviderCode($providerCode): self
    {
        $this->providerCode = $providerCode;
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
    public function __construct(string $api_key, int $api_version, bool $secure = null, string $app_env = null)
    {
        if ($secure === null) {
            $secure = true;
        }
        if ($app_env === null) {
            $app_env = self::PRODUCTION;
        }
        parent::__construct($api_key, $api_version, $secure, $app_env);
    }

    /**
     * @return array
     */
    protected function getPayload()
    {
        $extra = [];
        if ($this->getPushTemplateCode() !== null) {
            $extra['push_template_code'] = $this->getPushTemplateCode();
        }
        $main = [
            'receivers' => $this->getReceivers(),
            'push_title' => base64_encode($this->getTitle()),
            'push_body' => base64_encode($this->getBody()),
            'deep_link' => $this->getDeepLink(),
            'web_view' => $this->getWebView(),
            'web_link' => $this->getWebLink(),
            'image' => $this->getImage(),
            'banner' => $this->getBanner(),
            'modal_text' => $this->getModalText(),
            'sound' => $this->getSound(),
            'show_name' => $this->getShowName(),
            'clear_old_notification' => $this->getClearOldNotification(),
            'time_to_live' => $this->getTimeToLive(),
            'message_page_title' => base64_encode($this->getMessagePageTitle()),
            'message_page_body' => base64_encode($this->getMessagePageBody()),
            'expire_time' => $this->getExpireTime(),
            'priority' => $this->getPriority(),
            'body_structure' => $this->getBodyStructure(),
            'start_from' => $this->getStartFrom(),
            'mode' => $this->getMode(),
            'provider_code' => $this->getProviderCode(),
            'receivers_file' => $this->getReceiversFile(),
            'bypass_limit_control' => $this->getBypassLimit()
        ];
        return array_merge($main, $extra);
    }

    /**
     * @throws Exception
     */
    public function send()
    {
        $url = $this->getApiPath() . 'send/push';
        $headers = ['client-token' => $this->getApiKey(), 'content-type' => 'application/json'];
        $payload = json_encode($this->getPayload());
        $api_call = new ApiCall($url, 'POST', $headers, $payload);
        return $api_call->execute();
    }

    /**
     * @throws Exception
     */
    public function sendByFile()
    {
        $url = $this->getApiPath() . 'send/push/file';
        $headers = ['client-token' => $this->getApiKey()];
        $payload = $this->getPayload();
        $api_call = new ApiCall($url, 'POST', $headers, $payload);
        return $api_call->executeSendFile();
    }
}