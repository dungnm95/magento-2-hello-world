<?php
namespace Smart\OSC\Model\ResourceModel;
class Option extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('smart_osc_option','option_id');
    }

}
