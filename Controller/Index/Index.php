<?php

namespace Karl\WordpressApi\Controller\Index;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action\Action
{

    protected $pageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $page = $this->pageFactory->create();
        return $page;
    }
}
