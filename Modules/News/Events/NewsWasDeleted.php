<?php

namespace Modules\News\Events;


use Modules\Media\Contracts\DeletingMedia;
use Modules\News\Entities\News;

class NewsWasDeleted implements DeletingMedia
{
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->news->id;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return get_class($this->news);
    }
}
{

}