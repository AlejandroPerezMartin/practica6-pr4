<?php

include_once './functions.php';

$db = new SQLiteConnection();

echo "<h1>Database setup</h1>";

echo "<h2>Generating database tables...</h2>";

// Enable foreign keys
$db->execute_sql("PRAGMA foreign_keys = ON;");

// Create 'Users' table
$query = <<<_SQL
    ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    USERNAME    VARCHAR(16)     NOT NULL,
    PASSWORD    VARCHAR(32)     NOT NULL,
    NAME        VARCHAR(50)     NOT NULL,
    EMAIL       VARCHAR(50)     NOT NULL,
    ROLE        TINYINT(1)      NOT NULL
_SQL;
// role: administrator = 1, normal user = 0;

$db->create_table("users", $query);

// Create 'Activities' table
$query = <<<_SQL
    ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    NAME            VARCHAR(120)      NOT NULL,
    DESCRIPTION     VARCHAR(4096)     NOT NULL,
    DATE            DATETIME,
    URL             VARCHAR(100)
_SQL;

$db->create_table("activities", $query);

// Create 'Enrollements' table
$query = <<<_SQL
    ACTIVITY_ID INTEGER,
    USER_NAME       VARCHAR(16)     NOT NULL,
    FOREIGN KEY(ACTIVITY_ID) REFERENCES activities(ID) ON DELETE CASCADE
_SQL;

$db->create_table("enrollements", $query);

echo "<h2>Creating <em>'admin'</em> account...</h2>";

if ($db->isAvailableUsername("admin")) {
    $db->execute_sql("INSERT INTO users (USERNAME,PASSWORD,NAME,EMAIL,ROLE) VALUES ('admin','" . md5("admin123") . "','Administrator','admin@admin.com','1')");
}

echo "<h2 style=\"color:green\">Finished setting up database!</h2>";

$db->close();
?>
