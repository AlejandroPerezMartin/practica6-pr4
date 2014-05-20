<?php

class SQLiteConnection
{

    protected $db = null;

    public function __construct()
    {
        try {
            $this->db = new PDO("sqlite:database.sqlite");
            return $this->db;
        } catch (PDOException $e) {
            print "<p class=\"error\">Couldn\'t connect to database.</p>";
            exit();
        }
    }

    public function create_table($name, $query)
    {
        $this->execute_sql("CREATE TABLE IF NOT EXISTS $name($query)");
    }

    public function query_sql($query)
    {
        $result = $this->db->query($query);
        if (!$result) {
            $this->showQueryError();
        } else {
            return $result;
        }
    }

    public function execute_sql($query)
    {
        $result = $this->db->prepare($query);
        if (!$result) {
            $this->showQueryError();
            return false;
        } else {
            $result->execute();
            return $result;
        }
    }

    public function isAvailableUsername($username)
    {
        return !$this->execute_sql("SELECT * FROM users WHERE USERNAME='" . strtolower($username) . "'")->fetch();
    }

    public function isUserRegistered($username, $password)
    {
        return $this->execute_sql("SELECT USERNAME,PASSWORD FROM users WHERE USERNAME='" . strtolower($username) . "' AND PASSWORD='" . md5($password) . "'")->fetch();
    }

    public function getUserRole($username)
    {
        return ($this->execute_sql("SELECT ROLE FROM users WHERE USERNAME='" . strtolower($username) . "'")->fetchColumn());
    }

    public function close()
    {
        $this->db = null;
    }

    private function showQueryError()
    {
        print "<p class=\"error\">Error processing query.</p>";
    }

}

function destroySession()
{
    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 2592000, '/');
    }

    session_destroy();
}

?>
