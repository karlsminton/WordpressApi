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
        $route = explode('/', $request->getOriginalPathInfo());
        array_shift($route);

        if ($route[0] == $this->getCustomRoute()) {
            //module name - controller name - action name - parameters
            $request->setModuleName('wordpressapi');
            $request->setActionName('index');
            if (isset($route[1])) {
                $request->setControllerName('post');
                $request->setParam('post_name', $route['1']);
            }
            else {
                $request->setControllerName('index');
            }
            $request->setActionName('index');
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
