<?php

## Adicionando um phtml no meio da render, 
## usei num controller mas pode ser usado em qualquer lugar 

$this->loadLayout();
    $block = $this->getLayout()->createBlock('core/template');
        $block->setTemplate('helpmebuy/finalpage.phtml');

    $this->getLayout()->getBlock('content')->append($block);

    $this->renderLayout();