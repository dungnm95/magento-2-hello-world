<?php
namespace Excellence\Hello\Controller\Adminhtml\World\Update;

/**
 * Interceptor class for @see \Excellence\Hello\Controller\Adminhtml\World\Update
 */
class Interceptor extends \Excellence\Hello\Controller\Adminhtml\World\Update implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Excellence\Hello\Model\TestFactory $testFactory)
    {
        $this->___init();
        parent::__construct($context, $testFactory);
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
