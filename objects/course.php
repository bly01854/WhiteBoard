<?php

    class course {
        
        private $id;
        private $name;
        private $description;
        private $staffId;
        
        
        
        public function set_id($new_id){
            $this->id = $new_id;
        }
        public function get_id() {
            return $this->id;
        }
        
        public function set_name($new_name){
            $this->name = $new_name;
        }
        public function get_name(){
            return $this->name;
        }
        
        public function set_description($new_description){
            $this->description = $new_description;
        }
        public function get_description(){
            return $this->description;
        }
        
        public function set_staffId($new_staffId){
            $this->staffId = $new_staffId;
        }
        public function get_staffId(){
            return $this->staffId;
        }
        
        public function __get($id){
            return $this->$id;
        }
        
        public function __isset($id)  {
            return isset($this->$i);
        }
        
    }