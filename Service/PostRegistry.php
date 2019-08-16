<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Service;

use CommerceLeague\Blog\Api\Data\PostInterface;

/**
 * Class PostRegistry
 */
class PostRegistry
{
    /**
     * @var PostInterface|null
     */
    private $post;

    /**
     * @param PostInterface $post
     * @return PostRegistry
     */
    public function set(PostInterface $post): self
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return PostInterface|null
     */
    public function get(): ?PostInterface
    {
        return $this->post;
    }
}
