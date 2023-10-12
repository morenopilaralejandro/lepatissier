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
        <nav class='navbar navbar-expand-lg navbar-light'>
            <a class='navbar-brand' 
                href='{$path}index.php'>
                {$strWebName}
            </a>

            <button class='navbar-toggler' type='button' 
                data-bs-toggle='collapse' data-bs-target='#navbarToggler' 
                aria-controls='navbarToggler' aria-expanded='false' 
                aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navbarToggler'>
                <ul class='navbar-nav mr-auto mt-2 mt-lg-0 '>
                    <li class='nav-item'>
                        <a href='{$path}view/menu.php' class='nav-link'>
                            {$strNav1}
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a href='{$path}view/about.php' class='nav-link'>
                            {$strNav2}
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a href='{$path}view/contact.php' class='nav-link'>
                            {$strNav3}
                        </a>
                    </li>
                </ul>
            </div>
        </nav>";
        return $inner;
    }

    public function getFooter(): string {
        include __DIR__ . $this->langFile;
        $path = $this->path;
        $inner = "
        <ul class='nav justify-content-center pb-3 mb-1'>
            <li>
                <a class='text-muted' href='#'>
                    <img class='bi' width='24' height='24' 
                        src='{$path}img/icon/insta.png' alt='instagram'>
                </a>
            </li>
           <li class='ms-3'>
                <a class='text-muted' href='#'>
                    <img class='bi' width='24' height='24' 
                        src='{$path}img/icon/tiktok.png' alt='tiktok'>
                </a>
            </li>
        </ul>
        <p class='text-center text-muted'>© 2023 {$strWebName}</p>";
        return $inner;
    }

    public function getLandingCarousel(): string {
        include __DIR__ . $this->langFile;
        $path = $this->path;
        $pathImg = $this->path."img/carousel/";
        $inner = "
        <div id='landingCarousel' class='carousel slide' data-ride='carousel'>
            <ol class='carousel-indicators'>
                <li data-bs-target='#landingCarousel' data-bs-slide-to='0' class='active'></li>
                <li data-bs-target='#landingCarousel' data-bs-slide-to='1'></li>
                <li data-bs-target='#landingCarousel' data-bs-slide-to='2'></li>
            </ol>
            <div class='carousel-inner'>
                <div class='carousel-item active'>
                    <img class='d-block w-100' 
                        src='{$pathImg}default1.png' alt='0'>
                </div>
                <div class='carousel-item'>
                    <img class='d-block w-100' 
                    src='{$pathImg}default2.png' alt='1'>
                </div>
                <div class='carousel-item'>
                    <img class='d-block w-100' 
                    src='{$pathImg}default3.png' alt='2'>
                </div>
            </div>
            <a class='carousel-control-prev' href='#landingCarousel' role='button' 
                data-bs-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            </a>
            <a class='carousel-control-next' href='#landingCarousel' role='button' 
                data-bs-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
            </a>
        </div>";
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
