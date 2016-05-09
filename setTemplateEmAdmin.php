<?php
/**
 * Created by PhpStorm.
 * User: IsraelGuido@gmail.com
 * Date: 09/05/16
 * Time: 10:20
 */

//COMO SETAR UM TEMPLATE INDEPENDENTE DE ONDE VOCE ESTIVER

public function sendAction()
{
    $this->_title($this->__('Webjump'))->_title($this->__('Send Notification'));
    $this->loadLayout()
        ->_addContent(
            $this->getLayout()
                ->createBlock('webjump_ambevpushnotification/adminhtml_send')
                ->setTemplate('webjump/send.phtml'))
        ->renderLayout();
}