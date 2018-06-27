<?php
namespace Smart\OSC\Model;
class Option extends \Magento\Framework\Model\AbstractModel implements \Smart\OSC\Api\Data\OptionInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'smart_osc_option';

    protected function _construct()
    {
        $this->_init('Smart\OSC\Model\ResourceModel\Option');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
