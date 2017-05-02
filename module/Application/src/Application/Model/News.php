<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory; // 新加导入包
use Zend\InputFilter\InputFilter; // 新加导入包
use Zend\InputFilter\InputFilterAwareInterface; // 新加导入包
use Zend\InputFilter\InputFilterInterface; // 新加导入包
class News implements InputFilterAwareInterface {// 添加了接口

    public $id;

    public $content;

    public $title;

    protected $inputFilter;

 

 

    public function exchangeArray($data){

        $this->id       = (isset($data['id'])) ? $data['id'] : null;

        $this->content   = (isset($data['content'])) ? $data['content'] : null;

        $this->title    = (isset($data['title'])) ? $data['title'] : null;

    }

   

    public function getArrayCopy(){

        return get_object_vars($this);

    }

 

    public function getInputFilter() {// 新添加，实现接口方法

        if(!$this->inputFilter){

            $this->inputFilter = new InputFilter();

            $factory           = new InputFactory();

            $this->inputFilter->add($factory->createInput(array(

                'name'=>'id',

                'required'=>true,

                'filters'=>array(

                    array('name'=>'Int'),

                ),

            )));

           

            $this->inputFilter->add($factory->createInput(array(

                'name'=>'content',

                'required'=>true,

                'filters'=>array(

                    array('name'=>'StripTags'),

                    array('name'=>'StringTrim'),

                ),

                'validators'=>array(

                    array(

                        'name'=>'StringLength',

                        'options'=>array(

                            'encoding'=>'UTF-8',

                            'min'=>5,

                            'max'=>100,

                        ),

                    ),

                ),

            )));

           

            $this->inputFilter->add($factory->createInput(array(

                'name'=>'title',

                'required'=>true,

                'filters'=>array(

                    array('name'=>'StripTags'),

                    array('name'=>'StringTrim'),

                ),

                'validators'=>array(

                    array(

                        'name'=>'StringLength',

                    'options'=>array(

                        'encoding'=>'UTF-8',

                        'min'=>5,

                        'max'=>100,

                    ),

                    ),

                ),

            )));

        }

        return $this->inputFilter;

    }

 

    public function setInputFilter(InputFilterInterface $inputFilter) {// 新添加，实现接口方法

        throw new \Exception('Not used');

    }
}