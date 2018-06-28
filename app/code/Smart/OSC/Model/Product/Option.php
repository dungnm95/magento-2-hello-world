<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Smart\OSC\Model\Product;

use Smart\OSC\Api\Data\ProductCustomOptionInterface;
use Magento\Catalog\Api\Data\ProductCustomOptionValuesInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Option\Value\Collection;
use Magento\Catalog\Pricing\Price\BasePrice;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Catalog product option model
 *
 * @api
 * @method int getProductId()
 * @method \Magento\Catalog\Model\Product\Option setProductId(int $value)
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @since 100.0.2
 */
class Option extends \Magento\Catalog\Model\Product\Option implements ProductCustomOptionInterface
{

    const KEY_PRODUCT_IMAGE = 'image';
    const KEY_PRODUCT_THUMB_COLOR = 'thumb_color';
    const KEY_PRODUCT_DISPLAY_MODE = 'display_mode';
    const KEY_PRODUCT_IS_DEFAULT = 'is_default';

    protected function _construct()
    {
        $this->_init(\Smart\OSC\Model\ResourceModel\Option::class);
        parent::_construct();
    }

    public function getGroupByType($type = null)
    {
        if ($type === null) {
            $type = $this->getType();
        }
        $optionGroupsToTypes = [
            parent::OPTION_TYPE_FIELD => parent::OPTION_GROUP_TEXT,
            parent::OPTION_TYPE_AREA => parent::OPTION_GROUP_TEXT,
            parent::OPTION_TYPE_FILE => parent::OPTION_GROUP_FILE,
            parent::OPTION_TYPE_DROP_DOWN => parent::OPTION_GROUP_SELECT,
            parent::OPTION_TYPE_RADIO => parent::OPTION_GROUP_SELECT,
            parent::OPTION_TYPE_CHECKBOX => parent::OPTION_GROUP_SELECT,
            parent::OPTION_TYPE_MULTIPLE => parent::OPTION_GROUP_SELECT,
            parent::OPTION_TYPE_DATE => parent::OPTION_GROUP_DATE,
            parent::OPTION_TYPE_DATE_TIME => parent::OPTION_GROUP_DATE,
            parent::OPTION_TYPE_TIME => parent::OPTION_GROUP_DATE,
            self::OPTION_TYPE_THUMB_GALLERY => parent::OPTION_GROUP_SELECT,
            self::OPTION_TYPE_THUMB_GALLERY_POPUP => parent::OPTION_GROUP_SELECT,
            self::OPTION_TYPE_THUMB_MULTI_SELECT => parent::OPTION_GROUP_SELECT,
        ];

        return isset($optionGroupsToTypes[$type]) ? $optionGroupsToTypes[$type] : '';
    }

    public function hasValues($type = null)
    {
        return $this->getGroupByType($type) == parent::OPTION_GROUP_SELECT;
    }

    public function setImage($image)
    {
        return $this->setData(self::KEY_PRODUCT_IMAGE, $image);
    }

    public function setThumbColor($color)
    {
        return $this->setData(self::KEY_PRODUCT_THUMB_COLOR, $color);
    }

    public function setIsDefault($is_default)
    {
        return $this->setData(self::KEY_PRODUCT_IS_DEFAULT, $is_default);
    }

    public function setDisplayMode($display_mode)
    {
        return $this->setData(self::KEY_PRODUCT_DISPLAY_MODE, $display_mode);
    }

    public function getDataByColumn($col)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $optionModel = $objectManager->create('Smart\OSC\Model\Option');
        $a = $optionModel->load($this->getId())->get();
        return $a[$col];
    }
    public function getImage()
    {
        return $this->_getData(self::KEY_PRODUCT_IMAGE);
    }

    public function getThumbColor()
    {
        return $this->_getData(self::KEY_PRODUCT_THUMB_COLOR);
    }

    public function getIsDefault()
    {
        return $this->_getData(self::KEY_PRODUCT_IS_DEFAULT);
    }

    public function getDisplayMode()
    {
        return $this->_getData(self::KEY_PRODUCT_DISPLAY_MODE);
    }
}
