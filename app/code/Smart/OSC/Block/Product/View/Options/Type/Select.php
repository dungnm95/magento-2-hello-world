<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Smart\OSC\Block\Product\View\Options\Type;

class Select extends \Magento\Catalog\Block\Product\View\Options\AbstractOptions
{
    /**
     * Return html for control element
     *
     * @return string
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Pricing\Helper\Data $pricingHelper,
        \Magento\Catalog\Helper\Data $catalogData,
        array $data = []
    )
    {
        parent::__construct($context, $pricingHelper, $catalogData, $data);
    }

    public function getValuesHtml()
    {
        $_option = $this->getOption();
//        die($_option->getType());
        $configValue = $this->getProduct()->getPreconfiguredValues()->getData('options/' . $_option->getId());
        $store = $this->getProduct()->getStore();

        $this->setSkipJsReloadPrice(1);
        // Remove inline prototype onclick and onchange events

        if ($_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_DROP_DOWN ||
            $_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_MULTIPLE
        ) {
            $require = $_option->getIsRequire() ? ' required' : '';
            $extraParams = '';
            $select = $this->getLayout()->createBlock(
                \Magento\Framework\View\Element\Html\Select::class
            )->setData(
                [
                    'id' => 'select_' . $_option->getId(),
                    'class' => $require . ' product-custom-option admin__control-select'
                ]
            );
            if ($_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_DROP_DOWN) {
                $select->setName('options[' . $_option->getId() . ']')->addOption('', __('-- Please Select --'));
            } else {
                $select->setName('options[' . $_option->getId() . '][]');
                $select->setClass('multiselect admin__control-multiselect' . $require . ' product-custom-option');
            }
            foreach ($_option->getValues() as $_value) {
                $priceStr = $this->_formatPrice(
                    [
                        'is_percent' => $_value->getPriceType() == 'percent',
                        'pricing_value' => $_value->getPrice($_value->getPriceType() == 'percent'),
                    ],
                    false
                );
                $select->addOption(
                    $_value->getOptionTypeId(),
                    $_value->getTitle() . ' ' . strip_tags($priceStr) . '',
                    ['price' => $this->pricingHelper->currencyByStore($_value->getPrice(true), $store, false)]
                );
            }
            if ($_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_MULTIPLE) {
                $extraParams = ' multiple="multiple"';
            }
            if (!$this->getSkipJsReloadPrice()) {
                $extraParams .= ' onchange="opConfig.reloadPrice()"';
            }
            $extraParams .= ' data-selector="' . $select->getName() . '"';
            $select->setExtraParams($extraParams);

            if ($configValue) {
                $select->setValue($configValue);
            }

            return $select->getHtml();
        }


        //extra select option
        if ($_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_THUMB_GALLERY ||
            $_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_THUMB_GALLERY_POPUP ||
            $_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_THUMB_MULTI_SELECT
        ) {
            $selectHtml = '<div class="options-list nested" id="options-' . $_option->getId() . '-list">';
            $require = $_option->getIsRequire() ? ' required' : '';
            $arraySign = '';
            if ($_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_THUMB_MULTI_SELECT) {
                $type = 'checkbox';
                $class = 'checkbox admin__control-checkbox';
                $arraySign = '[]';
            } else {
                $type = 'radio';
                $class = 'radio admin__control-radio';
                if (!$_option->getIsRequire()) {
                    $selectHtml .= '<div class="field choice admin__field admin__field-option">' .
                        '<input type="radio" id="options_' .
                        $_option->getId() .
                        '" class="' .
                        $class .
                        ' product-custom-option" name="options[' .
                        $_option->getId() .
                        ']"' .
                        ' data-selector="options[' . $_option->getId() . ']"' .
                        ($this->getSkipJsReloadPrice() ? '' : ' onclick="opConfig.reloadPrice()"') .
                        ' value="" checked="checked" /><label class="label admin__field-label" for="options_' .
                        $_option->getId() .
                        '"><span>' .
                        __('None') . '</span></label></div>';
                }
            }

            $count = 1;
//            echo '<pre>'; print_r($_option->getId()); die();
            foreach ($_option->getValues() as $_value) {
                $count++;
                $htmlValue = $_value->getOptionTypeId();
                $checked = '';
                if ($arraySign) {
                    $checked = is_array($configValue) && in_array($htmlValue, $configValue) ? 'checked' : '';
                } else {
                    $checked = $configValue == $htmlValue ? 'checked' : '';
                }

                $dataSelector = 'options[' . $_option->getId() . ']';
                if ($arraySign) {
                    $dataSelector .= '[' . $htmlValue . ']';
                }

                $is_default = $_option->getDataByColumn("is_default",$_option->getId(), $count-2);
                if($is_default){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }

                $selectHtml .= '<div class="field choice admin__field admin__field-option' .
                    $require .
                    '">' .
                    '<input type="' .
                    $type .
                    '" class="' .
                    $class .
                    ' ' .
                    $require .
                    ' product-custom-option"' .
                    ($this->getSkipJsReloadPrice() ? '' : ' onclick="opConfig.reloadPrice()"') .
                    ' name="options[' .
                    $_option->getId() .
                    ']' .
                    $arraySign .
                    '" id="options_' .
                    $_option->getId() .
                    '_' .
                    $count .
                    '" value="' .
                    $htmlValue .
                    '" ' .
                    $checked .
                    ' data-selector="' . $dataSelector . '"' .
                    ' price="' .
                    $this->pricingHelper->currencyByStore($_value->getPrice(true), $store, false) .
                    '" />' .
                    '<label class="label admin__field-label" for="options_' .
                    $_option->getId() .
                    '_' .
                    $count .
                    '">';
                if($_option->getDataByColumn('display_mode',$_option->getId(), $count-2) == 'image'){
                    $selectHtml .= '<img src="'.$_option->getDataByColumn("image",$_option->getId(), $count-2).'" width="40" height="40"/></label>';
                }else{
                    $selectHtml .= '<span style="width:40px;height:40px;background-color: #'.$_option->getDataByColumn("thumb_color",$_option->getId(), $count-2).';display:inline-block"></span></label>';
                }

                $selectHtml .= '</div>';
            }
            $selectHtml .= '</div>';

            return $selectHtml;
        }


        if ($_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_RADIO ||
            $_option->getType() == \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_CHECKBOX
        ) {
            $selectHtml = '<div class="options-list nested" id="options-' . $_option->getId() . '-list">';
            $require = $_option->getIsRequire() ? ' required' : '';
            $arraySign = '';
            switch ($_option->getType()) {
                case \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_RADIO:
                    $type = 'radio';
                    $class = 'radio admin__control-radio';
                    if (!$_option->getIsRequire()) {
                        $selectHtml .= '<div class="field choice admin__field admin__field-option">' .
                            '<input type="radio" id="options_' .
                            $_option->getId() .
                            '" class="' .
                            $class .
                            ' product-custom-option" name="options[' .
                            $_option->getId() .
                            ']"' .
                            ' data-selector="options[' . $_option->getId() . ']"' .
                            ($this->getSkipJsReloadPrice() ? '' : ' onclick="opConfig.reloadPrice()"') .
                            ' value="" checked="checked" /><label class="label admin__field-label" for="options_' .
                            $_option->getId() .
                            '"><span>' .
                            __('None') . '</span></label></div>';
                    }
                    break;
                case \Smart\OSC\Api\Data\ProductCustomOptionInterface::OPTION_TYPE_CHECKBOX:
                    $type = 'checkbox';
                    $class = 'checkbox admin__control-checkbox';
                    $arraySign = '[]';
                    break;
            }
            $count = 1;
            foreach ($_option->getValues() as $_value) {
                $count++;

                $priceStr = $this->_formatPrice(
                    [
                        'is_percent' => $_value->getPriceType() == 'percent',
                        'pricing_value' => $_value->getPrice($_value->getPriceType() == 'percent'),
                    ]
                );

                $htmlValue = $_value->getOptionTypeId();
                if ($arraySign) {
                    $checked = is_array($configValue) && in_array($htmlValue, $configValue) ? 'checked' : '';
                } else {
                    $checked = $configValue == $htmlValue ? 'checked' : '';
                }

                $dataSelector = 'options[' . $_option->getId() . ']';
                if ($arraySign) {
                    $dataSelector .= '[' . $htmlValue . ']';
                }

                $selectHtml .= '<div class="field choice admin__field admin__field-option' .
                    $require .
                    '">' .
                    '<input type="' .
                    $type .
                    '" class="' .
                    $class .
                    ' ' .
                    $require .
                    ' product-custom-option"' .
                    ($this->getSkipJsReloadPrice() ? '' : ' onclick="opConfig.reloadPrice()"') .
                    ' name="options[' .
                    $_option->getId() .
                    ']' .
                    $arraySign .
                    '" id="options_' .
                    $_option->getId() .
                    '_' .
                    $count .
                    '" value="' .
                    $htmlValue .
                    '" ' .
                    $checked .
                    ' data-selector="' . $dataSelector . '"' .
                    ' price="' .
                    $this->pricingHelper->currencyByStore($_value->getPrice(true), $store, false) .
                    '" />' .
                    '<label class="label admin__field-label" for="options_' .
                    $_option->getId() .
                    '_' .
                    $count .
                    '"><span>' .
                    $_value->getTitle() .
                    '</span> ' .
                    $priceStr .
                    '</label>';
                $selectHtml .= '</div>';
            }
            $selectHtml .= '</div>';

            return $selectHtml;
        }
    }
}