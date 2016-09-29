<?php

//remove attributo EAV
$installer = $this;
$installer->startSetup();
// Remove Product Attribute
$installer->removeAttribute('catalog_product', 'product_attribute_code');
// Remove Customer Attribute
$installer->removeAttribute('customer', 'customer_attribute_code');
$installer->endSetup();