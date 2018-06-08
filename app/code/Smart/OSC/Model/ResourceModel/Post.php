<?php
namespace Smart\OSC\Model\ResourceModel;
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('smart_osc_post','smart_osc_post_id');
    }
}
