<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory; // �¼ӵ����
use Zend\InputFilter\InputFilter; // �¼ӵ����
use Zend\InputFilter\InputFilterAwareInterface; // �¼ӵ����
use Zend\InputFilter\InputFilterInterface; // �¼ӵ����
class News implements InputFilterAwareInterface {// ����˽ӿ�

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

 

    public function getInputFilter() {// ����ӣ�ʵ�ֽӿڷ���

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

 

    public function setInputFilter(InputFilterInterface $inputFilter) {// ����ӣ�ʵ�ֽӿڷ���

        throw new \Exception('Not used');

    }
}