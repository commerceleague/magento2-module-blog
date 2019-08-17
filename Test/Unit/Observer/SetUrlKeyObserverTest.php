<?php
/**
 */

namespace CommerceLeague\Blog\Test\Unit\Observer;

use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Observer\Post\SetUrlKeyObserver;
use CommerceLeague\Blog\Service\UrlKeyGeneratorService;
use Magento\Framework\Event\Observer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SetUrlKeyObserverTest extends TestCase
{
    /**
     * @var MockObject|UrlKeyGeneratorService
     */
    protected $urlKeyGeneratorService;

    /**
     * @var MockObject|Observer
     */
    protected $observer;

    /**
     * @var MockObject|Post
     */
    protected $post;

    /**
     * @var SetUrlKeyObserver
     */
    protected $setUrlKeyObserver;

    protected function setUp()
    {
        $this->urlKeyGeneratorService = $this->createMock(UrlKeyGeneratorService::class);
        $this->observer = $this->createMock(Observer::class);
        $this->post = $this->createMock(Post::class);

        $this->setUrlKeyObserver = new SetUrlKeyObserver(
            $this->urlKeyGeneratorService
        );
    }

    public function testExecuteSetsUrlKey()
    {
        $title = 'the title';
        $urlKey = 'the-title';

        $this->observer->expects($this->once())
            ->method('getData')
            ->with('entity')
            ->willReturn($this->post);

        $this->post->expects($this->once())
            ->method('getUrlKey')
            ->willReturn(null);

        $this->post->expects($this->once())
            ->method('getTitle')
            ->willReturn($title);

        $this->urlKeyGeneratorService->expects($this->once())
            ->method('generateUrlKey')
            ->with($title)
            ->willReturn($urlKey);

        $this->post->expects($this->once())
            ->method('setUrlKey')
            ->with($urlKey)
            ->willReturnSelf();

        $this->setUrlKeyObserver->execute($this->observer);
    }

    public function testExecuteDoesNotSetUrlKey()
    {
        $this->observer->expects($this->once())
            ->method('getData')
            ->with('entity')
            ->willReturn($this->post);

        $this->post->expects($this->once())
            ->method('getUrlKey')
            ->willReturn('urlKey');

        $this->post->expects($this->never())
            ->method('getTitle');

        $this->setUrlKeyObserver->execute($this->observer);
    }
}
