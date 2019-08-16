<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Observer\Post;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Model\Post;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ValidateUrlKeyObserver
 */
class ValidateUrlKeyObserver implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        /** @var Post $post */
        $post = $observer->getData('entity');

        if (!$this->isValidUrlKey($post)) {
            throw new LocalizedException(
                __(
                    "The post URL key can't use capital letters or disallowed symbols. "
                    . "Remove the letters and symbols and try again."
                )
            );
        }
    }

    /**
     * @param PostInterface $post
     * @return bool
     */
    private function isValidUrlKey(PostInterface $post): bool
    {
        return (bool)preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $post->getUrlKey());
    }
}
