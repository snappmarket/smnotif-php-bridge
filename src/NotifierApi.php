<?php


namespace Notifier;

use Exception;
use ReflectionObject;

class NotifierApi
{
    const     PRODUCTION        = "production";
    const     STAGE             = "stage";
    const     TEST              = "test";
    const     API_PATH          = "%s://notif.snapp.market/api/v%s/";
    const     API_PATH_TEST     = "%s://notif.%s.snapp.market/api/v%s/";
    const     SMS               = 'sms';
    const     EMAIL             = 'email';
    const     PUSH              = 'push';
    const     ASYNC_MODE        = 'async';
    const     SYNC_MODE         = 'sync';
    const     BLOCKER_PRIORITY  = 'blocker';
    const     HIGH_PRIORITY     = 'high';
    const     MEDIUM_PRIORITY   = 'medium';
    const     LOW_PRIORITY      = 'low';
    const     DYNAMIC_STRUCTURE = 'dynamic';
    const     STATIC_STRUCTURE  = 'static';
    protected $api_path;
    protected $api_key;
    protected $api_version;
    protected $app_env;
    protected $secure;

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

    public function __construct(string $api_key,int $api_version,bool $secure=true,string $app_env=self::PRODUCTION)
    {
        $this->setApiKey($api_key);
        $this->setApiVersion($api_version);
        $this->setAppEnv($app_env);
        $this->setSecure($secure);
        $this->setApiPath($this->generateApiPath());
    }

    /**
     * @return string
     */
    protected function generateApiPath(){
        $secure = $this->generateApiSecure();
        $version = $this->getApiVersion();
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
        $namespace = __NAMESPACE__.'\\'.strtolower($type);
        $className = $namespace . '\\' . ucfirst($type).'Notifier';
        /**
         * @var NotifierInterface $className
         */
        if (class_exists($className)) {
            return new $className($this->getApiKey(),$this->getApiVersion(),$this->getSecure(),$this->getAppEnv());
        } else {
            throw new Exception("Notifier class not found");
        }
    }
}