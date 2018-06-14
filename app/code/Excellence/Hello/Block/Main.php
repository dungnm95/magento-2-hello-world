<?php
namespace Excellence\Hello\Block;

class Main extends \Magento\Framework\View\Element\Template{

    protected $_testFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Hello\Model\TestFactory $testFactory
    )
    {
        $this->_testFactory = $testFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getTestModel()
    {
        $test = $this->_testFactory->create();
        $test->setTitle('Test Title');
        $test->save();

        $test->load(2);
        print_r($test->getData());


        $model = $this->_testFactory->create()->load(1);

//        $model = $model->setTitle('AAAAAA');
//        $model->save();

        return $model->getData('excellence_hello_test_id');
    }

    public function getRecordInfo()
    {
        $title = $this->getRequest()->getParams();
        $id = (int) $title['id'];
        $model = $this->_testFactory->create()->load($id);
        return $model->getData();
    }

}