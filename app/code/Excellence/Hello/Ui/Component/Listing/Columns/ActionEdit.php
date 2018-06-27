<?php
namespace Excellence\Hello\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ActionEdit extends Column
{
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'hello/world/edit',
                        ['id' => $item['excellence_hello_test_id']]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'hello/world/delete',
                        ['id' => $item['excellence_hello_test_id']]
                    ),
                    'label' => __('Delete'),
                    'hidden' => false,
                    'confirm' => [
                        'title' => 'Delete ${$.$data.title}',
                        'message' => 'Do you really want to delete a ${$.$data.title}?'
                    ]
                ];
            }
        }

        return $dataSource;
    }
}