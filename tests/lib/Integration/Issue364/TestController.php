<?php

namespace CloudCreativity\LaravelJsonApi\Tests\Integration\Issue364;

use DummyApp\Http\Controllers\PostsController;
use Illuminate\Http\Response;

class TestController extends PostsController
{

    /**
     * @param $data
     * @return Response
     */
    protected function searched($data)
    {
        $meta = ['some' => 'data'];

        return $this->reply()->content($data, [], $meta);
    }
}
