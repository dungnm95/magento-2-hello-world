<?php

namespace Excellence\Hello\Controller\Adminhtml\World;

use Excellence\Hello\Controller\Adminhtml\World;

class Add extends \Magento\Backend\App\Action
{
    public function execute()
    {
        /*
         * @var \Magento\Backend\Model\View\Result\Forward $resultForward
         */
        $resultForward = $this->_objectManager->create('Magento\Backend\Model\View\Result\Forward');
        return $resultForward->forward('edit');
    }
}