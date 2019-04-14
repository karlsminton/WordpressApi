<?php

namespace Karl\WordpressApi\Helper;

use GuzzleHttp\Client;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Karl\WordpressApi\Api\Data\WordpressRequestInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper implements WordpressRequestInterface
{

    protected $http;

    public $result;

    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->http = new Client();
    }

    public function setRequest(String $url, $type = self::TYPE_GET)
    {
        $endpoint = $this->getBaseUrl() . $url;
        $this->result = $this->http->request($type, $endpoint, []);
    }

    public function getResponse()
    {
        try {
            return $this->result;
        } catch(\Exception $e) {
            die($e);
        }
    }

    protected function getBaseUrl()
    {
        return $this->scopeConfig->getValue(
            'karl_wordpress_api/general/wordpress_url',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
