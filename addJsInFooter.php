<!-- get the block which we want our content in -->
<reference name="before_body_end">
    <!-- add another block of type page/html_head to have all the great functionality to add/remove css and js stuff -->
    <!-- it is important to set your own template, because the head block has a defined default template page/head.phtml which has all the stuff of the head. Using this will bring a lot of problems -->
    <block type="page/html_head" name="scripts_in_footer" template="YOUR TEMPLATE">
        <!-- add whatever you want as you are used to in the head via the standard magento api -->
        <action method="addItem"><type>skin_css</type><name>css/styles.css</name></action>
    </block>
</reference>


<?php // and to echo the whole stuff later in the template, you need to add the code, so the added js/Css files are echoed ?>
<?php echo $this->getCssJsHtml() ?>
<?php echo $this->getChildHtml() ?>