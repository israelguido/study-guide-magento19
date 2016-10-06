<?php
Login por CPF ou CNPJ
public function indexAction()
    {
        $user = $this->getRequest()->getParams();
        $username = $user['login']['username'];
        $password = $user['login']['password'];

        $websiteId = Mage::app()->getWebsite()->getId();
        $store = Mage::app()->getStore();
        $customer = Mage::getModel('customer/customer')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('taxvat',  $username)
            ->getFirstItem();

        $customer->website_id = $websiteId;
        $customer->setStore($store);

        try {
            $customer->loadByEmail($customer->getEmail());
            $session = Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);
            $session->login($customer->getEmail(), $password);
            $this->_redirect('customer/account');


        }catch(Exception $e){
            //Mage::getSingleton('core/session')->addError($this->__('Error login invalid data'));
            $this->_redirect('customer/account/login');
            return false;
        }
    }