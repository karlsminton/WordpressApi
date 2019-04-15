<?php

namespace Karl\WordpressApi\Controller;

use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class CustomRouter implements RouterInterface
{

    protected $actionFactory;

    protected $_response;

    private $scopeConfig;

    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
        $this->scopeConfig = $scopeConfig;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        if (!$route = $this->getCustomRoute()) {
            return false;
        }

        if($identifier == $route) {
            $request->setModuleName('wordpressapi')-> //module name
            setControllerName('index')-> //controller name
            setActionName('index');//-> //action name
            //setParam('param', 3); //custom parameters
       }
       else {
           return false;
       }

       return $this->actionFactory->create(
           'Magento\Framework\App\Action\Forward',
           ['request' => $request]
       );
   }

   private function getCustomRoute()
   {
      return $this->scopeConfig->getValue(
          'karl_wordpress_api/general/route_name',
          ScopeInterface::SCOPE_STORE
      );
   }
}
