<?php
namespace Smart\OSC\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Smart\OSC\Api\Data\PostInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'smart_osc_post';

    protected function _construct()
    {
        $this->_init('Smart\OSC\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
