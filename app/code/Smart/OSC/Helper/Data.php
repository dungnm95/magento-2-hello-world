<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 18/06/2018
 * Time: 15:47
 */

namespace Smart\OSC\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_helper;
    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Smart\OSC\Helper\Data $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        parent::__construct();
        $this->_helper = $helper;
        $this->_scopeConfig = $scopeConfig;
    }

    public function getMaxImgSize()
    {
        $this->_scopeConfig->getValue(self::MAX_IMG_UPLOAD);
    }

    public function getImgWidth()
    {
        $this->_scopeConfig->getValue(self::IMG_WIDTH);
    }

    public function getImgHeight()
    {
        $this->_scopeConfig->getValue(self::IMG_HEIGHT);
    }
}