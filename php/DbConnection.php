<?php
require_once('DbCredentials.php');
class DbConnection {
    private mysqli $link;

    public function getConnection(): mysqli {
        $cred = new DbCredentials(true);
        $dbHost = $cred->getDbHost();
        $dbName = $cred->getDbName();
        $dbUser = $cred->getDbUser();
        $dbPass = $cred->getDbPass();
        $this->link = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if ($this->link->connect_errno) {
            echo $mysqli->connect_error;
        }
        return $this->link;
    }
}
?>
