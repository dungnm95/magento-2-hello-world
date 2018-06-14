<?php
namespace Excellence\Hello\Plugin;

class ProductPlugin
{
    /*public function beforeGetProduct(\Magento\Catalog\Block\Product\View $subject)
    {
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug(__METHOD__ . ' - ' . __LINE__);
    }

    public function afterGetProduct(\Magento\Catalog\Block\Product\View $subject, $result)
    {
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug(__METHOD__ . ' - ' . __LINE__);

        return $result;
    }

    public function aroundGetProduct(\Magento\Catalog\Block\Product\View $subject, \closure $proceed)
    {
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug(__METHOD__ . ' - ' . __LINE__);
        $returnValue = $proceed();
        $logger->debug(__METHOD__ . ' - ' . __LINE__);

        return $returnValue;
    }*/

    public function beforeSetName(\Magento\Catalog\Model\Product $subject, $name)
    {
        // logging to test override
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug('Model Override Test before');

        return $name;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        // logging to test override
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug('Model Override Test after');

        return $result;
    }
}