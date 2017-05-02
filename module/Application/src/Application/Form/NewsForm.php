<?php
namespace Application\Form;

use Zend\Form\Form;

class NewsForm extends Form
{

    public function __construct($name = 'news')
    
    {
        parent::__construct($name);
        
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            
            'name' => 'id',
            
            'type' => 'Hidden'
        )
        );
        
        $this->add(array(
            
            'name' => 'title',
            
            'type' => 'Text',
            
            'options' => array(
                
                'label' => 'Title'
            )
            
        )
        );
        
        $this->add(array(
            
            'name' => 'content',
            
            'type' => 'Text',
            
            'options' => array(
                
                'label' => 'Content'
            )
            
        )
        );
        
        $this->add(array(
            
            'name' => 'submit',
            
            'type' => 'submit',
            
            'attributes' => array(
                
                'value' => 'Go',
                
                'id' => 'submit'
            )
            
        )
        );
    }
}