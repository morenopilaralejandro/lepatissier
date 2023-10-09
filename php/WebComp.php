<?php
require_once __DIR__ . '/class/Video.php';
class webComp {
    private bool $isIndex;
    private string $langFile;
    private string $path;

    //functions
    function getHeader(): string {
        include __DIR__ . $this->langFile;
        $inner = "";

        return $inner;
    }

    public function getFooter(): string {

    }

    //constructor
    public function __construct(bool $isIndex, string $langFile) {
        $this->isIndex = $isIndex; 
        $this->langFile = "/../php/lang/{$langFile}.php";

        if($isIndex){
            $this->path = "";
        } else {
            $this->path = "../";
        }
    }

    //setter getter
    public function setIsIndex(bool $isIndex) { 
        $this->isIndex = $isIndex; 
    }
    public function getIsIndex(): bool { 
        return $this->isIndex; 
    }    

    public function setLangFile(string $langFile) { 
        $this->langFile = $langFile; 
    }
    public function getLangFile(): string { 
        return $this->langFile; 
    }   

    public function setPath(string $path) { 
        $this->path = $path; 
    }
    public function setPath(): string { 
        return $this->path; 
    }    
} 
?>
