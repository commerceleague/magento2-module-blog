<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Observer\Post;

use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Service\UrlKeyGeneratorService;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SetUrlKeyObserver
 */
class SetUrlKeyObserver implements ObserverInterface
{
    /**
     * @var UrlKeyGeneratorService
     */
    private $urlKeyGeneratorService;

    /**
     * @param UrlKeyGeneratorService $urlKeyGeneratorService
     */
    public function __construct(UrlKeyGeneratorService $urlKeyGeneratorService)
    {
        $this->urlKeyGeneratorService = $urlKeyGeneratorService;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var Post $post */
        $post = $observer->getData('entity');

        $urlKey = $post->getUrlKey();
        if ($urlKey === '' || $urlKey === null) {
            $post->setUrlKey($this->urlKeyGeneratorService->generateUrlKey($post->getTitle()));
        }
    }
}
