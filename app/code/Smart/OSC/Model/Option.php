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

    public function loadByOptionId($option_id)
    {
//        if(!$option_id){
//            $option_id = $this->getTitle();
//        }
        $id = $this -> getResource()->loadByOptionId($option_id);
        return $this->load($id);

    }
}
