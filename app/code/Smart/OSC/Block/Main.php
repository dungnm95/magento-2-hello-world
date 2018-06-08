<?php
namespace Smart\OSC\Block;

class Main extends \Magento\Framework\View\Element\Template
{
    protected $_postFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Smart\OSC\Model\PostFactory $postFactory
    ){

        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }
    protected function _prepareLayout()
    {

    }
    protected function setTitle()
    {
        $post = $this->_postFactory->create();
        $post->setTitle('Ahihi');
        $post->save();
        return $post->getData('title');
    }
}