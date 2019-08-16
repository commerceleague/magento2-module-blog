<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Model\ResourceModel;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Setup\SchemaInterface;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * Class Post
 */
class Post extends AbstractDb
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @param Context $context
     * @param EntityManager $entityManager
     * @param MetadataPool $metadataPool
     * @param string|null $connectionName
     */
    public function __construct(
        Context $context,
        EntityManager $entityManager,
        MetadataPool $metadataPool,
        string $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->entityManager = $entityManager;
        $this->metadataPool = $metadataPool;
    }

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(SchemaInterface::POST_TABLE, PostInterface::POST_ID);
    }

    /**
     * @param AbstractModel $object
     * @param mixed $value
     * @param null $field
     * @return $this|AbstractDb
     * @throws LocalizedException
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        if ($postId = $this->getPostId($object, $value, $field)) {
            $this->entityManager->load($object, $postId);
        }

        return $this;
    }

    /**
     * @param AbstractModel $object
     * @param $value
     * @param null $field
     * @return bool|int|string
     * @throws LocalizedException
     */
    private function getPostId(AbstractModel $object, $value, $field = null)
    {
        $entityMetadata = $this->metadataPool->getMetadata(PageInterface::class);

        if (!$field) {
            $field = $entityMetadata->getIdentifierField();
        }

        $postId = $value;

        if ($field != $entityMetadata->getIdentifierField()) {
            $select = $this->_getLoadSelect($field, $value, $object);
            $select->reset(Select::COLUMNS)
                ->columns($this->getMainTable() . '.' . $entityMetadata->getIdentifierField())
                ->limit(1);
            $result = $this->getConnection()->fetchCol($select);
            $postId = count($result) ? $result[0] : false;
        }

        return $postId;
    }

    /**
     * @inheritDoc
     */
    public function save(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->entityManager->delete($object);
        return $this;
    }
}
