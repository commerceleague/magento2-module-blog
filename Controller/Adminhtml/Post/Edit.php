<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Controller\Adminhtml\Post;

use CommerceLeague\Blog\Api\PostRepositoryInterface;
use CommerceLeague\Blog\Controller\Adminhtml\AbstractPost;
use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Model\PostFactory;
use CommerceLeague\Blog\Service\PostRegistry;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page as ResultPage;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory as ResultPageFactory;

/**
 * Class Edit
 */
class Edit extends AbstractPost implements HttpGetActionInterface
{
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var PostRegistry
     */
    private $postRegistry;

    /**
     * @var ResultPageFactory
     */
    private $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param PostFactory $postFactory
     * @param PostRepositoryInterface $postRepository
     * @param PostRegistry $postRegistry
     * @param ResultPageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository,
        PostRegistry $postRegistry,
        ResultPageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        $this->postRegistry = $postRegistry;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var Post $post */
        $post = $this->postFactory->create();
        $id = $this->getRequest()->getParam('post_id');

        if ($id) {
            try {
                $post = $this->postRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This post no longer exists.'));

                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->postRegistry->set($post);

        /** @var ResultPage $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Post') : __('New Post'),
            $id ? __('Edit Post') : __('New Post')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Posts'));
        $resultPage->getConfig()->getTitle()->prepend($post->getId() ? $post->getTitle() : __('New Post'));

        return $resultPage;
    }
}
