<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 11:51
 */

namespace Excellence\Hello\Controller\Adminhtml\World;
use Excellence\Hello\Controller\Adminhtml\World;
use Magento\Framework\Registry;

class Edit extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory = false;
    protected $_coreRegistry = null;
    protected $_testFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Registry $registry,
        \Excellence\Hello\Model\TestFactory $testFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_testFactory = $testFactory;
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
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('excellence_hello_test', $model);

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Excellence_Hello::hello_world_test1');
        $resultPage->getConfig()->getTitle()->prepend(__('Simple Post'));
//        $resultPage->addContent($resultPage->getLayout()->createBlock('Excellence\Hello\Block\Adminhtml\Post\Edit'));

        return $resultPage;
    }
}