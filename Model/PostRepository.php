<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Model;

use CommerceLeague\Blog\Api\Data;
use CommerceLeague\Blog\Api\PostRepositoryInterface;
use CommerceLeague\Blog\Model\ResourceModel\Post as PostResource;
use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;

/**
 * Class PostRepository
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostResource
     */
    private $postResource;

    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @param PostResource $postResource
     * @param PostFactory $postFactory
     */
    public function __construct(
        PostResource $postResource,
        PostFactory $postFactory
    ) {
        $this->postResource = $postResource;
        $this->postFactory = $postFactory;
    }

    /**
     * @param Data\PostInterface|AbstractModel $post
     * @return Data\PostInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\PostInterface $post): Data\PostInterface
    {
        try {
            $this->postResource->save($post);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $post;
    }

    /**
     * @inheritDoc
     */
    public function getById($postId): Data\PostInterface
    {
        /** @var Post $post */
        $post = $this->postFactory->create();
        $this->postResource->load($post, $postId);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('The post with the "%1" ID doesn\'t exist.', $postId));
        }

        return $post;
    }

    /**
     * @param Data\PostInterface|AbstractModel $post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\PostInterface $post): bool
    {
        try {
            $this->postResource->delete($post);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($postId): bool
    {
        return $this->delete($this->getById($postId));
    }
}
