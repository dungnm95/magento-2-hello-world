<?php
namespace Smart\OSC\Block\Adminhtml\Product\Edit\Tab\Options;
use Magento\Store\Model\Store;

class Ajax extends \Magento\Backend\Block\AbstractBlock
{
    protected $_coreRegistry = null;
    protected $_productFactory;
    protected $_jsonEncoder;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_jsonEncoder = $jsonEncoder;
        $this->_coreRegistry = $registry;
        $this->_productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        $results = [];
        $optionsBlock = $this->getLayout()->createBlock(
            \Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Option::class
        )->setIgnoreCaching(
            true
        );

        $products = $this->_coreRegistry->registry('import_option_products');
        if (is_array($products)) {
            foreach ($products as $productId) {
                $product = $this->_productFactory->create();
                $product->setStoreId($this->getRequest()->getParam('store', Store::DEFAULT_STORE_ID));
                $product->load((int)$productId);
                if (!$product->getId()) {
                    continue;
                }

                $optionsBlock->setProduct($product);
                $results = array_merge($results, $optionsBlock->getOptionValues());
            }
        }

        $output = [];
        foreach ($results as $resultObject) {
            $output[] = $resultObject->getData();
        }

        return $this->_jsonEncoder->encode($output);
    }
}