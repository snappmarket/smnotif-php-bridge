<p align="center"><a href="https://snapp.market" target="_blank"><img src="https://snapp.market/static/media/logo.d5ee94bf.png" width="200"></a></p>

## SnappMarket Notification Service PHP Bridge
This readme file helps you to create a new sms template or get your own sms templates registered before.
### Register New Sms Template
```php
use Notifier\NotifierApi;
use Notifier\sms\SmsTemplate;

$api_token = "Your API Token";
$api_version = 1;
$is_secure = true;
$app_env = NotifierApi::PRODUCTION;
$sms_template = new SmsTemplate($api_token,$api_version,$is_secure,$app_env);
$template_name = 'activation_code';
$template_title = 'Activation Code Template';
$template_code = 'tst_act_673';
$template_body = 'Your activation code is {{code}}.';
try {
    $response = $sms_template->setName($template_name)
                ->setTitle($template_title)
                ->setTemplateCode($template_code)
                ->setTemplateBody($template_body)
                ->registerTemplate();
 }catch (\Exception $exception){
 throw $exception;
}
```

### Get Your Sms Templates List
```php
use Notifier\NotifierApi;
use Notifier\sms\SmsTemplate;

$api_token = "Your API Token";
$api_version = 1;
$is_secure = true;
$app_env = NotifierApi::PRODUCTION;
$sms_template = new SmsTemplate($api_token,$api_version,$is_secure,$app_env);
try {
    $response = $sms_template->getTemplates();
 }catch (\Exception $exception){
 throw $exception;
}
```