<?php
namespace Excellence\Hello\Controller\Adminhtml\World\Edit;

/**
 * Interceptor class for @see \Excellence\Hello\Controller\Adminhtml\World\Edit
 */
class Interceptor extends \Excellence\Hello\Controller\Adminhtml\World\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $registry, \Excellence\Hello\Model\TestFactory $testFactory)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $registry, $testFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
