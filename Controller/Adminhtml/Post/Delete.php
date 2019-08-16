<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Controller\Adminhtml\Post;

use CommerceLeague\Blog\Api\PostRepositoryInterface;
use CommerceLeague\Blog\Controller\Adminhtml\AbstractPost;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Delete
 */
class Delete extends AbstractPost implements HttpPostActionInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @param Action\Context $context
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        Action\Context $context,
        PostRepositoryInterface $postRepository
    ) {
        parent::__construct($context);
        $this->postRepository = $postRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('post_id');

        if ($id) {
            try {
                $this->postRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the post.'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['post_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find the post to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
