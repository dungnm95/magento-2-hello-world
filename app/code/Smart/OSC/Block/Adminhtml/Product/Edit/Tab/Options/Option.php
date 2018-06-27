<?php
namespace Smart\OSC\Block\Adminhtml\Product\Edit\Tab\Options;

use Magento\Backend\Block\Widget;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Api\Data\ProductCustomOptionInterface;
use Magento\Framework\Registry;

class Option extends Widget
{
    protected $_productInstance;
    protected $_values;
    protected $_itemCount = 1;
    protected $_template = 'catalog/product/edit/options/option.phtml';
    protected $_coreRegistry = null;
    protected $_productOptionConfig;
    protected $_product;
    protected $_configYesNo;
    protected $_optionType;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Config\Model\Config\Source\Yesno $configYesNo,
        \Magento\Catalog\Model\Config\Source\Product\Options\Type $optionType,
        Product $product,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\ProductOptions\ConfigInterface $productOptionConfig,
        array $data = []
    ){
        $this->_optionType = $optionType;
        $this->_configYesNo = $configYesNo;
        $this->_product = $product;
        $this->_productOptionConfig = $productOptionConfig;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setCanReadPrice(true);
        $this->setCanEditPrice(true);
    }

    public function getItemCount()
    {
        return $this->_itemCount;
    }

    public function setItemCount($itemCount)
    {
        $this->_itemCount = max($this->_itemCount, $itemCount);
        return $this;
    }

    public function getProduct()
    {
        if(!$this->_productInstance){
            $product = $this->_coreRegistry->registry('product');
        }
        if($product){
            $this->_productInstance = $product;
        }else{
            $this->_productInstance = $this->_product;
        }
        return $this->_productInstance;
    }

    public function setProduct($product)
    {
        $this->_productInstance = $product;
        return $this;
    }

    public function getFieldName()
    {
        return 'product[options]';
    }

    public function getFieldId()
    {
        return 'product_option';
    }

    public function isReadonly()
    {
        return $this->getProduct()->getOptionsReadonly();
    }

    protected function _prepareLayout()
    {
        foreach ($this->_productOptionConfig->getAll() as $option) {
            $this->addChild($option['name'] . '_option_type', $option['renderer']);
        }

        return parent::_prepareLayout();
    }

    public function getAddButtonId()
    {
        $buttonId = $this->getLayout()->getBlock('admin.product.options')->getChildBlock('add_button')->getId();
        return $buttonId;
    }

    public function getTypeSelectHtml()
    {
        $select = $this->getLayout()->createBlock(
            \Magento\Framework\View\Element\Html\Select::class
        )->setData(
            [
                'id' => $this->getFieldId() . '_<%- data.id %>_type',
                'class' => 'select select-product-option-type required-option-select',
            ]
        )->setName(
            $this->getFieldName() . '[<%- data.id %>][type]'
        )->setOptions(
            $this->_optionType->toOptionArray()
        );

        return $select->getHtml();
    }
    public function getRequireSelectHtml()
    {
        $select = $this->getLayout()->createBlock(
            \Magento\Framework\View\Element\Html\Select::class
        )->setData(
            ['id' => $this->getFieldId() . '_<%- data.id %>_is_require', 'class' => 'select']
        )->setName(
            $this->getFieldName() . '[<%- data.id %>][is_require]'
        )->setOptions(
            $this->_configYesNo->toOptionArray()
        );

        return $select->getHtml();
    }

    public function getTemplatesHtml()
    {
        $canEditPrice = $this->getCanEditPrice();
        $canReadPrice = $this->getCanReadPrice();
        $this->getChildBlock('select_option_type')->setCanReadPrice($canReadPrice)->setCanEditPrice($canEditPrice);


        $templates = parent::getTemplatesHtml() . "\n" .$this->getChildHtml('date_option_type');

        return $templates;
    }

    public function getOptionValues()
    {
        $optionsArr = $this->getProduct()->getOptions();
        if ($optionsArr == null) {
            $optionsArr = [];
        }

        if (!$this->_values || $this->getIgnoreCaching()) {
            $showPrice = $this->getCanReadPrice();
            $values = [];
            $scope = (int)$this->_scopeConfig->getValue(
                \Magento\Store\Model\Store::XML_PATH_PRICE_SCOPE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            foreach ($optionsArr as $option) {
                /* @var $option \Magento\Catalog\Model\Product\Option */

                $this->setItemCount($option->getOptionId());

                $value = [];

                $value['id'] = $option->getOptionId();
                $value['item_count'] = $this->getItemCount();
                $value['option_id'] = $option->getOptionId();
                $value['title'] = $option->getTitle();
                $value['type'] = $option->getType();
                $value['is_require'] = $option->getIsRequire();
                $value['sort_order'] = $option->getSortOrder();
                $value['can_edit_price'] = $this->getCanEditPrice();

                if ($this->getProduct()->getStoreId() != '0') {
                    $value['checkboxScopeTitle'] = $this->getCheckboxScopeHtml(
                        $option->getOptionId(),
                        'title',
                        $option->getStoreTitle() === null
                    );
                    $value['scopeTitleDisabled'] = $option->getStoreTitle() === null ? 'disabled' : null;
                }

                if ($option->getGroupByType() == ProductCustomOptionInterface::OPTION_GROUP_SELECT) {
                    $i = 0;
                    $itemCount = 0;
                    foreach ($option->getValues() as $_value) {
                        /* @var $_value \Magento\Catalog\Model\Product\Option\Value */
                        $value['optionValues'][$i] = [
                            'item_count' => max($itemCount, $_value->getOptionTypeId()),
                            'option_id' => $_value->getOptionId(),
                            'option_type_id' => $_value->getOptionTypeId(),
                            'title' => $_value->getTitle(),
                            'price' => $showPrice ? $this->getPriceValue(
                                $_value->getPrice(),
                                $_value->getPriceType()
                            ) : '',
                            'price_type' => $showPrice ? $_value->getPriceType() : 0,
                            'sku' => $_value->getSku(),
                            'sort_order' => $_value->getSortOrder(),
                        ];

                        if ($this->getProduct()->getStoreId() != '0') {
                            $value['optionValues'][$i]['checkboxScopeTitle'] = $this->getCheckboxScopeHtml(
                                $_value->getOptionId(),
                                'title',
                                $_value->getStoreTitle() === null,
                                $_value->getOptionTypeId()
                            );
                            $value['optionValues'][$i]['scopeTitleDisabled'] = (
                                $_value->getStoreTitle() === null
                            ) ? 'disabled' : null;
                            if ($scope == \Magento\Store\Model\Store::PRICE_SCOPE_WEBSITE) {
                                $value['optionValues'][$i]['checkboxScopePrice'] = $this->getCheckboxScopeHtml(
                                    $_value->getOptionId(),
                                    'price',
                                    $_value->getstorePrice() === null,
                                    $_value->getOptionTypeId(),
                                    ['$(this).up(1).previous()']
                                );
                                $value['optionValues'][$i]['scopePriceDisabled'] = (
                                    $_value->getStorePrice() === null
                                ) ? 'disabled' : null;
                            }
                        }
                        $i++;
                    }
                } else {
                    $value['price'] = $showPrice ? $this->getPriceValue(
                        $option->getPrice(),
                        $option->getPriceType()
                    ) : '';
                    $value['price_type'] = $option->getPriceType();
                    $value['sku'] = $option->getSku();
                    $value['max_characters'] = $option->getMaxCharacters();
                    $value['file_extension'] = $option->getFileExtension();
                    $value['image_size_x'] = $option->getImageSizeX();
                    $value['image_size_y'] = $option->getImageSizeY();
                    if ($this->getProduct()->getStoreId() != '0'
                        && $scope == \Magento\Store\Model\Store::PRICE_SCOPE_WEBSITE
                    ) {
                        $value['checkboxScopePrice'] = $this->getCheckboxScopeHtml(
                            $option->getOptionId(),
                            'price',
                            $option->getStorePrice() === null
                        );
                        $value['scopePriceDisabled'] = $option->getStorePrice() === null ? 'disabled' : null;
                    }
                }
                $values[] = new \Magento\Framework\DataObject($value);
            }
            $this->_values = $values;
        }

        return $this->_values;
    }

    public function getCheckboxScopeHtml($id, $name, $checked = true, $select_id = '-1', array $containers = [])
    {
        $checkedHtml = '';
        if ($checked) {
            $checkedHtml = ' checked="checked"';
        }
        $selectNameHtml = '';
        $selectIdHtml = '';
        if ($select_id != '-1') {
            $selectNameHtml = '[values][' . $select_id . ']';
            $selectIdHtml = 'select_' . $select_id . '_';
        }
        $containers[] = '$(this).up(1)';
        $containers = implode(',', $containers);
        $localId = $this->getFieldId() . '_' . $id . '_' . $selectIdHtml . $name . '_use_default';
        $localName = "options_use_default[" . $id . "]" . $selectNameHtml . "[" . $name . "]";
        $useDefault =
            '<div class="field-service">'
            . '<input type="checkbox" class="use-default-control"'
            . ' name="' . $localName . '"' . 'id="' . $localId . '"'
            . ' value=""'
            . $checkedHtml
            . ' onchange="toggleSeveralValueElements(this, [' . $containers . ']);" '
            . ' />'
            . '<label for="' . $localId . '" class="use-default">'
            . '<span class="use-default-label">' . __('Use Default') . '</span></label></div>';

        return $useDefault;
    }

    public function getPriceValue($value, $type)
    {
        if ($type == 'percent') {
            return number_format($value, 2, null, '');
        } elseif ($type == 'fixed') {
            return number_format($value, 2, null, '');
        }
    }

    public function getProductGridUrl()
    {
        return $this->getUrl('catalog/*/optionsImportGrid');
    }

    public function getCustomOptionsUrl()
    {
        return $this->getUrl('catalog/*/customOptions');
    }

    public function getCurrentProductId()
    {
        return $this->getProduct()->getId();
    }
}