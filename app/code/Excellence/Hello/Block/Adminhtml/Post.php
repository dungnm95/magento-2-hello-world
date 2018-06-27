<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 09:40
 */

namespace Excellence\Hello\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Post extends Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Excellence_Hello';
        $this->_controller = 'adminhtml_post';
        $this->_headerText = __('Manage Post');
        $this->_addButtonLabel = __('Add Post');

        parent::_construct();
    }
}