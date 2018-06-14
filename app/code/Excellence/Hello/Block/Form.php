<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 14/06/2018
 * Time: 15:50
 */

namespace Excellence\Hello\Block;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Form extends Generic implements TabInterface
{
    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, array $data = [])
    {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('news_');
        $form->setFieldNameSuffix('news');
        $fieldset = $form->addFieldset(
            'base_field',
            ['legend' => __('General')]
        );
        $fieldset->addFieldset(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'required' => true
            ]
        );
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('News Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('News Info');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}