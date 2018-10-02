<?php

namespace Epartment\Widgets\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    const TABLE_NAME_EPARTMENT_WIDGETS = 'epartment_widgets';

    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists(self::TABLE_NAME_EPARTMENT_WIDGETS)) {
            $table = $installer->getConnection()->newTable(self::TABLE_NAME_EPARTMENT_WIDGETS)
                ->addColumn('id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true
                ])
                ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [
                    'nullable' => false
                ])
                ->addColumn('type', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [
                    'nullable' => false
                ])
                ->addColumn('configuration', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, null, [
                    'nullable' => true
                ]);

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}