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

function viewTable($dsn, $db_user, $db_password) {
    try {
        $dbh = new PDO($dsn, $db_user, $db_password);
        $sql = "SELECT `text` FROM `atelierPerso1`";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results; // Retourne les résultats pour les afficher plus tard
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}

$entries = viewTable($dsn, $db_user, $db_password);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Atelier Personnel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .entries {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .entry {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .entry:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<h1>Bienvenue dans Mon Atelier Personnel</h1>

<form method="post">
    <input type="text" name="text" placeholder="Écrivez votre texte ici..." required>
    <input type="submit" value="Envoyer">
</form>

<div class="entries">
    <h2>Entrées précédentes :</h2>
    <?php if ($entries): ?>
        <?php foreach ($entries as $row): ?>
            <div class="entry"><?php echo htmlspecialchars($row['text']); ?></div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune entrée trouvée.</p>
    <?php endif; ?>
</div>

</body>
</html>
