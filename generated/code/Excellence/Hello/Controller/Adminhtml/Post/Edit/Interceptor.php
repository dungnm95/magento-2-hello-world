<?php
namespace Excellence\Hello\Controller\Adminhtml\Post\Edit;

/**
 * Interceptor class for @see \Excellence\Hello\Controller\Adminhtml\Post\Edit
 */
class Interceptor extends \Excellence\Hello\Controller\Adminhtml\Post\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Excellence\Hello\Model\TestFactory $testFactory)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $testFactory);
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
