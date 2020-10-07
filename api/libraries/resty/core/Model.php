<?php
    class Model extends ORM{
        private $data = array();
        public function __construct($data = null){
            $this->data = $data;
        }
        public function __get($name){
            if(array_key_exists($name, $this->data)){
                return $this->data[$name];
            }
        }
        public function __set($name, $value){
            $this->data[$name] = $value;
        }
        public function getData(){
            return $this->data;
        }
        public function __toString(){
            return json_encode($this->data);
        }
    }
?>