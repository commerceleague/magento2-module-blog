<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Observer\Post;

use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Model\UrlKeyGenerator;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SetUrlKeyObserver
 */
class SetUrlKeyObserver implements ObserverInterface
{
    /**
     * @var UrlKeyGenerator
     */
    private $urlKeyGenerator;

    /**
     * @param UrlKeyGenerator $urlKeyGenerator
     */
    public function __construct(UrlKeyGenerator $urlKeyGenerator)
    {
        $this->urlKeyGenerator = $urlKeyGenerator;
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
            $post->setUrlKey($this->urlKeyGenerator->generateUrlKey($post->getTitle()));
        }
    }
}
