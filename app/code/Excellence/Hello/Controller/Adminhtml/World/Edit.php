<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 14/06/2018
 * Time: 10:51
 */

namespace Excellence\Hello\Controller\Adminhtml\World;


class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $_testFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Excellence_Hello::hello_world_test1');
        $resultPage->addBreadcrumb(__('Excellence'), __('Excellence'));
        $resultPage->addBreadcrumb(__('Hello'), __('Hello'));
        $resultPage->getConfig()->getTitle()->prepend(__('Edit record'));
        return $resultPage;
    }
}