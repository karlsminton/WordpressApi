<?php

namespace Karl\WordpressApi\Api\Data;

interface WordpressRequestInterface
{

    const TYPE_GET = 'get';

    const TYPE_POST = 'post';

    public function setRequest(String $url, $type = self::TYPE_GET);
}
