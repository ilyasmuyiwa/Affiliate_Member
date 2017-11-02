<?php

namespace Test\Affiliate\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('test_affliate_info')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Member ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Member Name'
        )->addColumn(
            'image_path',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'profile image path'
        )->addColumn(
            'status',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Member status'
        )->addColumn(
             'created_at',
            Table::TYPE_TIMESTAMP,
             null,
             ['nullable' => false, 'default' =>Table::TIMESTAMP_INIT],
            'Created At'
        )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
            'Updated At'

        )->addIndex(
            $setup->getIdxName('test_affliate__info', ['name']),
            ['name']
        )->setComment(
            'Affiliate memeber information'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
