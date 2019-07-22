<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Model\ResourceModel\Post;

use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Post::class, PostResource::class);
    }
}
