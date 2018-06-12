<?php
namespace Excellence\Hello\Model\Config\Source;

class Custom implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            'value' => 'Label',
            'another_value' => 'Another label'
        ];
    }
}