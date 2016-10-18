<?php
$collection = $this->getCollection()
    ->addFieldToFilter('created_at',
        array(
            array('lteq' => '2016-09-30 20:00:00'),
        ))
    ->addFieldToFilter('created_at',
        array(
            array('gteq' => '2016-09-30 19:00:00'),
        ));

$this->setCollection($collection);
?>