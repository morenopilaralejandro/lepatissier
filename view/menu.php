<?php
    require_once __DIR__ . '/../php/Manager.php';
    require_once __DIR__ . '/../php/WebComp.php';
    require_once __DIR__ . '/../php/class/Cat.php';

    $man = new Manager();
    $langCode = $man->getLangCode();
    $webComp = new WebComp(false, $langCode);
    $path = $webComp->getPath();
    include __DIR__ . "/{$path}/php/lang/{$langCode}.php";

    $catObj = Cat::factory();
    $catResult = $catObj->getAllCat();
    $catArr = Array();
    $catName = "";
    while($row = $catResult->fetch_assoc()) {
        $catObj = new Cat(
            $row['catId'], 
            $row['catNameEn'],
            $row['catNameEs']);
        array_push($catArr, $catObj);
    }
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

        <?php
            foreach($catArr as $c) {
                $catName = $c->getCatNameByLangCode($langCode);
                
                $prodObj = Prod::factory();
                $prodResult = $prodObj->getProdByCatId($c->getCatId());
                $prodArr = Array();
                $prodName = "";
                $prodDesc = "";

                while($row = $prodResult->fetch_assoc()) {
                    $prodObj = new Prod(
                        $row['prodId'], 
                        $row['prodNameEn'],
                        $row['prodNameEs'],
                        $row['prodDescEn'],
                        $row['prodDescEs'],
                        $row['prodPrice'],
                        $row['catId']);
                    array_push($prodArr, $prodObj);
                }         

                echo "<div class='container mb-3'>";
                    echo "<h2>{$catName}</h2>";
                    echo "<div class='prod justify-content-start'>";
                        foreach($prodArr as $p) {
                            $prodName = $p->getProdNameByLangCode($langCode);
                            $prodDesc = $p->getProdDescByLangCode($langCode);
                            echo "<a href='{$path}/view/item.php?id={$p->getProdId()}' 
                                class='card text-muted text-decoration-none' 
                                style='width: 18rem;'>";
                                echo "<img class='card-img-top' 
                                    src='{$path}img/products/default.png' 
                                    alt='{$prodName}'>";
                                echo "<div class='card-body'>";
                                    echo "<h5 class='card-title'>{$prodName}</h5>";
                                echo "</div>";
                            echo "</a>";
                        }
                    echo "</div>";
                echo "</div>";
            }
        ?>

        <footer class="py-3 border-top"><?=$webComp->getFooter()?></footer>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"></script>
    </body>
</html>
