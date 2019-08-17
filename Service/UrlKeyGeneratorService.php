<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Service;

use Magento\Framework\Filter\FilterManager;

/**
 * Class UrlKeyGeneratorService
 */
class UrlKeyGeneratorService
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
