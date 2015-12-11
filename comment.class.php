<?php

    Class Comment{
        private $data = array();

        public function __construct($row){
            /* the constructor */

            $this->data = $row;
        }

        public function markup(){
            /* This method generates markup for comment */

             $d = &$this->data;

             return $d['text'];
        }
    }

?>
