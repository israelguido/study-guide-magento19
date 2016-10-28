<?php
public function _getCustomerAttributeValueCompare($value, $attr)
    {
        $attribute = Mage::getSingleton('eav/config')->getAttribute('customer', $attr);
        if ($attribute->usesSource()) {
            $option = $attribute->getSource()->getOptionText($value);
            if($option == self::CLIENTE_ASSOCIADO){
                return "SS";
            }
            if($option == self::TIPO_PESSOA_PF){
                return "PF";
            }
            if($option == self::TIPO_PESSOA_PF){
                return "PJ";
            }
            return false;
        }
    }