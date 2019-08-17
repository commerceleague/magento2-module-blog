<?php
/**
 */

namespace CommerceLeague\Blog\Test\Unit\Service;

use CommerceLeague\Blog\Service\UrlKeyGeneratorService;
use Magento\Framework\Filter\FilterManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UrlKeyGeneratorServiceTest extends TestCase
{
    /**
     * @var MockObject|FilterManager
     */
    protected $filterManager;

    /**
     * @var UrlKeyGeneratorService
     */
    protected $urlKeyGeneratorService;

    protected function setUp()
    {
        $this->filterManager = $this->createPartialMock(FilterManager::class, ['translitUrl']);
        $this->urlKeyGeneratorService = new UrlKeyGeneratorService(
            $this->filterManager
        );
    }

    public function testGenerateUrlKey()
    {
        $value = 'value';
        $urlKey = 'url-key';

        $this->filterManager->expects($this->once())
            ->method('translitUrl')
            ->with($value)
            ->willReturn($urlKey);

        $this->assertEquals(
            $urlKey,
            $this->urlKeyGeneratorService->generateUrlKey($value)
        );
    }
}
