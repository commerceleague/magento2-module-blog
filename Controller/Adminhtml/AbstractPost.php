<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page as ResultPageModel;
use Magento\Framework\View\Result\Page as ResultPage;

/**
 * Class AbstractPost
 */
abstract class AbstractPost extends Action
{
    const ADMIN_RESOURCE = 'CommerceLeague_Blog::blog_post';

    /**
     * @param ResultPage|ResultPageModel $resultPage
     * @return ResultPage
     */
    protected function initPage(ResultPage $resultPage): ResultPage
    {
        $resultPage->setActiveMenu('CommerceLeague_Blog::blog_post')
            ->addBreadcrumb(__('Blog'), __('Blog'))
            ->addBreadcrumb(__('Posts'), __('Posts'));

        return $resultPage;
    }
}
