<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 14/06/2018
 * Time: 18:00
 */

namespace Excellence\Hello\Block\Adminhtml\Post;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends Container
{
    protected $_coreRegistry = null;

    public function __construct(Context $context, Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'excellence_hello_test_id';
        $this->_blockGroup = 'Excellence_Hello';
        $this->_controller = 'adminhtml_post';

        parent::_construct();

        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => _('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('back', 'label', 'Back');
        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->update('delete', 'label', __('Delete'));

    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        $newsRegistry = $this->_coreRegistry->registry('excellence_hello_test');
        if($newsRegistry->getId())
        {
            $newTitle = $this->escapeHtml($newsRegistry->getTitle());
            return __("Edit Post '%1'", $newTitle);
        }
        else
        {
            return __('Add Post');
        }
    }

    protected function _prepareLayout()
    {

        return parent::_prepareLayout();
    }
}