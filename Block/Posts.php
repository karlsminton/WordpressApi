<?php

namespace Karl\WordpressApi\Block;

use Magento\Framework\View\Element\Template;
use Karl\WordpressApi\Helper\Data;

class Posts extends AbstractBlock
{

    const POSTS_ENDPOINT = '/wp-json/wp/v2/posts';

    public function getPosts()
    {
        $this->helper->setRequest(self::POSTS_ENDPOINT);
        $response = $this->helper->getResponse();
        return json_decode(
            $response->getBody(),
            true
        );
    }
}
