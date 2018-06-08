<?php
namespace Smart\OSC\Model\ResourceModel\Post;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Smart\OSC\Model\Post','Smart\OSC\Model\ResourceModel\Post');
    }
}
