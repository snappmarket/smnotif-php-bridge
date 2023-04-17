<?php
declare(strict_types=1);

namespace Notifier;

use Exception;
use Notifier\Exceptions\InvalidNotifierTypeException;
/**
 * Class NotifierApi
 * @package Notifier
 */
class NotifierApi
{
    public const    PRODUCTION        = "production";
    public const    STAGE             = "stage";
    public const    TEST              = "test";
    public const    API_PATH          = "%s://notif.snapp.market/api/v%s/";
    public const    API_PATH_TEST     = "%s://notif-%s.snapp.market/api/v%s/";
    public const    SMS               = 'sms';
    public const    EMAIL             = 'email';
    public const    PUSH              = 'push';
    public const    ASYNC_MODE        = 'async';
    public const    SYNC_MODE         = 'sync';
    public const    BLOCKER_PRIORITY  = 'blocker';
    public const    HIGH_PRIORITY     = 'high';
    public const    MEDIUM_PRIORITY   = 'medium';
    public const    LOW_PRIORITY      = 'low';
    public const    DYNAMIC_STRUCTURE = 'dynamic';
    public const    STATIC_STRUCTURE  = 'static';
    protected $api_path;
    protected $api_key;
    protected $api_version;
    protected $app_env;
    protected $secure;
    /**
     * @var null|string
     */
    private $domain;

    /**
     * @return mixed
     */
    public function getApiPath()
    {
        return $this->api_path;
    }

    /**
     * @param mixed $api_path
     */
    protected function setApiPath($api_path): void
    {
        $this->api_path = $api_path;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param mixed $api_key
     */
    protected function setApiKey($api_key): void
    {
        $this->api_key = $api_key;
    }

    /**
     * @return mixed
     */
    public function getApiVersion()
    {
        return $this->api_version;
    }

    /**
     * @param mixed $api_version
     */
    protected function setApiVersion($api_version): void
    {
        $this->api_version = $api_version;
    }

    /**
     * @return string
     */
    public function getAppEnv(): string
    {
        return $this->app_env;
    }

    /**
     * @param string $app_env
     */
    protected function setAppEnv(string $app_env): void
    {
        $this->app_env = $app_env;
    }

    /**
     * @return mixed
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param mixed $secure
     */
    protected function setSecure($secure): void
    {
        $this->secure = $secure;
    }

    /**
     * NotifierApi constructor.
     * @param string $api_key
     * @param int $api_version
     * @param bool $secure
     * @param string|null $app_env
     * @param null $domain
     * @throws InvalidNotifierTypeException
     */
    public function __construct(string $api_key, int $api_version, bool $secure = null, string $app_env = null, $domain = null)
    {
        if ($secure === null) {
            $secure = true;
        }
        if ($app_env === null) {
            $app_env = self::PRODUCTION;
        }

        $this->setApiKey($api_key);
        $this->setApiVersion($api_version);
        $this->setSecure($secure);
        if (!in_array($app_env,[self::STAGE,self::TEST,self::PRODUCTION])){
            throw new InvalidNotifierTypeException('Invalid notifier type passed.');
        }else{
            $this->setAppEnv($app_env);
        }
        $this->setApiPath($this->generateApiPath($domain));
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    protected function generateApiPath($domain){
        $secure = $this->generateApiSecure();
        $version = $this->getApiVersion();
        if ($domain) {
            return sprintf(rtrim($domain, '/') . '/api/v%s/', $version);
        }
        switch ($this->getAppEnv()){
            case self::PRODUCTION:
                return sprintf(self::API_PATH,$secure,$version);
                break;
            case self::STAGE:
                return sprintf(self::API_PATH_TEST,$secure,'s',$version);
                break;
            case self::TEST:
                return sprintf(self::API_PATH_TEST,$secure,'t',$version);
                break;
            default:
                return sprintf(self::API_PATH,$secure,$version);
        }
    }

    /**
     * @return string
     */
    protected function generateApiSecure(){
        if ($this->getSecure())
            return 'https';
        return 'http';
    }

    /**
     * @param string $type
     * @return mixed
     * @throws Exception
     */
    public function setType(string $type){
        $namespace = __NAMESPACE__.'\\'.ucfirst(strtolower($type));
        $className = $namespace . '\\' . ucfirst(strtolower($type)).'Notifier';
        /**
         * @var NotifierInterface $className
         */
        if (class_exists($className)) {
            return new $className($this->getApiKey(),$this->getApiVersion(),$this->getSecure(),$this->getAppEnv(), $this->domain);
        } else {
            throw new InvalidNotifierTypeException("Notifier class not found");
        }
    }
}
