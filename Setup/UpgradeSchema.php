<?php
/**
 * Copyright © 2019 GetReady. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beecom\BetterSlider\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $installer = $setup->getConnection();
        $table = $setup->getTable('beecom_betterslider_banner');
        $tableSlider = $setup->getTable('beecom_betterslider_slider');

        if (version_compare($context->getVersion(), '2.0.0', '<')) {
            if ($this->isTableColumnMissing($installer, $table, 'upload_file_desktop_large')) {
                $installer->addColumn(
                    $table,
                    'upload_file_desktop_large',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => 255,
                        'comment' => 'Banner Upload File Desktop Large',
                        'after' => 'caption_text'
                    ]
                );
            }

            if ($this->isTableColumnMissing($installer, $table, 'upload_file_desktop_smaller')) {
                $installer->addColumn(
                    $table,
                    'upload_file_desktop_smaller',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => 255,
                        'comment' => 'Banner Upload File Sesktop Smaller',
                        'after' => 'upload_file_desktop_large'
                    ]
                );
            }

            if ($this->isTableColumnMissing($installer, $table, 'upload_file_tablet_large')) {
                $installer->addColumn(
                    $table,
                    'upload_file_tablet_large',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => 255,
                        'comment' => 'Banner Upload File Tablet Large',
                        'after' => 'upload_file_desktop_smaller'
                    ]
                );
            }

            if ($this->isTableColumnMissing($installer, $table, 'upload_file_tablet_smaller')) {
                $installer->addColumn(
                    $table,
                    'upload_file_tablet_smaller',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => 255,
                        'comment' => 'Banner Upload File Tablet Smaller',
                        'after' => 'upload_file_tablet_large'
                    ]
                );
            }

            if ($this->isTableColumnMissing($installer, $table, 'upload_file_phone')) {
                $installer->addColumn(
                    $table,
                    'upload_file_phone',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => 255,
                        'comment' => 'Banner Upload File Phone',
                        'after' => 'upload_file_tablet_smaller'
                    ]
                );
            }

            if (!$this->isTableColumnMissing($installer, $table, 'upload_file')) {
                $installer->dropColumn(
                    $table,
                    'upload_file'
                );
            }
        }

        if (version_compare($context->getVersion(), '2.0.1', '<')) {
            if ($this->isTableColumnMissing($installer, $tableSlider, 'caption_alignment')) {
                $installer->addColumn(
                    $tableSlider,
                    'caption_alignment',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => '64k',
                        'comment' => 'Slider Caption Alignment',
                        'after' => 'status'
                    ]
                );
            }
            if (!$this->isTableColumnMissing($installer, $table, 'caption_alignment')) {
                $installer->dropColumn(
                    $table,
                    'caption_alignment'
                );
            }
        }

        $setup->endSetup();
    }

    protected function isTableColumnMissing($installer, $tableName, $columnName)
    {
        return (bool) ($installer->tableColumnExists($tableName, $columnName) === false);
    }
}
