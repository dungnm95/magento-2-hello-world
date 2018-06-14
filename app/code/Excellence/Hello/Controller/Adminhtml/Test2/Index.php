<?php$resultPageFactory
namespace Excellence\Hello\Controller\Adminhtml\Test2;

use Magento\Backend\App\Action;

class Index extends \Magento\Backend\App\Action
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