<?php
/**
 */

namespace CommerceLeague\Blog\Test\Unit\Model;

use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Model\PostFactory;
use CommerceLeague\Blog\Model\PostRepository;
use CommerceLeague\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PostRepositoryTest extends TestCase
{
    /**
     * @var MockObject|PostResource
     */
    protected $postResource;

    /**
     * @var MockObject|PostFactory
     */
    protected $postFactory;

    /**
     * @var MockObject|Post
     */
    protected $post;

    /**
     * @var PostRepository
     */
    protected $postRepository;

    protected function setUp()
    {
        $this->postResource = $this->createMock(PostResource::class);

        $this->postFactory = $this->getMockBuilder(PostFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->post = $this->createMock(Post::class);

        $this->postFactory->expects($this->any())
            ->method('create')
            ->willReturn($this->post);

        $this->postRepository = new PostRepository(
            $this->postResource,
            $this->postFactory
        );
    }

    public function testSaveCouldNotSave()
    {
        $this->postResource->expects($this->once())
            ->method('save')
            ->with($this->post)
            ->willThrowException(new \Exception('an exception message'));

        $this->expectException(CouldNotSaveException::class);
        $this->expectExceptionMessage('an exception message');

        $this->postRepository->save($this->post);
    }

    public function testSave()
    {
        $this->postResource->expects($this->once())
            ->method('save')
            ->with($this->post)
            ->willReturnSelf();

        $this->assertSame($this->post, $this->postRepository->save($this->post));
    }

    public function testGetByCouldNotLoad()
    {
        $postId = 123;

        $this->postResource->expects($this->once())
            ->method('load')
            ->with($this->post, $postId);

        $this->post->expects($this->once())
            ->method('getId')
            ->willReturn(null);

        $this->expectException(NoSuchEntityException::class);
        $this->expectExceptionMessage(__('The post with the "%1" ID doesn\'t exist.', $postId)->__toString());

        $this->postRepository->getById($postId);
    }

    public function testGetById()
    {
        $postId = 123;

        $this->postResource->expects($this->once())
            ->method('load')
            ->with($this->post, $postId);

        $this->post->expects($this->once())
            ->method('getId')
            ->willReturn($postId);

        $this->assertSame(
            $this->post,
            $this->postRepository->getById($postId)
        );
    }

    public function testDeleteCouldNotDelete()
    {
        $exceptionMessage = 'an exception message';

        $this->postResource->expects($this->once())
            ->method('delete')
            ->with($this->post)
            ->willThrowException(new \Exception($exceptionMessage));

        $this->expectException(CouldNotDeleteException::class);
        $this->expectExceptionMessage(__($exceptionMessage)->__toString());

        $this->postRepository->delete($this->post);
    }

    public function testDelete()
    {
        $this->postResource->expects($this->once())
            ->method('delete')
            ->with($this->post);

        $this->assertTrue($this->postRepository->delete($this->post));
    }

    public function testDeleteByIdCouldNotLoadById()
    {
        $postId = 123;

        $this->postResource->expects($this->once())
            ->method('load')
            ->with($this->post, $postId);

        $this->post->expects($this->once())
            ->method('getId')
            ->willReturn(null);

        $this->expectException(NoSuchEntityException::class);
        $this->expectExceptionMessage(__('The post with the "%1" ID doesn\'t exist.', $postId)->__toString());

        $this->postRepository->deleteById($postId);
    }

    public function testDeleteByIdCouldNotDelete()
    {
        $postId = 123;

        $this->postResource->expects($this->once())
            ->method('load')
            ->with($this->post, $postId);

        $this->post->expects($this->once())
            ->method('getId')
            ->willReturn($postId);

        $exceptionMessage = 'an exception message';

        $this->postResource->expects($this->once())
            ->method('delete')
            ->with($this->post)
            ->willThrowException(new \Exception($exceptionMessage));

        $this->expectException(CouldNotDeleteException::class);
        $this->expectExceptionMessage(__($exceptionMessage)->__toString());

        $this->postRepository->deleteById($postId);
    }

    public function testDeleteById()
    {
        $postId = 123;

        $this->postResource->expects($this->once())
            ->method('load')
            ->with($this->post, $postId);

        $this->post->expects($this->once())
            ->method('getId')
            ->willReturn($postId);

        $this->postResource->expects($this->once())
            ->method('load')
            ->with($this->post, $postId);

        $this->post->expects($this->once())
            ->method('getId')
            ->willReturn($postId);

        $this->assertTrue($this->postRepository->deleteById($postId));
    }
}
