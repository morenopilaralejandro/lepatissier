<?php
require_once __DIR__ . '/../DbConnection.php';
class Contact {
    private int $contactId;
    private string $contactName;
    private string $contactEmail;
    private string $contactMsg;
    private string $contactDate;

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
        string $contactEmail, string $contactMsg, string $contactDate): bool {

        $sql = "insert into contact (contact_name, contact_email, contact_msg) 
            values (?, ?, ?, now());";

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
        string $contactEmail, string $contactMsg, string $contactDate) {

        $this->contactId = $contactId;
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
        $this->contactMsg = $contactMsg;
        $this->contactDate = $contactDate;
    }

    //factory
    public static function factory() : Contact {
        return new Contact(0, '', '', '', '');
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

    public function setContactName(string $contactName): bool { 
        $this->contactName = $contactName; 

        $sql = "update contact set contact_name=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactName, $this->contactId);
        return $stmt->execute();
    }
    public function getContactName(): string { 
        return $this->contactName; 
    }

    public function setContactEmail(string $contactEmail): bool { 
        $this->contactEmail = $contactEmail; 

        $sql = "update contact set contact_email=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactEmail, $this->contactId);
        return $stmt->execute();
    }
    public function getContactEmail(): string { 
        return $this->contactEmail; 
    }

    public function setContactMsg(string $contactMsg): bool { 
        $this->contactMsg = $contactMsg; 

        $sql = "update contact set contact_msg=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactMsg, $this->contactId);
        return $stmt->execute();
    }
    public function getContactMsg(): string { 
        return $this->contactMsg; 
    }

    public function setContactDate(string $contactDate): bool { 
        $this->contactDate = $contactDate; 

        $sql = "update contact set contact_date=? where contact_id=?;";
        $con = new DbConnection();
        $link = $con->getConnection();

        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $contactDate, $this->contactId);
        return $stmt->execute();
    }
    public function getContactDate(): string { 
        return $this->contactDate; 
    }
}
?>
