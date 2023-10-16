<?php
require_once __DIR__ . '/../DbConnection.php';
class Cat {
    private int $catId;
    private string $catNameEn;
    private string $catNameEs;

    //function
    public function getCatNameByLangCode(string $langCode): string {
        $catName = "";        
        switch($langCode) {
            case 'en':
                $catName = $this->catNameEn;
                break;
            case 'es':
                $catName = $this->catNameEs;
                break;
            default: 
                $catName = $this->catNameEn;
                break;    
        }
        return $catName;
    }

    //db
    public function getCatByCatId(int $catId): mysqli_result {
        $sql = "select cat_id as catId, cat_name_en as catNameEn, 
            cat_name_es as catNameEs 
            from cat where cat_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $catId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getAllCat(): mysqli_result {
        $sql = "select cat_id as catId, cat_name_en as catNameEn, 
            cat_name_es as catNameEs 
            from cat;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        //$stmt->bind_param("i", $catId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insert(int $catId, string $catNameEn, 
        string $catNameEs): bool {

        $sql = "insert into cat(cat_name_en, cat_name_es) values (?, ?);";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ss", $catNameEn, $catNameEs);
        return $stmt->execute();
    }

    public function delete(): bool {
        $sql = "delete from cat where cat_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $this->catId);
        return $stmt->execute();
    }

    //constructor
    public function __construct(int $catId, string $catNameEn, 
        string $catNameEs) {

        $this->catId = $catId;
        $this->catNameEn = $catNameEn;
        $this->catNameEs = $catNameEs;
    }

    //factory
    public static function factory() : Cat {
        return new Cat(0, '', '');
    }

    //setter getter
    public function setCatId(int $catId): bool { 
        $this->catId = $catId; 

        $sql = "update cat set cat_id=? where cat_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $catId, $this->catId);
        return $stmt->execute();
    }
    public function getCatId(): int { 
        return $this->catId; 
    }

    public function setCatNameEn(string $catNameEn): bool { 
        $this->catNameEn = $catNameEn; 

        $sql = "update cat set cat_name_en=? where cat_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $catNameEn, $this->catId);
        return $stmt->execute();
    }
    public function getCatNameEn(): string { 
        return $this->catNameEn; 
    }

    public function setCatNameEs(string $catNameEs): bool { 
        $this->catNameEs = $catNameEs; 
    }
    public function getCatNameEs(): string { 
        return $this->catNameEs; 

        $sql = "update cat set cat_name_es=? where cat_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $catNameEs, $this->catId);
        return $stmt->execute();
    }
}
?>
