<?php
require_once __DIR__ . '/../DbConnection.php';
class Alle {
    private int $alleId;
    private string $alleNameEn;
    private string $alleNameEs;

    //db
    public function getAlleByProdId(int $prodId): mysqli_result {
        $sql = "select a.alle_id as alleId, a.alle_name_en as alleNameEn, 
            a.alle_name_es as alleNameEs
            from alle a join prodalle pa on pa.alle_id=a.alle_id 
            where pa.prod_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $prodId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insert(int $alleId, string $alleNameEn, 
        string $alleNameEs): bool {

        $sql = "insert into alle(alle_name_en, alle_name_es) values (?, ?);";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ss", $alleNameEn, $alleNameEs);
        return $stmt->execute();
    }

    public function delete(): bool {
        $sql = "delete from alle where alle_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $this->alleId);
        return $stmt->execute();
    }

    //constructor
    public function __construct(int $alleId, string $alleNameEn, 
        string $alleNameEs) {

        $this->alleId = $alleId;
        $this->alleNameEn = $alleNameEn;
        $this->alleNameEs = $alleNameEs;
    }

    //factory
    public static function factory() : Alle {
        return new Alle(0, '', '');
    }

    //setter getter
    public function setAlleId(int $alleId): bool {
        $this->alleId = $alleId; 

        $sql = "update alle set alle_id=? where alle_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $alleId, $this->alleId);
        return $stmt->execute();
    }
    public function getAlleId(): int {
        return $this->alleId; 
    }

    public function setAlleNameEn(string $alleNameEn): void {
        $this->alleNameEn = $alleNameEn; 

        $sql = "update alle set alle_name_en=? where alle_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $alleNameEn, $this->alleId);
        return $stmt->execute();
    }
    public function getAlleNameEn(): string {
        return $this->alleNameEn; 
    }

    public function setAlleNameEs(string $alleNameEs): void {
        $this->alleNameEs = $alleNameEs; 

        $sql = "update alle set alle_name_es=? where alle_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $alleNameEs, $this->alleId);
        return $stmt->execute();
    }
    public function getAlleNameEs(): string {
        return $this->alleNameEs; 
    }
}
?>
