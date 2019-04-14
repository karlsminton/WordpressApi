<?php

namespace Karl\WordpressApi\Block;

use Magento\Framework\View\Element\Template;
use Karl\WordpressApi\Helper\Data;

class AbstractBlock extends Template
{

    protected $helper;

    public function __construct(
        Data $helper,
        Template\Context $context,
        $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }
}
