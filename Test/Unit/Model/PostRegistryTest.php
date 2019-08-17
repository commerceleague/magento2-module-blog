<?php
/**
 */

namespace CommerceLeague\Blog\Test\Unit\Model;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Model\PostRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PostRegistryTest extends TestCase
{
    /**
     * @var MockObject|PostInterface
     */
    protected $post;

    /**
     * @var PostRegistry
     */
    protected $postRegistry;

    protected function setUp()
    {
        $this->post = $this->createMock(PostInterface::class);
        $this->postRegistry = new PostRegistry();
    }

    public function testSet()
    {
        $this->postRegistry->set($this->post);
        $this->assertSame($this->post, $this->postRegistry->get());
    }

    public function testGet()
    {
        $this->assertNull($this->postRegistry->get());

        $this->postRegistry->set($this->post);
        $this->assertSame($this->post, $this->postRegistry->get());
    }
}
