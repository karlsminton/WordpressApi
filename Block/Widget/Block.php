<?php

namespace Karl\WordpressApi\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Karl\WordpressApi\Block\Posts;

class Block extends Posts implements BlockInterface
{

    protected $_template = "posts.phtml";

    public function __construct(
        \Karl\WordpressApi\Helper\Data $helper,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($helper, $context, $data);
    }

    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        return $this;
    }

    // Returns single post
    public function getPosts()
    {
        $id = $this->getData('post_id');
        if (!isset($id)) {
            die('No id passed to post widget.');
        }
        $this->helper->setRequest(self::POSTS_ENDPOINT . '/' . $id);
        $response = $this->helper->getResponse();
        $json[0] = json_decode(
            $response->getBody(),
            true
        );
        return $json;
    }
}
