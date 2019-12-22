<p align="center"><a href="https://snapp.market" target="_parent"><img src="https://snapp.market/static/media/logo.d5ee94bf.png" width="200"></a></p>

## SnappMarket Notification Service PHP Bridge
This package developed to use <a href="https://snapp.market">SnappMarket</a> Notification Service.
### Requirements
- `PHP >= 7.2.0`
- `JSON PHP Extension`
### installation
require package inside your `package.json` file.

`$ composer require snappmarket/smnotif-php-bridge
`

### Basic Usage To Send SMS Notification
You can use it inside a raw php file or project or a php framework like Laravel or Symfony.
The `NotifierApi` class takes four parameters.
- $api_key: The Api Key that your get from Notifier Service.
- $api_version : The api version that you are using ex:1
- $is_secure : if true call service with 'https' else calls with 'http'.
- $app_env : The application environment that you are using (including `NotifierApi::PRODUCTION`, `NotifierApi::STAGE`, `NotifierApi::TEST`)
#### 1- raw php file

```php
<?php
require __DIR__ . '/vendor/autoload.php';
$api_token = "Your API Token";
$api_version = 1;
$is_secure = true;
$app_env = \Notifier\NotifierApi::PRODUCTION;
$notifier = new \Notifier\NotifierApi($api_token,$api_version,$is_secure,$app_env);
$sms_notifier = $notifier->setType(\Notifier\NotifierApi::SMS);
try {
    $response = $sms_notifier->setBypassLimitControl(1) // to bypass time limit control (like activation codes)
        ->setExpireTime('1h 15m') // expires in 1 hour and 15 minutes
        ->setMode(\Notifier\NotifierApi::ASYNC_MODE) // send notification async or sync
        ->setPriority(\Notifier\NotifierApi::BLOCKER_PRIORITY) // priority : blocker, high, medium, low
        ->setProviderCode('10002') // get sms provider codes from notification service
        ->setSmsBodyStructure(\Notifier\NotifierApi::DYNAMIC_STRUCTURE) // static or dynamic?
        ->setSmsBody('Hello {{name}}. Your discount is {{discount}}!!') // sms body (you can also use sms templates)
        ->setReceivers([
            [
                'number' => "0939*******",
                'sms_template_data' => [
                    'name' => 'Alireza Jangi',
                    'discount' => 45
                ]
            ],
            [
                'number' => "0937*******",
                'sms_template_data' => [
                    'name' => 'Another Name',
                    'discount' => 77
                ]
            ]
        ])
        ->send();
    die($response);
} catch (Exception $e) {
    throw $e;
}
?>
```
#### 2- inside php class
```php
use Notifier\NotifierApi;


$api_token = "Your API Token";
$api_version = 1;
$is_secure = true;
$app_env = NotifierApi::PRODUCTION;
$notifier = new NotifierApi($api_token,$api_version,$is_secure,$app_env);
$sms_notifier = $notifier->setType(\Notifier\NotifierApi::SMS);
try {
    $response = $sms_notifier->setBypassLimitControl(1) // to bypass time limit control (like activation codes)
        ->setExpireTime('1h 15m') // expires in 1 hour and 15 minutes
        ->setMode(NotifierApi::ASYNC_MODE) // send notification async or sync
        ->setPriority(NotifierApi::BLOCKER_PRIORITY) // priority : blocker, high, medium, low
        ->setProviderCode('10002') // get sms provider codes from notification service
        ->setSmsBodyStructure(NotifierApi::DYNAMIC_STRUCTURE) // static or dynamic?
        ->setSmsBody('Hello {{name}}. Your discount is {{discount}}!!') // sms body (you can also use sms templates)
        ->setReceivers([
            [
                'number' => "0939*******",
                'sms_template_data' => [
                    'name' => 'Alireza Jangi',
                    'discount' => 45
                ]
            ],
            [
                'number' => "0937*******",
                'sms_template_data' => [
                    'name' => 'Another Name',
                    'discount' => 77
                ]
            ]
        ])
        ->send();
    die($response);
} catch (Exception $e) {
    throw $e;
}
```