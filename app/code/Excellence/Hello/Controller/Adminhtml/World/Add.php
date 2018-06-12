<?php

namespace Excellence\Hello\Controller\Adminhtml\World;

class Add extends \Magento\Backend\App\Action
{

    protected $resultPageFactory = false;
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
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Excellence hello test table'));
        return $resultPage;
    }
}