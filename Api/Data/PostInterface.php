<?php
/**
 */

namespace CommerceLeague\Blog\Api\Data;

/**
 * Interface PostInterface
 */
interface PostInterface
{
    public const POST_ID = 'post_id';
    public const IS_ACTIVE = 'is_active';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const EXCERPT = 'excerpt';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     * @return PostInterface
     */
    public function setId($id);

    /**
     * @return bool|null
     */
    public function isActive();

    /**
     * @param bool|int $isActive
     * @return PostInterface
     */
    public function setIsActive($isActive): self;

    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @param string $title
     * @return PostInterface
     */
    public function setTitle($title): self;

    /**
     * @return string|null
     */
    public function getContent();

    /**
     * @param string $content
     * @return PostInterface
     */
    public function setContent($content): self;

    /**
     * @return string|null
     */
    public function getExcerpt();

    /**
     * @param string $excerpt
     * @return PostInterface
     */
    public function setExcerpt($excerpt): self;

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return PostInterface
     */
    public function setCreatedAt($createdAt): self;

    /**
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * @param string $updatedAt
     * @return PostInterface
     */
    public function setUpdatedAt($updatedAt): self;
}
