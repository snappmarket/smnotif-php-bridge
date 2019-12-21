<?php


namespace Notifier\http;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\TransferException;

class SmsApiCall
{
    protected $url;
    protected $method;
    protected $headers;
    protected $client;
    protected $payload;
    public function __construct($url,$method,$headers,$payload)
    {
        $this->url      = $url;
        $this->method   = $method;
        $this->client   = new Client(['timeout' => 10]);
        $this->headers  = $headers;
        $this->payload  = $payload;
    }

    /**
     * @return string
     * @throws TransferException
     */
    public function execute()
    {
        $request = new Request($this->method,$this->url,$this->headers,$this->payload);
        try {
            $response = $this->client->send($request);
            return $response->getBody();
        }catch (ConnectException $exception){
            throw $exception;
        }catch (ServerException $exception){
            return $exception->getResponse();
        }catch (ClientException $exception){
            return $exception->getResponse()->getBody();
        }
    }

    public function executeSendFile()
    {
        $params = [];
        foreach ($this->payload as $key => $value){
            $params[] = ['name' => $key, 'contents' => $value];
        }
        try {
            $response = $this->client->request('POST', 'http://local.me/api/v1/send/sms', [
                'headers' => $this->headers,
                'multipart' => $params,
            ]);
            return $response->getBody();
        } catch (ConnectException $exception){
            throw $exception;
        } catch (ServerException $exception) {
            return $exception->getResponse();
        } catch (ClientException $exception){
            return $exception->getResponse()->getBody();
        } catch (RequestException $exception){
            throw $exception;
        }
    }
}