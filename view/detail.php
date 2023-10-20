<?php
    require_once __DIR__ . '/../php/Manager.php';
    require_once __DIR__ . '/../php/WebComp.php';
    require_once __DIR__ . '/../php/class/Cat.php';
    require_once __DIR__ . '/../php/class/Alle.php';
    require_once __DIR__ . '/../php/class/Prod.php';

    $man = new Manager();
    $langCode = $man->getLangCode();
    $webComp = new WebComp(false, $langCode);
    $path = $webComp->getPath();
    include __DIR__ . "/{$path}/php/lang/{$langCode}.php";

    if(isset($_GET['id'])) {
        $prodId = $_GET['id'];
    } else {
        $prodId = 1;
    }

    $showPrice = true;
    $showAlle = true;

    $prodObj = Prod::factory();
    $prodResult = $prodObj->getProdByProdId($prodId);
    while($row = $prodResult->fetch_assoc()) {
        $prodObj = new Prod(
            $row['prodId'], 
            $row['prodNameEn'],
            $row['prodNameEs'],
            $row['prodDescEn'],
            $row['prodDescEs'],
            $row['prodPrice'],
            $row['catId']);
    }
    $prodName = $prodObj->getProdNameByLangCode($langCode);
    $prodDesc = $prodObj->getProdDescByLangCode($langCode);

    $catObj = Cat::factory();
    $catResult = $catObj->getCatByCatId($prodObj->getCatId());
    $catArr = Array();
    while($row = $catResult->fetch_assoc()) {
        $catObj = new Cat(
            $row['catId'], 
            $row['catNameEn'],
            $row['catNameEs']);
        array_push($catArr, $catObj);
    }
    $catName = $catObj->getCatNameByLangCode($langCode);

    $alleObj = Alle::factory();
    $alleResult = $alleObj->getAlleByProdId($prodId);
    $alleArr = Array();
    while($row = $alleResult->fetch_assoc()) {
        $alleObj = new Alle(
            $row['alleId'], 
            $row['alleNameEn'],
            $row['alleNameEs']);
        array_push($alleArr, $alleObj);
    }

    /*
    print_r($prodObj);
    echo "<br><br><br>";
    print_r($catObj);
    echo "<br><br><br>";
    foreach($alleArr as $a) {
        print_r($a);
    }
    echo "<br><br><br>";
    print_r($prodName);
    echo "<br><br><br>";
    print_r($prodDesc);
    */
?>
<!doctype html>
<html lang="<?=$langCode?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="keywords" content="<?=$strKeywords?>">
	    <meta name="description" content="<?=$strDesc3?>">
	    <meta name="author" content="<?=$strAuthor?>">
        <title><?=$strTitle3?></title>

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
            <div class="detail">
                <div class="detailImg">
                    <img src="../img/products/default.png" 
                        class="img-fluid" alt="<?=$prodName?>">
                </div>
                <div class="detailText">
                    <h1><?=$prodName?></h1>
                    <p class="detailDesc"><?=$prodDesc?></p>
                    <?php
                    if($showAlle){
                        $i = 0;
                        $alleStr = "";
                        $alleStr .= $strDetail1;
                        //build string
                        if(count($alleArr) > 0) {
                            foreach($alleArr as $a) {
                                //concatenate name
                                $alleName = $a->getAlleNameByLangCode($langCode);
                                $alleStr .= $alleName;
                                //add ',' or conjunction
                                if($i == count($alleArr)-2) {
                                    $alleStr .= $strDetail2;
                                } else {
                                    $alleStr .= ", ";
                                }
                                $i++;
                            }
                            //remove last ',' and add '.'
                            $alleStr = substr($alleStr, 0, strlen($alleStr)-2);
                            $alleStr .= ".";                            
                        } else {
                            //empty
                            $alleStr .= $strDetail3;
                            $alleStr .= ".";
                        }

                        echo "<p>";
                            echo $alleStr;
                        echo "</p>";
                    }
                    if($showPrice) {
                        echo "<p class='detailPrice'>";
                            echo "{$prodObj->getProdPrice()} {$strMenu2}";
                        echo "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>



        <footer class="py-3 border-top customFooter"><?=$webComp->getFooter()?></footer>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"></script>
    </body>
</html>
