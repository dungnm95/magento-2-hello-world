<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Smart\OSC\Model\ResourceModel\Product;

use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Catalog product custom option resource model
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Option extends \Magento\Catalog\Model\ResourceModel\Product\Option
{
    /**
     * @var \Magento\Framework\EntityManager\MetadataPool
     */
    protected $metadataPool;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Currency factory
     *
     * @var \Magento\Directory\Model\CurrencyFactory
     */
    protected $_currencyFactory;

    /**
     * Core config model
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_config;

    /**
     * Class constructor
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Directory\Model\CurrencyFactory $currencyFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param string $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        $connectionName = null
    ) {
        $this->_currencyFactory = $currencyFactory;
        $this->_storeManager = $storeManager;
        $this->_config = $config;
        parent::__construct($context,$currencyFactory,$storeManager, $config, $connectionName);
    }

    /**
     * Define main table and initialize connection
     *
     * @return void
     */
//    protected function _construct()
//    {
//        $this->_init('smart_osc_option', 'option_id');
//    }

    /**
     * Save options store data
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->_saveValuePrices($object);
        $this->_saveValueTitles($object);

        return parent::_afterSave($object);
    }

    protected function getColFromOptionTable($tableName, $optionId, $storeId)
    {
        $connection = $this->getConnection();
        $statement = $connection->select()->from(
            $tableName
        )->where(
            'option_id = ?',
            $optionId
        )->where(
            'store_id  = ?',
            $storeId
        );

        return $connection->fetchOne($statement);
    }

}
