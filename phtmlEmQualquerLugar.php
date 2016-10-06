<?php 
	//Codigo do mau para setar o bloco e o phtml em qualquer lugar by @rafaelstz =) salvo a guerra
	echo $this->getLayout()->createBlock('newsletter/subscribe')
	->setTemplate('newsletter/subscribe.phtml')
	->toHtml(); 
?>