<?php

namespace Modules\Post\Repositories\Cache;

use Modules\Post\Repositories\PostRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePostDecorator extends BaseCacheDecorator implements PostRepository
{
    public function __construct(PostRepository $post)
    {
        parent::__construct();
        $this->entityName = 'post.posts';
        $this->repository = $post;
    }
}
