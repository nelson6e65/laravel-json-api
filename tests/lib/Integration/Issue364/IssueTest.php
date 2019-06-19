<?php

namespace CloudCreativity\LaravelJsonApi\Tests\Integration\Issue364;

use CloudCreativity\LaravelJsonApi\Routing\RouteRegistrar;
use CloudCreativity\LaravelJsonApi\Tests\Integration\TestCase;
use DummyApp\Post;

class IssueTest extends TestCase
{

    /**
     * @var bool
     */
    protected $appRoutes = false;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withFluentRoutes()->routes(function (RouteRegistrar $api) {
            $api->resource('posts')->controller('\\' . TestController::class);
        });
    }

    public function test(): void
    {
        factory(Post::class, 3)->create();

        $this->getJsonApi('/api/v1/posts', ['page' => ['number' => 1, 'size' => 2]])->assertExactMeta([
            'some' => 'data',
            'page' => [
                'current-page' => 1,
                'from' => 1,
                'last-page' => 2,
                'per-page' => 2,
                'to' => 2,
                'total' => 3,
            ],
        ]);
    }
}
