<?php
/**
 * Created by PhpStorm.
 * User: dzung
 * Date: 21/06/2018
 * Time: 11:56
 */

namespace Smart\OSC\Controller\Adminhtml\Product;

use Braintree\Exception;

class Save extends \Magento\Catalog\Controller\Adminhtml\Product\Save
{
    protected $_optionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilder,
        \Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper $initializationHelper,
        \Magento\Catalog\Model\Product\Copier $productCopier,
        \Magento\Catalog\Model\Product\TypeTransitionManager $productTypeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Smart\OSC\Model\OptionFactory $optionFactory
    )
    {
        $this->_optionFactory = $optionFactory;
        parent::__construct($context, $productBuilder, $initializationHelper, $productCopier, $productTypeManager, $productRepository);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $newId = $this->getRequest()->getParam('id');
        $options = $data['product']['options'];
        $optionModel = $this->_optionFactory->create();
        if ($options) {
            foreach ($options as $options_key => $options_val){
                foreach ($options_val['values'] as $values_key => $values_val){
//                    echo'<pre>'; print_r($options_val);die();
                    $data_option = [
                        'option_id' => $options_val['option_id'],
                        'product_id' => $options[0]['product_id'],
                        'type' => $options_val['type'],
                        'is_require' => $options_val['is_require'],
                        'sku' => $values_val['sku'],
                        'image' => $values_val['upload'],
                        'thumb_color' => $values_val['thumb_color'],
                        'display_mode' => $values_val['display_mode'],
                        'is_default' => $values_val['is_default'],
                        'sort_order' => $options_key + $values_key
                    ];
                    $optionModel->setData($data_option);
                    try{
                        $optionModel->save();

                    }catch (\Exception $e)
                    {
                        $this->messageManager->addError($e->getMessage());
                        $this->_redirect('*/*/edit', ['id'=>$newId, '_current'=>true]);
                        return;
                    }

                }
            }
        }

        return parent::execute();
    }
}