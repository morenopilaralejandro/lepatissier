<?php
    require_once __DIR__ . '/../php/Manager.php';
    require_once __DIR__ . '/../php/WebComp.php';
    require_once __DIR__ . '/../php/class/Contact.php';

    $man = new Manager();
    $langCode = $man->getLangCode();
    $webComp = new WebComp(false, $langCode);
    $path = $webComp->getPath();
    include __DIR__ . "/{$path}/php/lang/{$langCode}.php";


    $showToast = false;
    $contactName = "";
    $contactEmail = "";
    $contactMsg = ""; 
    if(isset($_POST['contactSubmit'])) {
        if(isset($_POST['contactName'])) { 
            $contactName = $_POST['contactName'];
        }
        if(isset($_POST['contactEmail'])) { 
            $contactEmail = $_POST['contactEmail'];
        }
        if(isset($_POST['contactMsg'])) { 
            $contactMsg = $_POST['contactMsg'];
        }
        
        $isValid = $man->validateContactFrm(
            $contactName, 
            $contactEmail, 
            $contactMsg);
        if($isValid) {
            $contactObj = Contact::factory();
            $isInserted = $contactObj->insert(
                -1, $contactName, $contactEmail, $contactMsg, "", 1);
            if($isInserted) {
                $showToast = true;
            }
        }
    }
?>
<!doctype html>
<html lang="<?=$langCode?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="keywords" content="<?=$strKeywords?>">
	    <meta name="description" content="<?=$strDesc5?>">
	    <meta name="author" content="<?=$strAuthor?>">
        <title><?=$strTitle5?></title>

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

        <div class="container mb-3 contact">
            <h1><?=$strContact1?></h1>
            <form class="contactForm" action="#" method="post" 
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="contactName"><?=$strContact2?></label>
                    <input type="text" class="form-control"  required
                        id="contactName" name="contactName" maxlength="32">
                </div>

                <div class="form-group">
                    <label for="contactEmail"><?=$strContact3?></label>
                    <input type="email" class="form-control" required
                        id="contactEmail" name="contactEmail" maxlength="32">
                </div>

                <div class="form-group">
                    <label for="contactMsg"><?=$strContact4?></label>
                    <textarea class="form-control" required
                        id="contactMsg" rows="3" name="contactMsg" 
                        maxlength="2000"></textarea>
                </div>

                <button class="btn btn-primary btn-lg" type="submit"
                    id="contactSubmit" rows="3" name="contactSubmit">
                    <?=$strContact5?>
                </button>
            </form>
            <?php
            if(true) {
                echo $webComp->getToast($strContact6);
            }
            ?>
        </div>

        <footer class="py-3 border-top fixed-bottom"><?=$webComp->getFooter()?></footer>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"></script>
    </body>
</html>
