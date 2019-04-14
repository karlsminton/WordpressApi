<?php

namespace Karl\WordpressApi\Block;

use Magento\Framework\View\Element\Template;

class Pages extends AbstractBlock
{

    const PAGES_ENDPOINT = '/wp-json/wp/v2/pages';

    public function getPages()
    {
        $this->helper->setRequest(self::PAGES_ENDPOINT);
        $response = $this->helper->getResponse();
        return json_decode(
            $response->getBody(),
            true
        );
    }
}
