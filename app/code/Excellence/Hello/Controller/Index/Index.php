<?php
namespace Excellence\Hello\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
        return parent::__construct($context);
    }

    public function execute()
    {
        #some code here

        $this->registry->register('test_var', 'this is a test!');

        $regis = $this->registry->registry('test_var');
        echo $regis;
    }
}