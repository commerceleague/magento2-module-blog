<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Model;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Post
 */
class Post extends AbstractModel implements PostInterface
{
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(PostResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->_getData(self::POST_ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($postId)
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * @inheritDoc
     */
    public function isActive()
    {
        return (bool)$this->_getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive($isActive): PostInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->_getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title): PostInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->_getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content): PostInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function getExcerpt()
    {
        return $this->_getData(self::EXCERPT);
    }

    /**
     * @inheritDoc
     */
    public function setExcerpt($excerpt): PostInterface
    {
        return $this->setData(self::EXCERPT, $excerpt);
    }

    /**
     * @inheritDoc
     */
    public function getUrlKey()
    {
        return $this->_getData(self::URL_KEY);
    }

    /**
     * @inheritDoc
     */
    public function setUrlKey($urlKey): PostInterface
    {
        return $this->setData(self::URL_KEY, $urlKey);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->_getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt): PostInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->_getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt): PostInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @return array
     */
    public function getAvailableStatuses(): array
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
