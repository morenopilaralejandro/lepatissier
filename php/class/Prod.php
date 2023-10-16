<?php
require_once __DIR__ . '/../DbConnection.php';
class Prod {
    private int $prodId;
    private string $prodNameEn;
    private string $prodNameEs;
    private string $prodDescEn;
    private string $prodDescEs;
    private float $prodPrice;
    private int $catId;

    //function
    public function getProdNameByLangCode(string $langCode): string {
        $prodName = "";        
        switch($langCode) {
            case 'en':
                $prodName = $this->prodNameEn;
                break;
            case 'es':
                $prodName = $this->prodNameEs;
                break;
            default: 
                $prodName = $this->prodNameEn;
                break;    
        }
        return $prodName;
    }

    public function getProdDescByLangCode(string $langCode): string {
        $prodDesc = "";        
        switch($langCode) {
            case 'en':
                $prodDesc = $this->prodDescEn;
                break;
            case 'es':
                $prodDesc = $this->prodDescEs;
                break;
            default: 
                $prodDesc = $this->prodDescEn;
                break;    
        }
        return $prodDesc;
    }

    //db
    public function getProdByProdId(int $prodId): mysqli_result {
        $sql = "select prod_id as prodId, prod_name_en as prodNameEn, 
            prod_name_es as prodNameEs, prod_desc_en as prodDescEn, 
            prod_desc_es as prodDescEs, prod_price as prodPrice, cat_id as catId 
            from prod where prod_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $ProdId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getProdByCatId(int $catId): mysqli_result {
        $sql = "select prod_id as prodId, prod_name_en as prodNameEn, 
            prod_name_es as prodNameEs, prod_desc_en as prodDescEn, 
            prod_desc_es as prodDescEs, prod_price as prodPrice, cat_id as catId 
            from prod where cat_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $catId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insert(int $prodId, string $prodNameEn, string $prodNameEs, 
        string $prodDescEn, string $prodDescEs, float $prodPrice, 
        int $catId): bool {

        $sql = "insert into prod (prod_name_en, prod_name_es, prod_desc_en, 
            prod_desc_es, prod_price, cat_id) 
            values (?, ?, ?, ?, ?, ?);";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ssssfi", $prodNameEn, $prodNameEs, $prodDescEn, 
            $prodDescEs, $prodPrice, $catId);
        return $stmt->execute();
    }

    public function delete(): bool {
        $sql = "delete from prod where prod_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $this->prodId);
        return $stmt->execute();
    }

    //constructor
    public function __construct(int $prodId, string $prodNameEn, string $prodNameEs, 
        string $prodDescEn, string $prodDescEs, float $prodPrice, 
        int $catId) {

        $this->prodId = $prodId;
        $this->prodNameEn = $prodNameEn;
        $this->prodNameEs = $prodNameEs;
        $this->prodDescEn = $prodDescEn;
        $this->prodDescEs = $prodDescEs;
        $this->prodPrice = $prodPrice;
        $this->catId = $catId;
    }

    //factory
    public static function factory() : Prod {
        return new Prod(0, '', '', '', '', 0.0, 0);
    }

    //setter getter
    public function setProdId(int $prodId): bool { 
        $this->prodId = $prodId; 

        $sql = "update prod set prod_id=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $prodId, $this->prodId);
        return $stmt->execute();
    }
    public function getProdId(): int { 
        return $this->prodId; 
    }

    public function setProdNameEn(string $prodNameEn): bool { 
        $this->prodNameEn = $prodNameEn; 

        $sql = "update prod set prod_name_en=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $prodNameEn, $this->prodId);
        return $stmt->execute();
    }
    public function getProdNameEn(): string { 
        return $this->prodNameEn; 
    }

    public function setProdNameEs(string $prodNameEs): bool { 
        $this->prodNameEs = $prodNameEs; 

        $sql = "update prod set prod_name_es=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $prodNameEs, $this->prodId);
        return $stmt->execute();
    }
    public function getProdNameEs(): string { 
        return $this->prodNameEs; 
    }

    public function setProdDescEn(string $prodDescEn): bool { 
        $this->prodDescEn = $prodDescEn; 

        $sql = "update prod set prod_desc_en=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $prodDescEn, $this->prodId);
        return $stmt->execute();
    }
    public function getProdDescEn(): string { 
        return $this->prodDescEn; 
    }

    public function setProdDescEs(string $prodDescEs): bool { 
        $this->prodDescEs = $prodDescEs; 

        $sql = "update prod set prod_desc_es=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $prodDescEs, $this->prodId);
        return $stmt->execute();
    }
    public function getProdDescEs(): string {
        return $this->prodDescEs; 
    }

    public function setProdPrice(float $prodPrice): bool { 
        $this->prodPrice = $prodPrice; 

        $sql = "update prod set prod_price=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("fi", $prodPrice, $this->prodId);
        return $stmt->execute();
    }
    public function getProdPrice(): float { 
        return $this->prodPrice; 
    }

    public function setCatId(int $catId): bool { 
        $this->catId = $catId; 

        $this->prodPrice = $prodPrice; 

        $sql = "update prod set cat_id=? where prod_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $catId, $this->prodId);
        return $stmt->execute();
    }
    public function getCatId(): int { 
        return $this->catId; 
    }
}
?>
