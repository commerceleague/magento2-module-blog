<?php
/**
 */

namespace CommerceLeague\Blog\Test\Unit\Observer;

use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Observer\Post\ValidateUrlKeyObserver;
use Magento\Framework\Event\Observer;
use Magento\Framework\Exception\LocalizedException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ValidateUrlKeyObserverTest extends TestCase
{
    /**
     * @var MockObject|Observer
     */
    protected $observer;

    /**
     * @var MockObject|Post
     */
    protected $post;

    /**
     * @var ValidateUrlKeyObserver
     */
    protected $validateUrlKeyObserver;

    protected function setUp()
    {
        $this->observer = $this->createMock(Observer::class);
        $this->post = $this->createMock(Post::class);
        $this->validateUrlKeyObserver = new ValidateUrlKeyObserver();
    }

    public function testExecuteWithInvalidUrlKey()
    {
        $invalidUrlKey = '%&§$ example ?ß§';

        $this->observer->expects($this->once())
            ->method('getData')
            ->with('entity')
            ->willReturn($this->post);

        $this->post->expects($this->once())
            ->method('getUrlKey')
            ->willReturn($invalidUrlKey);

        $this->expectException(LocalizedException::class);

        $this->validateUrlKeyObserver->execute($this->observer);
    }

    public function testExecuteWithValidUrlKey()
    {
        $validUrlKey = 'valid-url-key';

        $this->observer->expects($this->once())
            ->method('getData')
            ->with('entity')
            ->willReturn($this->post);

        $this->post->expects($this->once())
            ->method('getUrlKey')
            ->willReturn($validUrlKey);

        $this->validateUrlKeyObserver->execute($this->observer);
    }


}
