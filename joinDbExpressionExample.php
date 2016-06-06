<?php
/**
 * Reseller Model Setup
 *
 * @package     Webjump_AmbevReseller
 * @author      Israel Guio Webjump Core Team <desenvolvedores@webjump.com>
 * @copyright   2014 Webjump (http://www.webjump.com.br)
 * @license     http://www.webjump.com.br  Copyright
 * @link        http://www.webjump.com.br
 */
class Webjump_Extapi_Model_Api2_Order_Rest_Admin_V1
    extends Webjump_Extapi_Model_Api2_Order {

    const GROUP_PAYMENT         = 'payment_method';
    const GROUP_DATE            = 'date';
    const GROUP_STATUS          = 'status';
    const GROUP_STATE           = 'state';
    const GROUP_REGION          = 'region';
    const GROUP_NGE             = 'cd_segment_nge';

    public function _retrieveCollection(){
        $group =  $this->getRequest()->getParam('group');
        $collection = $this->_getCollectionForRetrieve();
        if($group){
            $collection->getSelect()->group(array($group));
        }

        switch ($group){
            case self::GROUP_PAYMENT :
                $collection->getSelect()
                    ->join(array('payment'=> Mage::getSingleton('core/resource')->getTableName('sales/order_payment')),'main_table.entity_id=payment.parent_id',array('method AS payment_method'));
                break;

            case self::GROUP_REGION :
                $collection->getSelect()
                    ->join(array('shipping_address'=> Mage::getSingleton('core/resource')->getTableName('sales/order_address')),'main_table.shipping_address_id=shipping_address.entity_id',array('region','region_id'));
                break;

            case self::GROUP_NGE :
                $collection->getSelect()
                    ->join(
                        array('customer_nge' => 'customer_entity_int'),
                        'main_table.customer_id = customer_nge.entity_id AND customer_nge.attribute_id= (SELECT attribute_id FROM eav_attribute WHERE attribute_code = "cd_segmento_nge")',
                        array('CASE customer_nge.value
                            WHEN 1 THEN "Lj.Conveniencia"
                            WHEN 2 THEN "AS"
                            WHEN 3 THEN "Padaria/Confeitaria"
                            WHEN 4 THEN "Armazem/Mercearia"
                            WHEN 5 THEN "Atacadista"
                            WHEN 6 THEN "Deposito de bebidas (adega/ servfesta)"
                            WHEN 7 THEN "Frio Especializado"
                            WHEN 8 THEN "Frio Grande"
                            WHEN 9 THEN "Frio Pequeno"
                            WHEN 11 THEN "AS (5-9)"
                            WHEN 12 THEN "AS (10-20)"
                            WHEN 13 THEN "AS (>20)"
                            END AS segment_nge', 'customer_nge.value AS cd_segment_nge')
                        
                    );
                break;
        }
        
        $ordersData = array();

        foreach ($collection->getItems() as $order) {
            $orderData = $order->toArray();
            if(!$group || $group != self::GROUP_DATE){
                unset($orderData['date']);
            }
            if ($group){
                $ordersData[$order->getData($group)] = $orderData;
            } else {
                $ordersData[] = $orderData;
            }
        }
        return $ordersData;
    }

}