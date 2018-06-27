<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 10:44
 */

namespace Excellence\Hello\Controller\Adminhtml\Post;

use Excellence\Hello\Controller\Adminhtml\Post;

class Save extends \Magento\Backend\App\Action

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
        $isPost = $this->getRequest()->getPost();
        if($isPost)
        {
            $newModel = $this->_testFactory->create();
            $newId = $this->getRequest()->getParam('id');
            if($newId)
            {
                $newModel->load($newId);
            }
            $formData = $this->getRequest()->getParam('title');
            $newModel->setData($formData);

            try
            {
                $newModel->save();
                $this->messageManager->addSuccess(__('The post has been saved'));
                //check if Save and continue
                if($this->getRequest()->getParam('back'))
                {
                    $this->_redirect('*/*/edit', ['id'=>$newModel->getId(), '_current'=>true]);
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (\Exception $e)
            {
                $this->messageManager->addError($e->getMessage());
            }
            $this->_redirect('*/*/edit', ['id' => $newId]);
        }
    }

}