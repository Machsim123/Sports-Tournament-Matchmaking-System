<?php
include 'db.php'; // Include conexiunea la baza de date

$message = ""; // Variabilă pentru mesaje de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeJucator = $_POST['nume_jucator'];

    // Verificăm dacă numele nu este gol
    if (!empty($numeJucator)) {
        $query = "DELETE FROM Jucatori WHERE Nume = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $numeJucator);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $message = "Jucătorul '$numeJucator' a fost șters cu succes!";
                } else {
                    $message = "Nu s-a găsit niciun jucător cu numele '$numeJucator'.";
                }
            } else {
                $message = "Eroare la ștergere: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Eroare la pregătirea interogării: " . $conn->error;
        }
    } else {
        $message = "Numele jucătorului nu poate fi gol!";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Șterge Jucător</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Șterge Jucător</h2>
</div>
<div class="content">
    <?php if ($message): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="delete_player.php" class="form">
        <label for="nume_jucator">Nume Jucător:</label>
        <input type="text" name="nume_jucator" id="nume_jucator" required>
        <button type="submit" class="btn">Șterge Jucător</button>
    </form>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
