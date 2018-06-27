<?php
namespace Smart\OSC\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        //START: install stuff
        //END:   install stuff
        
        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('smart_osc_option')
        )->addColumn(
            'option_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [ 'nullable' => false, 'unsigned' => true, 'default' => '0'],
            'Product ID'
        )->addColumn(
            'type',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            [ 'nullable' => true],
            'Option type'
        )->addColumn(
            'is_require',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            6,
            [ 'nullable' => false, 'default' => '1'],
            'Option is require or not'
        )->addColumn(
            'sku',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            64,
            [ 'nullable' => true],
            'SKU of product option'
        )->addColumn(
            'image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => true],
            'Image for option'
        )->addColumn(
            'thumb_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            7,
            [ 'nullable' => true ],
            'Color for option'
        )->addColumn(
            'display_mode',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            6,
            [ 'nullable' => false, 'default' => 'image' ],
            'Display mode image or color'
        )->addColumn(
            'is_default',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            6,
            [ 'nullable' => false, 'default' => '0' ],
            'Set option  is default or not'
        )->addColumn(
            'sort_order',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [ 'nullable' => false, 'default' => '0', ],
            'Position of order in list option'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup
$installer->endSetup();
    }
}
