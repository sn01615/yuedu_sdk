<?php

namespace Yuedu\Book;

/**
 *
 * @author YangLong
 * Date: 2017-10-16
 */
class Client
{

    private $consumerKey, $consumerSecret;

    private $api_url;

    private $production;

    public function __construct($production = true, $consumerKey = null, $consumerSecret = null)
    {
        if ($consumerKey !== null) {
            $this->consumerKey = $consumerKey;
        }
        if ($consumerSecret !== null) {
            $this->consumerSecret = $consumerSecret;
        }
        if ($production) {
            $this->production = true;
        } else {
            $this->production = false;
        }
        if ($this->production) {
            $this->api_url = 'http://api.yuedu.163.com/';
        } else {
            $this->api_url = 'http://testapi.yuedu.163.com/';
        }
    }

    public function setConsumerKey($consumerKey)
    {
        $this->consumerKey = $consumerKey;
    }

    public function setConsumerSecret($consumerSecret)
    {
        $this->consumerSecret = $consumerSecret;
    }

    private function sign($httpMethod, $url, $args)
    {
        ksort($args);
        $_args = implode('', $args);
        return md5("{$httpMethod}{$url}{$_args}{$this->consumerSecret}");
    }

    private function getSign($httpMethod, $url, $args)
    {
        $sign = $this->sign($httpMethod, $url, $args);
        return [
            'sign' => $sign
        ];
    }

    private function timestamp13()
    {
        list ($usec, $sec) = explode(" ", microtime());
        return (float)sprintf('%.0f', ((float)$usec + (float)$sec) * 1000);
    }

    public function category()
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, []);
    }

    public function add(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    public function update(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    public function getList(array $args = [])
    {
        $apiName = $this->getApiName('list');
        $callStr = $apiName;
        return $this->call($callStr, $args);
    }

    public function info(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args);
    }

    public function sections(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args);
    }

    public function content(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args);
    }

    public function chapterAdd(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args);
    }

    public function chapterUpdate(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    public function chapterDelete(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    public function sectionAdd(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    public function sectionUpdate(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    public function sectionDelete(array $args = [])
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, $args, 'POST');
    }

    private function getApiName($functionName)
    {
        $apiName = lcfirst(substr($functionName, strlen('')));
        $apiName = preg_replace('/([A-Z])/', '/$1', $apiName);
        $apiName = strtolower($apiName);
        return $apiName;
    }

    private function fixUrl($url)
    {
        $url = str_replace('book/chapter', 'bookChapter', $url);
        $url = str_replace('book/section/', 'bookSection/', $url);
        return $url;
    }

    private function call($name, $args = [], $httpMethod = 'GET')
    {
        $url = $this->api_url . 'book/' . $name . '.json';
        $url = $this->fixUrl($url);
        $args['timestamp'] = $this->timestamp13();
        $args['consumerKey'] = $this->consumerKey;
        $data = http_build_query(array_merge($this->getSign($httpMethod, $url, $args), $args));
        $_json = $this->doCall($url, $httpMethod, $data);
        $json = json_decode($_json);
        if ($json) {
            return $json;
        } else {
            return $_json;
        }
    }

    private function doCall($url, $httpMethod, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($httpMethod == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ($httpMethod == 'GET') {
            $url .= '?' . $data;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

