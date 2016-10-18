<?php 
	//Codigo do mau para setar o bloco e o phtml em qualquer lugar by @rafaelstz =) salvo a guerra
	echo $this->getLayout()->createBlock('newsletter/subscribe')
	->setTemplate('newsletter/subscribe.phtml')
	->toHtml(); 
?>

MageWorx_CustomerCredit_Block_Customer_View_Credit

frontend/ultimo/default/template/mageworx/customercredit/customer/view/credit.phtml

echo $this->getLayout()->createBlock('mageworx/customercredit/customer/view/credit')
	->setTemplate('mageworx/customercredit/customer/view/credit.phtml')
	->toHtml();