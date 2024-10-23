<?php

$dsn = 'mysql:host=db;dbname=baseAtelierPerso1;charset=utf8';
$db_user = 'root';
$db_password = 'exemple';

function createEntry($dsn, $db_user, $db_password, $text) {
    try {
        $dbh = new PDO($dsn, $db_user, $db_password);
        $sql = "INSERT INTO `atelierPerso1` (`text`) VALUES (:text)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(['text' => $text]);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['text'])) {
    createEntry($dsn, $db_user, $db_password, $_POST['text']);
}

echo "<form method='post'>";
echo "<input type='text' name='text'>";
echo "<input type='submit' value='Envoyer'>";
echo "</form>";

function viewTable($dsn, $db_user, $db_password) {
    try {
        $dbh = new PDO($dsn, $db_user, $db_password);
        $sql = "SELECT `text` FROM `atelierPerso1`";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            echo htmlspecialchars($row['text']) . "<br>";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

viewTable($dsn, $db_user, $db_password);
?>
