<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 14/06/2018
 * Time: 16:28
 */

namespace Excellence\Hello\Controller\Adminhtml\World;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Update extends Action
{
    protected $_testFactory;

    public function __construct(Context $context,\Excellence\Hello\Model\TestFactory $testFactory)
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
        $title = $this->getRequest()->getParams();
        $test = $this->_testFactory->create();
        $test->setData(['excellence_hello_test_id' => $title['id'], 'title' => $title['title']]);
        $test->save();

        $this->messageManager->addSuccess(__('Editing post successful!'));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('hello/world/edit/id/'.$title['id']);
        return $resultRedirect;
    }
}