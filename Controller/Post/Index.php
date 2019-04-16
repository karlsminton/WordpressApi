<?php

namespace Karl\WordpressApi\Controller\Post;

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
        $title = $page->getLayout()->getBlock('single.post')->setParam(
            [
                'key' => 'slug',
                'value' => $this->getRequest()->getParam('post_name')
            ]
        );
        return $page;
    }
}
