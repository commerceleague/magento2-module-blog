<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Block\Adminhtml\Post\Edit;


use CommerceLeague\Blog\Api\PostRepositoryInterface;
use CommerceLeague\Blog\Service\PostRegistry;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

abstract class AbstractGenericButton
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var PostRegistry
     */
    private $postRegistry;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @param Context $context
     * @param PostRegistry $postRegistry
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        Context $context,
        PostRegistry $postRegistry,
        PostRepositoryInterface $postRepository
    ) {
        $this->context = $context;
        $this->postRegistry = $postRegistry;
        $this->postRepository = $postRepository;
    }

    /**
     * @return int|null
     */
    protected function getPostId(): ?int
    {
        if (($currentPost = $this->postRegistry->get()) && $currentPost->getId()) {
            return (int)$currentPost->getId();
        }

        try {
            return (int)$this->postRepository->getById(
                $this->context->getRequest()->getParam('post_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            // noop
        }

        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
