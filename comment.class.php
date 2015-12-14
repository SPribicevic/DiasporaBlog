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

             $d['date_time'] = strtotime($d['date_time']);

            return '
                <div id=comment>
                    <div id="name">'.$d['name'].'</div>
                    <div class="date" title="Added at '.
                    date('H:i \o\n d M Y',$d['date_time']).'">'.
                    date('d M Y',$d['date_time']).'</div>
                    <p>'.$d['body'].'</p>
                </div>
            ';


        }

        public static function validate_text($str){
            /* This method is used internally as a filter callback */

            if(mb_strlen($str,'utf8')<1){
                return false;
            }

            /* Encode all html characters and convert all new lines in <br> */

            $str = nl2br(htmlspecialchars($str));

            /* Remove new line characters */

            $str = str_replace(array(chr(10),chr(13)),'',$str);

            return $str;
        }

        public static function validate(&$arr){
            /*    This method is used to validate data sent from AJAX
                  Returns true or false, depending on whether data is valid,
                  and populates $arr with valid input data or error data */

            $post_data = [];
            $errors = [];

            if(!($post_data['body']=filter_input(INPUT_POST,'body',FILTER_CALLBACK,
                                    array('options' => 'Comment::validate_text')))){
                $errors['body'] = "Please enter a comment body.";
            }

            if(!($post_data['name']=filter_input(INPUT_POST,'name',FILTER_CALLBACK,
                array('options' => 'Comment::validate_text')))){
                $errors['name'] = "Please enter a name.";
            }

            if(!empty($errors)){
                // If there are errors, copy errors array to $arr

                $arr = $errors;
                return false;
            }

            foreach($post_data as $k=>$v){
                $arr[$k] = mysql_real_escape_string($v);
            }

            return true;

        }
    }

?>
