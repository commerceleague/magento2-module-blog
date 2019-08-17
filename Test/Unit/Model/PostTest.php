<?php
/**
 */

namespace CommerceLeague\Blog\Test\Unit\Model;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\Context;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /**
     * @var MockObject|Context
     */
    protected $context;

    /**
     * @var MockObject|PostResource
     */
    protected $resource;

    /**
     * @var Post
     */
    protected $post;

    protected function setUp()
    {
        $this->context = $this->createMock(Context::class);
        $this->resource = $this->createMock(PostResource::class);

        $this->post = (new ObjectManager($this))->getObject(
            Post::class,
            [
                'context' => $this->context,
                'resource' => $this->resource
            ]
        );
    }

    public function testGetId()
    {
        $postId = 123;
        $this->post->setData(PostInterface::POST_ID, $postId);
        $this->assertEquals($postId, $this->post->getId());
    }

    public function testSetId()
    {
        $postId = 123;
        $this->post->setId($postId);
        $this->assertEquals($postId, $this->post->getData(PostInterface::POST_ID));
    }

    public function testIsActive()
    {
        $this->post->setData(PostInterface::IS_ACTIVE, true);
        $this->assertTrue($this->post->isActive());
    }

    public function testSetIsActive()
    {
        $this->post->setIsActive(false);
        $this->assertFalse($this->post->getData(PostInterface::IS_ACTIVE));
    }

    public function testGetTitle()
    {
        $title = 'title';
        $this->post->setData(PostInterface::TITLE, $title);
        $this->assertEquals($title, $this->post->getTitle());
    }

    public function testSetTitle()
    {
        $title = 'title';
        $this->post->setTitle($title);
        $this->assertEquals($title, $this->post->getData(PostInterface::TITLE));
    }

    public function testGetContent()
    {
        $content = 'content';
        $this->post->setData(PostInterface::CONTENT, $content);
        $this->assertEquals($content, $this->post->getContent());
    }

    public function testSetContent()
    {
        $content = 'content';
        $this->post->setContent($content);
        $this->assertEquals($content, $this->post->getData(PostInterface::CONTENT));
    }

    public function testGetExcerpt()
    {
        $excerpt = 'excerpt';
        $this->post->setData(PostInterface::EXCERPT, $excerpt);
        $this->assertEquals($excerpt, $this->post->getExcerpt());
    }

    public function testSetExcerpt()
    {
        $excerpt = 'excerpt';
        $this->post->setExcerpt($excerpt);
        $this->assertEquals($excerpt, $this->post->getData(PostInterface::EXCERPT));

    }

    public function testGetUrlKey()
    {
        $urlKey = 'urlKey';
        $this->post->setData(PostInterface::URL_KEY, $urlKey);
        $this->assertEquals($urlKey, $this->post->getUrlKey());
    }

    public function testSetUrlKey()
    {
        $urlKey = 'urlKey';
        $this->post->setUrlKey($urlKey);
        $this->assertEquals($urlKey, $this->post->getData(PostInterface::URL_KEY));
    }

    public function testGetMetaTitle()
    {
        $metaTitle = 'metaTitle';
        $this->post->setData(PostInterface::META_TITLE, $metaTitle);
        $this->assertEquals($metaTitle, $this->post->getMetaTitle());
    }

    public function testSetMetaTitle()
    {
        $metaTitle = 'metaTitle';
        $this->post->setMetaTitle($metaTitle);
        $this->assertEquals($metaTitle, $this->post->getData(PostInterface::META_TITLE));
    }

    public function testGetMetaKeywords()
    {
        $metaKeywords = 'metaKeywords';
        $this->post->setData(PostInterface::META_KEYWORDS, $metaKeywords);
        $this->assertEquals($metaKeywords, $this->post->getMetaKeywords());
    }

    public function testSetMetaKeywords()
    {
        $metaKeywords = 'metaKeywords';
        $this->post->setMetaKeywords($metaKeywords);
        $this->assertEquals($metaKeywords, $this->post->getData(PostInterface::META_KEYWORDS));
    }

    public function testGetMetaDescription()
    {
        $metaDescription = 'metaDescription';
        $this->post->setData(PostInterface::META_DESCRIPTION, $metaDescription);
        $this->assertEquals($metaDescription, $this->post->getMetaDescription());
    }

    public function testSetMetaDescription()
    {
        $metaDescription = 'metaDescription';
        $this->post->setMetaDescription($metaDescription);
        $this->assertEquals($metaDescription, $this->post->getData(PostInterface::META_DESCRIPTION));
    }

    public function testGetCreatedAt()
    {
        $createdAt = '2019-01-01 00:00:00';
        $this->post->setData(PostInterface::CREATED_AT, $createdAt);
        $this->assertEquals($createdAt, $this->post->getCreatedAt());
    }

    public function testSetCreatedAt()
    {
        $createdAt = '2019-01-01 00:00:00';
        $this->post->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $this->post->getData(PostInterface::CREATED_AT));
    }

    public function testGetUpdatedAt()
    {
        $updatedAt = '2019-01-01 00:00:00';
        $this->post->setData(PostInterface::UPDATED_AT, $updatedAt);
        $this->assertEquals($updatedAt, $this->post->getUpdatedAt());
    }

    public function testSetUpdatedAt()
    {
        $updatedAt = '2019-01-01 00:00:00';
        $this->post->setUpdatedAt($updatedAt);
        $this->assertEquals($updatedAt, $this->post->getData(PostInterface::UPDATED_AT));
    }

    public function testGetAvailableStatuses()
    {
        $expected = [
            Post::STATUS_ENABLED => __('Enabled'),
            Post::STATUS_DISABLED => __('Disabled')
        ];

        $this->assertEquals(
            $this->post->getAvailableStatuses(),
            $expected
        );
    }
}
