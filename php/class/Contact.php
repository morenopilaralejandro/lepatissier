<?php
require_once __DIR__ . '/../DbConnection.php';
class Contact {
    private int $contactId;
    private string $contactName;
    private string $contactEmail;
    private string $contactMsg;

    //db
    public function getContactByContactId(int $contactId): mysqli_result {
        $sql = "select contact_id as contactId, contact_name as contactName, 
            contact_email as contactEmail, contact_msg as contactMsg
            from contact where contact_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $contactId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getAllContact(): mysqli_result {
        $sql = "select contact_id as contactId, contact_name as contactName, 
            contact_email as contactEmail, contact_msg as contactMsg
            from contact;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        //$stmt->bind_param("i", $contactId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insert(int $contactId, string $contactName, 
        string $contactEmail, string $contactMsg): bool {

        $sql = "insert into contact (contact_name, contact_email, contact_msg) 
            values (?, ?, ?);";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("sss", $contactName, $contactEmail, $contactMsg);
        return $stmt->execute();
    }

    public function delete(): bool {
        $sql = "delete from contact where contact_id=?;";

        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $this->contactId);
        return $stmt->execute();
    }

    //constructor
    public function __construct(int $contactId, string $contactName, 
        string $contactEmail, string $contactMsg) {

        $this->contactId = $contactId;
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->contactMsg = $contactMsg;
    }

    //factory
    public static function factory() : Contact {
        return new Contact(0, '', '', '');
    }

    //setter getter
    public function setContactId(int $contactId): bool { 
        $this->contactId = $contactId; 

        $sql = "update contact set contact_id=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $contactId, $this->contactId);
        return $stmt->execute();
    }
    public function getContactId(): int { 
        return $this->contactId; 
    }

    public function setContactName($contactName) { 
        $this->contactName = $contactName; 

        $sql = "update contact set contact_name=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactName, $this->contactId);
        return $stmt->execute();
    }
    public function getContactName() { 
        return $this->contactName; 
    }

    public function setContactEmail($contactEmail) { 
        $this->contactEmail = $contactEmail; 

        $sql = "update contact set contact_email=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactEmail, $this->contactId);
        return $stmt->execute();
    }
    public function getContactEmail() { 
        return $this->contactEmail; 
    }

    public function setContactMsg($contactMsg) { 
        $this->contactMsg = $contactMsg; 

        $sql = "update contact set contact_msg=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactMsg, $this->contactId);
        return $stmt->execute();
    }
    public function getContactMsg() { 
        return $this->contactMsg; 
    }
}
?>
