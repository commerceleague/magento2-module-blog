<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Controller\Adminhtml\Post;

use CommerceLeague\Blog\Controller\Adminhtml\AbstractPost;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory as ResultForwardFactory;
use Magento\Backend\Model\View\Result\Forward as ResultForward;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class NewAction
 */
class NewAction extends AbstractPost implements HttpGetActionInterface
{
    /**
     * @var ResultForwardFactory
     */
    private $resultForwardFactory;

    /**
     * @param Action\Context $context
     * @param ResultForwardFactory $resultForwardFactory
     */
    public function __construct(
        Action\Context $context,
        ResultForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var ResultForward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
