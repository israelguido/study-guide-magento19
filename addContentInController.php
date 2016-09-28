<?php

## Adicionando um phtml no meio da render, 
## usei num controller mas pode ser usado em qualquer lugar 

$this->loadLayout();
	$block = $this->getLayout()->createBlock('core/template');
	    $block->setTemplate('helpmebuy/finalpage.phtml');

	$this->getLayout()->getBlock('content')->append($block);

	$this->renderLayout();

## OR 

$this->loadLayout();
    $block = $this->getLayout()->createBlock('customer/form_login');
    $block->setTemplate('persistent/customer/form/login.phtml');

    $this->getLayout()->getBlock('content')->append($block);

    $this->renderLayout();