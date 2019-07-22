<?php
/**
 */

namespace CommerceLeague\Blog\Api;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PostRepositoryInterface
{
    /**
     * @param Data\PostInterface $post
     * @return Data\PostInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\PostInterface $post): Data\PostInterface;

    /**
     * @param int $postId
     * @return Data\PostInterface
     * @throws NoSuchEntityException
     */
    public function getById($postId): Data\PostInterface;

    /**
     * @param Data\PostInterface $post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\PostInterface $post): bool;

    /**
     * @param int $postId
     * @return bool
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById($postId): bool;
}
