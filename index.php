<?php
    require_once __DIR__ . '/php/Manager.php';
    require_once __DIR__ . '/php/WebComp.php';

    $man = new Manager();
    $langCode = $man->getLangCode();
    $webComp = new WebComp(true, $langCode);
    $path = $webComp->getPath();
    include __DIR__ . "{$path}/php/lang/{$langCode}.php";
?>
<!doctype html>
<html lang="<?=$langCode?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="keywords" content="<?=$strKeywords?>">
	    <meta name="description" content="<?=$strDesc1?>">
	    <meta name="author" content="<?=$strAuthor?>">
        <title><?=$strTitle1?></title>

	    <link rel="apple-touch-icon" sizes="180x180" 
            href="<?=$path?>img/favicon/apple-touch-icon.png">
	    <link rel="icon" type="image/png" sizes="32x32" 
            href="<?=$path?>img/favicon/favicon-32x32.png">
	    <link rel="icon" type="image/png" sizes="16x16" 
            href="<?=$path?>img/favicon/favicon-16x16.png">
	    <link rel="manifest" href="<?=$path?>img/favicon/site.webmanifest">

        <link 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
            crossorigin="anonymous">
        <link rel="stylesheet" href="<?=$path?>css/style.css">
    </head>
    <body>
        <header class="border-bottom mb-3">
            <?=$webComp->getHeader()?>
        </header>

        <div class="container mb-3">
            <?=$webComp->getLandingCarousel()?>
        </div>

        <div class="container mb-3">
            <h1><?=$strIndex1?></h1>
            <p><?=$strIndex2?></p>
            <div class="text-center">
                <a class="btn btn-primary btn-lg mx-auto" href="view/menu.php" role="button">
                    <?=$strBtn1?>
                </a>
            </div>
        </div>

        <footer class="py-3 border-top"><?=$webComp->getFooter()?></footer>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"></script>
    </body>
</html>
