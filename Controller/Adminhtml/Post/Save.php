<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Controller\Adminhtml\Post;

use CommerceLeague\Blog\Api\PostRepositoryInterface;
use CommerceLeague\Blog\Controller\Adminhtml\AbstractPost;
use CommerceLeague\Blog\Model\Post;
use CommerceLeague\Blog\Model\PostFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect as ResultRedirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Save
 */
class Save extends AbstractPost implements HttpPostActionInterface
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
     * @param Action\Context $context
     * @param PostFactory $postFactory
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        Action\Context $context,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var ResultRedirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Post::STATUS_ENABLED;
            }

            if (empty($data['post_id'])) {
                $data['post_id'] = null;
            }

            /** @var Post $post */
            $post = $this->postFactory->create();
            $id = $this->getRequest()->getParam('post_id');

            if ($id) {
                try {
                    $post = $this->postRepository->getById($id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__('This post no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $post->setData($data);

            try {
                $this->postRepository->save($post);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                return $this->prepareResultRedirect($post, $data, $resultRedirect);
            } catch (CouldNotSaveException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['post_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param Post $post
     * @param array $data
     * @param ResultInterface|ResultRedirect $resultRedirect
     * @return ResultInterface
     */
    private function prepareResultRedirect(
        Post $post,
        array $data,
        ResultInterface $resultRedirect
    ): ResultInterface {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['post_id' => $post->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        }

        return $resultRedirect;
    }
}
