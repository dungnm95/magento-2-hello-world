<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 18/06/2018
 * Time: 09:32
 */

namespace Excellence\Hello\Controller\Adminhtml\World;


use Braintree\Exception;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;

class Delete extends \Magento\Backend\App\Action
{
    protected $_coreRegistry;
    protected $_testFactory;

    public function __construct(Action\Context $context, Registry $registry, \Excellence\Hello\Model\TestFactory $testFactory)
    {
        parent::__construct($context);
        $this->_coreRegistry = $registry;
        $this->_testFactory = $testFactory;
    }

    public function execute()
    {
        $postId = $this->getRequest()->getParam('id');

        $model = $this->_testFactory->create();

        $model->load($postId);
        if(!$model->get()){
            $this->messageManager->addError(__('This post no longer exist'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');

        }else{
            try{
                $model->delete($postId);
                $this->messageManager->addSuccess('Delete post successful!');
                return $this->_redirect('*/*/');
            }catch (Exception $e){
                $this->messageManager->addError($e->getMessage());
                return $this->_redirect('*/*/');
            }
        }
    }
}