<p align="center"><img src="https://snapp.market/static/media/logo.d5ee94bf.png" width="200"></p>

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
#### 1- raw php file
The `NotifierApi` class takes four parameters.
- $api_key: The Api Key that your get from Notifier Service.
- $api_version : The api version that you are using ex:1
- $is_secure : if true call service with 'https' else calls with 'http'.
- $app_env : The application envoirnment that you are using (including `NotifierApi::PRODUCTION`, `NotifierApi::STAGE`, `NotifierApi::TEST`)

```php
<?php
require __DIR__ . '/vendor/autoload.php';
$sms_notifgier = new \Notifier\NotifierApi('5df0d20cd6b9c5df0d20cd6ba3',1,true,\Notifier\NotifierApi::PRODUCTION);
try {
    $response = $n->setBypassLimitControl(1) // to bypass time limit control (like activation codes)
        ->setExpireTime('1h 15m') // expires in 1 hour and 15 minutes
        ->setMode('async') // send notification async or sync
        ->setPriority('blocker') // priority : blocker, high, medium, low
        ->setProviderCode('10002') // get sms provider codes from notification service
        ->setSmsBodyStructure('dynamic') // static or dynamic?
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