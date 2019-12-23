<p align="center"><a href="https://snapp.market" target="_blank"><img src="https://snapp.market/static/media/logo.d5ee94bf.png" width="200"></a></p>

## SnappMarket Notification Service PHP Bridge
This readme file helps you to see some available ways to send sms notifications.

##### Dynamic Body (Not using registered sms templates) 
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

##### Dynamic Body (Using registered sms templates) 
```php
use Notifier\NotifierApi;

try {
    $api_token = "Your API Token";
    $api_version = 1;
    $is_secure = true;
    $app_env = NotifierApi::PRODUCTION;
    $notifier = new NotifierApi($api_token,$api_version,$is_secure,$app_env);
    $sms_notifier = $notifier->setType(\Notifier\NotifierApi::SMS);
    $template_code = 'sms_template_code for specific template registered before'; // see /docs/SmsTemplate.md
    $response = $sms_notifier->setBypassLimitControl(1) // to bypass time limit control (like activation codes)
        ->setExpireTime('1h 15m') // expires in 1 hour and 15 minutes
        ->setMode(NotifierApi::ASYNC_MODE) // send notification async or sync
        ->setPriority(NotifierApi::BLOCKER_PRIORITY) // priority : blocker, high, medium, low
        ->setProviderCode('10002') // get sms provider codes from notification service
        ->setSmsBodyStructure(NotifierApi::DYNAMIC_STRUCTURE) // static or dynamic?
        ->setSmsTemplateCode($template_code)
        ->setReceivers([
            [
                'number' => "0939*******",
                'sms_template_data' => [ // ==> it depends on your sms template data
                    'name' => 'Alireza Jangi',
                    'discount' => 45
                ]
            ],
            [
                'number' => "0937*******",
                'sms_template_data' => [ // ==> it depends on your sms template data
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

##### Dynamic Body (Using .xls file)
**note** : _In this version we just support .xls files._
```php
use Notifier\NotifierApi;

try {
    $api_token = "Your API Token";
    $api_version = 1;
    $is_secure = true;
    $app_env = NotifierApi::PRODUCTION;
    $notifier = new NotifierApi($api_token,$api_version,$is_secure,$app_env);
    $sms_notifier = $notifier->setType(\Notifier\NotifierApi::SMS);
    $template_code = 'sms_template_code for specific template registered before'; // see /docs/SmsTemplate.md
    $response = $sms_notifier->setBypassLimitControl(1)
            ->setExpireTime('1h 15m') // expires in 1 hour and 15 minutes
            ->setMode(NotifierApi::ASYNC_MODE) // send notification async or sync
            ->setPriority(NotifierApi::BLOCKER_PRIORITY) // priority : blocker, high, medium, low
            ->setProviderCode('10002') // get sms provider codes from notification service
            ->setSmsBodyStructure(NotifierApi::STATIC_STRUCTURE) // you set it to static in this type
            ->setSmsTemplateCode($template_code)
            ->setReceiversFile($_FILES['receivers_file']['tmp_name']) // A sample.xls excel file exits in /docs directory
            ->sendByFile();
} catch (Exception $e) {
    throw $e;
}
```

##### Static Body
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
        ->setSmsBodyStructure(NotifierApi::STATIC_STRUCTURE) // you set it to static in this type
        ->setSmsBody('This is a test message without any variables!!') // sms body (you can also use sms templates)
        ->setReceivers([
            [
                'number' => "0939*******",
            ],
            [
                'number' => "0937*******",
            ]
        ])
        ->send();
} catch (Exception $e) {
    throw $e;
}
```

