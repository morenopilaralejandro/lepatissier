<?php
require_once __DIR__ . '/class/Video.php';
class webComp {
    private string $langFile;

    //functions
    function getHeader(int $optRedir, bool $showHamburger): string {
        include __DIR__ . $this->langFile;
        $mainLink = "";

        return $inner;
    }

    public function getFooter(): string {

    }

    //constructor
    public function __construct(string $langFile) {
        $this->langFile = "/../php/lang/{$langFile}.php";
    }

    //setter getter
    public function setLangFile(string $langFile) { 
        $this->langFile = $langFile; 
    }
    public function getLangFile(): string { 
        return $this->langFile; 
    }    
} 
?>
