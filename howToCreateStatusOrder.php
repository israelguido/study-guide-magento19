<?php 

$installer->startSetup();

Mage::getModel('sales/order_status')
->setStatus(Webjump_Brightstar_Model_Sales_Order_Config::STATUS_PURCHASE_ORDER_REJECTED)
->setLabel(Mage::helper('webjump_brightstar')->__('Purchase Order Rejected'))
->assignState(Mage_Sales_Model_Order::STATE_CANCELED)
->save();

$installer->endSetup();