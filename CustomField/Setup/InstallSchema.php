<?php

namespace Dev\CustomField\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $this->addDropDownColumn($setup);

        $installer->endSetup();
    }

    private function addDropDownColumn(SchemaSetupInterface $setup)
    {
        $dropDown = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'default' => NULL,
            'nullable' => true,
            'comment' => 'Drop Down'
        ];

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),
            'drop_down',
            $dropDown
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('quote_address'),
            'drop_down',
            $dropDown
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'drop_down',
            $dropDown
        );
    }
}
