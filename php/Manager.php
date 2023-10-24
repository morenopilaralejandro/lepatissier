<?php
class Manager {
    private string $langCode;

    //functions
    public function validateContactFrm(string $contactName, 
        string $contactEmail, string $contactMsg): bool {

        if(empty($contactName) || strlen($contactName)>32) {
            return false;
        }
        if(empty($contactName) || strlen($contactName)>32) {
            return false;
        }
        if(empty($contactName) || strlen($contactName)>2000) {
            return false;
        }
        return true;
    }

    //constructor
    public function __construct() {
        $auxLangCode = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $auxLangCode = substr($auxLangCode, 0, 2);
        $defaultLangCode = 'en';
        switch($auxLangCode) {
            case 'en':
                $defaultLangCode = 'en';
                break;
            case 'es':
                $defaultLangCode = 'es';
                break;
            default: 
                $defaultLangCode = 'en';
                break;    
        }
        $this->langCode = $defaultLangCode;
    }

    //setter getter
    public function setLangCode(string $langCode): void { 
        $this->langCode = $langCode;
    }
    public function getLangCode():string { 
        return $this->langCode; 
    }
}
?>
