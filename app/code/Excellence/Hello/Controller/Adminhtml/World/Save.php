<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 13/06/2018
 * Time: 17:54
 */

namespace Excellence\Hello\Controller\Adminhtml\World;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    protected $_testFactory;

    public function __construct(Context $context, \Excellence\Hello\Model\TestFactory $testFactory)
    {
        $this->_testFactory = $testFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function execute()
    {
        $title = $this->getRequest()->getParam('title');

        $test = $this->_testFactory->create();
        $test->setTitle($title);
        $test->save();

        $this->messageManager->addSuccess(__('Adding post successful!'));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('hello/world/add');
        return $resultRedirect;
    }
}