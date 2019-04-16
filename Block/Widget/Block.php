<?php

namespace Karl\WordpressApi\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Karl\WordpressApi\Block\Posts;

class Block extends Posts implements BlockInterface
{

    protected $_template = "posts.phtml";

    protected $params;

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
        if (!isset($id) && $this->params == null) {
            die('No id passed to post widget.');
        }
        if (isset($this->params)) {
            $request = $this->params;
        } else {
            $request = self::POSTS_ENDPOINT . '/' . $id;
        }

        $this->helper->setRequest($request);

        $response = $this->helper->getResponse();
        $json = json_decode(
            $response->getBody(),
            true
        );
        return $json;
    }

    public function setParam($params)
    {
        if ($params) {
            $this->params = self::POSTS_ENDPOINT . '?' . $params['key'] . '=' . $params['value'];
        }
    }
}
