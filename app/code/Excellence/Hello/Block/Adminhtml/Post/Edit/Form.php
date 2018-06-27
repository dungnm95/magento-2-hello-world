<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 09:20
 */

namespace Excellence\Hello\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' =>[
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}