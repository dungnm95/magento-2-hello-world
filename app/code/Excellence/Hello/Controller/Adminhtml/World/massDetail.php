<?php
namespace Excellence\Hello\Controller\Adminhtml\World;

use Magento\Backend\App\Action;

class MassDetail extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        echo __METHOD__;
        exit;
    }
}