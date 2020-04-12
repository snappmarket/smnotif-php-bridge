<p align="center"><a href="https://snapp.market" target="_blank"><img src="https://snapp.market/static/media/logo.d5ee94bf.png" width="200"></a></p>
<p align="center">
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/composerlock" alt="License"></a>
</p>

## SnappMarket Notification Service PHP Bridge
This package developed to use <a href="https://snapp.market">SnappMarket</a> Notification Service.
#### To see full documentation check:
* TEST : [TEST Documentations](https://notif.t.snapp.market/api/documentation)
* STAGING : [STAGING Documentations](https://notif.s.snapp.market/api/documentation)
* PRODUCTION : [PRODUCTION Documentations](https://notif.snapp.market/api/documentation) <br>
(note : Don't forget to set Swagger-Token as request header. Value of Swagger-Token is the api key you can get it from Snappmarket Notifier Service)
### Requirements
- `PHP >= 7.2.0`
- `JSON PHP Extension`
### installation
require package inside your `composer.json` file.

`$ composer require snappmarket/smnotif-php-bridge
`

### Basic Usage To Send SMS Notification
You can use it inside a raw php file or project or a php framework like Laravel or Symfony.
The `NotifierApi` class takes four parameters.
- `$api_key` : The Api Key that your get from Notifier Service.
- `$api_version` : The api version that you are using ex:1
- `$is_secure` : if true call service with 'https' else calls with 'http'.
- `$app_env` : The application environment that you are using (including `NotifierApi::PRODUCTION`, `NotifierApi::STAGE`, `NotifierApi::TEST`)
#### 1- raw php file

```php
<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $api_token = "Your API Token";
    $api_version = 1;
    $is_secure = true;
    $app_env = \Notifier\NotifierApi::PRODUCTION;
    $notifier = new \Notifier\NotifierApi($api_token,$api_version,$is_secure,$app_env);
    $sms_notifier = $notifier->setType(\Notifier\NotifierApi::SMS);
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
} catch (Exception $e) {
    throw $e;
}
?>
```
#### 2- inside php class
```php
use Notifier\NotifierApi;

try {
    $api_token = "Your API Token";
    $api_version = 1;
    $is_secure = true;
    $app_env = NotifierApi::PRODUCTION;
    $notifier = new NotifierApi($api_token,$api_version,$is_secure,$app_env);
    $sms_notifier = $notifier->setType(\Notifier\NotifierApi::SMS);
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
} catch (Exception $e) {
    throw $e;
}
```

### Examples
 - To register a new sms template check [Sms Template Examples](docs/SmsTemplate.md)
 - More examples to send sms notifications [Send Sms Notifications Examples](docs/SendSmsExamples.md)
 