<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$attrCodeExpiration = 'expiration';
$attrGroupName = 'General';
$attrLabelExpiration = 'Expiração';
$attrNoteExpiration = 'Tempo de Expiracão em  Dias dos Créditos';

//Add Expiration attribute
$objCatalogEavSetup = Mage::getResourceModel('catalog/eav_mysql4_setup', 'core_setup');
$attrIdTest = $objCatalogEavSetup->getAttributeId(Mage_Catalog_Model_Product::ENTITY, $attrCodeExpiration);

if ($attrIdTest === false) {
    $objCatalogEavSetup->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attrCodeExpiration, array(
        'group' => $attrGroupName,
        'sort_order' => 7,
        'type' => 'varchar',
        'backend' => '',
        'frontend' => '',
        'label' => $attrLabelExpiration,
        'note' => $attrNoteExpiration,
        'input' => 'text',
        'class' => '',
        'source' => '',
        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible' => true,
        'required' => false,
        'user_defined' => true,
        'default' => '0',
        'visible_on_front' => false,
        'unique' => false,
        'is_configurable' => false,
        'used_for_promo_rules' => true
    ));
}