<?php

//Text Field

$fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('form')->__('Title3'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "alert('on click');",
          'onchange' => "alert('on change');",
          'style'   => "border:10px",
          'value'  => 'hello !!',
          'disabled' => false,
          'readonly' => true,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
//Time

$fieldset->addField('time', 'time', array(
          'label'     => Mage::helper('form')->__('Time'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'value'  => '12,04,15',
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
//TextArea

$fieldset->addField('textarea', 'textarea', array(
          'label'     => Mage::helper('form')->__('TextArea'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'value'  => '<b><b/>',
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
//Submit Button

$fieldset->addField('submit', 'submit', array(
          'label'     => Mage::helper('form')->__('Submit'),
          'required'  => true,
          'value'  => 'Submit',
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
//DropDown

$fieldset->addField('select', 'select', array(
          'label'     => Mage::helper('form')->__('Select'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'values' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(), //usando para campos yes/no
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
//Here is another version of the drop down

$fieldset->addField('select2', 'select', array(
          'label'     => Mage::helper('form')->__('Select Type2'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'value'  => '4',
          'values' => array(
                                '-1'=>'Please Select..',
                                '1' => array(
                                                'value'=> array(array('value'=>'2' , 'label' => 'Option2') , array('value'=>'3' , 'label' =>'Option3') ),
                                                'label' => 'Size'    
                                           ),
                                '2' => array(
                                                'value'=> array(array('value'=>'4' , 'label' => 'Option4') , array('value'=>'5' , 'label' =>'Option5') ),
                                                'label' => 'Color'   
                                           ),                                         
                                  
                           ),
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

//Radio Button

$fieldset->addField('radio', 'radio', array(
          'label'     => Mage::helper('form')->__('Radio'),
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

$fieldset->addField('radio2', 'radios', array(
          'label'     => Mage::helper('form')->__('Radios'),
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'value'  => '2',
          'values' => array(
                            array('value'=>'1','label'=>'Radio1'),
                            array('value'=>'2','label'=>'Radio2'),
                            array('value'=>'3','label'=>'Radio3'),
                       ),
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

//Password Field

$fieldset->addField('password', 'password', array(
          'label'     => Mage::helper('form')->__('Password'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'style'   => "",
          'value'  => 'hello !!',
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

$fieldset->addField('obscure', 'obscure', array(
          'label'     => Mage::helper('form')->__('Obscure'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'obscure',
          'onclick' => "",
          'onchange' => "",
          'style'   => "",
          'value'  => '123456789',
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

//Note

$fieldset->addField('note', 'note', array(
          'text'     => Mage::helper('form')->__('Text Text'),
        ));

//Multiselect

$fieldset->addField('multiselect2', 'multiselect', array(
          'label'     => Mage::helper('form')->__('Select Type2'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "return false;",
          'onchange' => "return false;",
          'value'  => '4',
          'values' => array(
                                '-1'=> array( 'label' => 'Please Select..', 'value' => '-1'),
                                '1' => array(
                                                'value'=> array(array('value'=>'2' , 'label' => 'Option2') , array('value'=>'3' , 'label' =>'Option3') ),
                                                'label' => 'Size'    
                                           ),
                                '2' => array(
                                                'value'=> array(array('value'=>'4' , 'label' => 'Option4') , array('value'=>'5' , 'label' =>'Option5') ),
                                                'label' => 'Color'   
                                           ),                                         
                                  
                           ),
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
        
//Multiline

$fieldset->addField('multiline', 'multiline', array(
          'label'     => Mage::helper('form')->__('Multi Line'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          'onclick' => "",
          'onchange' => "",
          'style'   => "border:10px",
          'value'  => 'hello !!',
          'disabled' => false,
          'readonly' => true,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));
//Link

$fieldset->addField('link', 'link', array(
          'label'     => Mage::helper('form')->__('Link'),
          'style'   => "",
          'href' => 'www.excellencemagentoblog.com',
          'value'  => 'Magento Blog',
          'after_element_html' => ''
        ));

//Label


$fieldset->addField('label', 'label', array(
          'value'     => Mage::helper('form')->__('Label Text'),
        ));


//Image Upload

$fieldset->addField('image', 'image', array(
          'value'     => 'http://www.excellencemagentoblog.com/wp-content/themes/excelltheme/images/logo.png',
        ));


//File Upload

$fieldset->addField('file', 'file', array(
          'label'     => Mage::helper('form')->__('Upload'),
          'value'  => 'Uplaod',
          'disabled' => false,
          'readonly' => true,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));

//Date

$fieldset->addField('date', 'date', array(
          'label'     => Mage::helper('form')->__('Date'),
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1,
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));

//Checkbox

$fieldset->addField('checkbox', 'checkbox', array(
          'label'     => Mage::helper('form')->__('Checkbox'),
          'name'      => 'Checkbox',
          'checked' => false,
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'disabled' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));


$fieldset->addField('checkboxes', 'checkboxes', array(
          'label'     => Mage::helper('form')->__('Checkboxs'),
          'name'      => 'Checkbox',
          'values' => array(
                            array('value'=>'1','label'=>'Checkbox1'),
                            array('value'=>'2','label'=>'Checkbox2'),
                            array('value'=>'3','label'=>'Checkbox3'),
                       ),
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'disabled' => false,
          'after_element_html' => '<small>Comments</small>',
          'tabindex' => 1
        ));