<?php
require_once __DIR__ . '/class/Prod.php';
class webComp {
    private bool $isIndex;
    private string $langFile;
    private string $path;

    //functions
    function getHeader(): string {
        include __DIR__ . $this->langFile;
        $path = $this->path;
        $inner = "
        <a href='{$path}index.php' class='d-flex align-items-center mb-3 mb-md-0 me-md-auto 
            text-dark text-decoration-none'>
            <span class='fs-4 logo-text'>{$strWebName}</span>
        </a>

        <ul class='nav nav-pills'>
            <li class='nav-item'><a href='#' class='nav-link'>{$strNav1}</a></li>
            <li class='nav-item'><a href='#' class='nav-link'>{$strNav2}</a></li>
            <li class='nav-item'><a href='#' class='nav-link'>{$strNav3}</a></li>
        </ul>";
        return $inner;
    }

    public function getFooter(): string {
        include __DIR__ . $this->langFile;
        $inner = "
        <ul class='nav col-md-4 justify-content-end list-unstyled d-flex'>
            <li class='ms-3'>
                <a class='text-muted' href='#'>
                    <svg class='bi' width='24' height='24'><use xlink:href='#twitter'></use></svg>
                </a>
            </li>
            <li class='ms-3'>
                <a class='text-muted' href='#'>
                    <svg class='bi' width='24' height='24'><use xlink:href='#instagram'></use></svg>
                </a>
            </li>
            <li class='ms-3'>
                <a class='text-muted' href='#'>
                    <svg class='bi' width='24' height='24'><use xlink:href='#facebook'></use></svg>
                </a>
            </li>
        </ul>
        <p class='text-center text-muted'>© 2023 {$strWebName}</p>";
        return $inner;
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
    public function getPath(): string { 
        return $this->path; 
    }    
} 
?>
