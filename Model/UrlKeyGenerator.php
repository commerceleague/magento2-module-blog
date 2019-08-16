<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Model;

use Magento\Framework\Filter\FilterManager;

/**
 * Class UrlKeyGenerator
 */
class UrlKeyGenerator
{
    /**
     * @var FilterManager
     */
    private $filterManager;

    /**
     * @param FilterManager $filterManager
     */
    public function __construct(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }

    /**
     * @param string $value
     * @return string
     */
    public function generateUrlKey(string $value): string
    {
        return $this->filterManager->translitUrl($value);
    }
}
