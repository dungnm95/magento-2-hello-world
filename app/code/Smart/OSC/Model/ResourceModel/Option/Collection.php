<?php
namespace Smart\OSC\Model\ResourceModel\Option;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Smart\OSC\Model\Option','Smart\OSC\Model\ResourceModel\Option');
    }
}
