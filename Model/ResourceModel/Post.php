<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Model\ResourceModel;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Setup\SchemaInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 */
class Post extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(SchemaInterface::POST_TABLE, PostInterface::POST_ID);
    }
}
