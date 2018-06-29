<?php
namespace Smart\OSC\Model\ResourceModel;
class Option extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('smart_osc_option','id');
    }

    public function loadByOptionId($option_id){
        $table = $this->getMainTable();
        $where = $this->getConnection()->quoteInto("option_id = ?", $option_id);
        $sql = $this->getConnection()->select()->from($table,array('id'))->where($where);
        $id = $this->getConnection()->fetchOne($sql);
        return $id;
    }

    public function loadAllByOptionId($option_id){
        $table = $this->getMainTable();
        $where = $this->getConnection()->quoteInto("option_id = ?", $option_id);
        $sql = $this->getConnection()->select()->from($table,array('id'))->where($where);
        $id = $this->getConnection()->fetchAll($sql);
        return $id;
    }

    public function getOptionByProductId($product_id){
        $table = 'catalog_product_option';
        $where = $this->getConnection()->quoteInto("product_id = ?", $product_id);
        $sql = $this->getConnection()->select()->from($table,array('option_id'))->where($where);
        $id = $this->getConnection()->fetchAll($sql);
        return $id;
    }
}
