<?php

//nao é uma boa pratica mais ajuda a agilizar de vez em quanto ;)
//passar uma variavel direto do controller para o block e pegar  no phtml
		$response = $soap::getConsultar($data);
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('core/template');
        $block->setData('response', $response);
        $block->setTemplate('consulta/consulta-geral.phtml');
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();

        //paara pegar no phtml 
        echo $this->getResponse();