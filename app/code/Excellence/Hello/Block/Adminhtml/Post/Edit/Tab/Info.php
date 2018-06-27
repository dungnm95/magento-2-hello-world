<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 15/06/2018
 * Time: 09:25
 */
namespace Excellence\Hello\Block\Adminhtml\Post\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;


class Info extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
    protected $_newsStatus;
    protected $_testFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {

        $model = $this->_coreRegistry->registry('excellence_hello_test');
//        var_dump($model->getData());die();

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();


        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );
        if($model->getId()){
            $fieldset->addField(
                'excellence_hello_test_id',
                'hidden',
                ['name' => 'id', 'value' => $model->getId()]
            );
            $fieldset->addField(
                'title',
                'text',
                [
                    'name'        => 'title',
                    'label'    => __('Title'),
                    'required'     => true,
                    'value' => $model->getTitle()
            ]
            );
        }
        else{
            $fieldset->addField(
                'title',
                'text',
                [
                    'name'        => 'title',
                    'label'    => __('Title'),
                    'required'     => true
                ]
            );
        }

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
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