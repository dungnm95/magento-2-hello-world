<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 10:26
 */

namespace Excellence\Hello\Controller\Adminhtml\Post;

use Excellence\Hello\Controller\Adminhtml\Post;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $_testFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Excellence\Hello\Model\TestFactory $testFactory
    ) {
        $this->_testFactory = $testFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $newsId = $this->getRequest()->getParam('id');
        $model = $this->_testFactory->create();

        if($newsId)
        {
            $model->load($newsId);
            if(!$model->get())
            {
                $this->messageMaganager->addError(__('This post no longer exist'));
                $this->_redirect('*/*/');
                return;
            }
        }
        //$this->_coreRegister->register('excellence_hello_test', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Excellence_Hello::hello_world_test1');
        $resultPage->getConfig()->getTitle()->prepend(__('Simple Post'));

    }
}