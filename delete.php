<?php
include 'db.php'; // Include conexiunea la baza de date

$message = ""; // Variabilă pentru mesaje de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preluăm numele echipei din formular
    $numeEchipa = $_POST['nume_echipa'];

    // Verificăm dacă numele nu este gol
    if (!empty($numeEchipa)) {
        // Pregătim interogarea SQL pentru ștergere
        $query = "DELETE FROM Echipe WHERE Nume = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $numeEchipa);
            if ($stmt->execute()) {
                // Verificăm dacă s-a șters o înregistrare
                if ($stmt->affected_rows > 0) {
                    $message = "Ștergere reușită pentru echipa cu numele '$numeEchipa'!";
                } else {
                    $message = "Eroare: Nu există o echipă cu numele '$numeEchipa'.";
                }
            } else {
                $message = "Eroare la ștergere: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Eroare la pregătirea interogării: " . $conn->error;
        }
    } else {
        $message = "Numele echipei nu poate fi gol!";
    }

    $conn->close(); // Închidem conexiunea la baza de date
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Șterge Echipa</title>
    <link rel="stylesheet" href="stil.css"> <!-- Stilurile aplicației -->
</head>
<body>
<div class="header">
    <h2>Șterge Echipa</h2>
</div>
<div class="content">
    <?php if ($message): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="delete.php" class="form">
        <label for="nume_echipa">Nume Echipa:</label>
        <input type="text" name="nume_echipa" id="nume_echipa" required>
        <button type="submit" class="btn">Șterge Echipa</button>
    </form>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
