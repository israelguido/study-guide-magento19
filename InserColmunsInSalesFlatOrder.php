<?php 

/*Inser column in sales flat order
nunca esquecer de colocar no config.xml do modulo*/

/* @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;
$installer->startSetup();
$installer->run(" 
ALTER TABLE `{$installer->getTable('sales/order')}` ADD `order_type` VARCHAR(255) NOT NULL;
ALTER TABLE `{$installer->getTable('sales/order_grid')}` ADD `order_type` VARCHAR(255) NOT NULL;
ALTER TABLE `{$installer->getTable('sales/quote')}` ADD `order_type` VARCHAR(255) NOT NULL; 
");
$installer->endSetup();