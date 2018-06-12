<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 12/06/2018
 * Time: 14:05
 */

namespace Excellence\Hello\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Actionname extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('excellence/index/add');
        return $resultRedirect;
    }
}