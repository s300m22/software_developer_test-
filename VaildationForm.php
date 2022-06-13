<?php
class VaildationForm{
    public $request;
    public $rules;
    public $result;
    public $vaild;
    
    function __construct($request,$rules) {
        $this->result=[];
        $this->request=$request;
        $this->rules=$rules;
        $this->vaild=true;
    }
    
    /**
     * Check each input is valid
     * @param null
     * @return boolean $valid true || false
     */
    public function isValid(){
        foreach($this->request as $key => $val){
            if(isset($this->rules[$key]))
                if(is_array($val)) {
                    $i=0;
                    foreach($val as $value) 
                        if(!$this->validateField($value,$this->rules[$key])) {
                            $this->vaild=false;
                            $this->result[$key][$i++]=false;
                        }else $this->result[$key][$i++]=true;
                }else if(!$this->validateField($val,$this->rules[$key])) {
                    $this->vaild=false;
                    $this->result[$key]=false;
                }else $this->result[$key]=true;
        }
        return $this->vaild;
    }
    
     /**
     * Check each input depend on regular expression (name, email, phone)
     * @param $value
     * @param $rule
     */
    public function validateField($value,$rule){
        switch($rule){
            case 'name': return preg_match("/^[a-zA-Z- ]+$/",$value);
            case 'email': return filter_var($value, FILTER_VALIDATE_EMAIL);
            case 'phone': return preg_match("/^[1-9]+$/",$value);
        }
        
    }
    
}

?>