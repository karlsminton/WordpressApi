<?php

namespace Karl\WordpressApi\Model\Source\Widget;

use Magento\Framework\Option\ArrayInterface;
use Karl\WordpressApi\Helper\Data;

class Post implements ArrayInterface
{

    const POSTS_ENDPOINT = '/wp-json/wp/v2/posts';

    protected $helper;

    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    public function toOptionArray()
    {
        $options = [];

        foreach ($this->getPosts() as $post) {
            $options[] = [
                'label' => $post['title']['rendered'],
                'value' => $post['id']
            ];
        }

        return $options;
    }

    private function getPosts()
    {
        $this->helper->setRequest(self::POSTS_ENDPOINT);
        $response = $this->helper->getResponse();
        return json_decode(
            $response->getBody(),
            true
        );
    }
}
