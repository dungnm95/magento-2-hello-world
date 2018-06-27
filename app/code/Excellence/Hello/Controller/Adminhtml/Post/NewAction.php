<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 10:22
 */
namespace Excellence\Hello\Controller\Adminhtml\Post;

use Excellence\Hello\Controller\Adminhtml\Post;

class NewAction extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $this->forward('edit');
    }
}