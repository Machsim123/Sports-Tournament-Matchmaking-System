<?php
include 'db.php'; // Conexiunea la baza de date

$message = ""; // Variabilă pentru mesaje de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preluăm datele din formular
    $numeActual = $_POST['nume_actual'];
    $numeNou = $_POST['nume_nou'];
    $antrenorNou = $_POST['antrenor_nou'];

    // Verificăm dacă numele actual nu este gol
    if (!empty($numeActual)) {
        // Pregătim interogarea SQL pentru actualizare
        $query = "UPDATE Echipe SET Nume = ?, Antrenor = ? WHERE Nume = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sss", $numeNou, $antrenorNou, $numeActual);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $message = "Actualizare reușită pentru echipa cu numele '$numeActual'!";
                } else {
                    $message = "Nu s-a găsit nicio echipă cu numele '$numeActual'.";
                }
            } else {
                $message = "Eroare la actualizare: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Eroare la pregătirea interogării: " . $conn->error;
        }
    } else {
        $message = "Numele actual al echipei trebuie completat!";
    }

    $conn->close(); // Închidem conexiunea la baza de date
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizează Echipa</title>
    <link rel="stylesheet" href="stil.css"> <!-- Stilurile aplicației -->
</head>
<body>
<div class="header">
    <h2>Actualizează Detaliile Echipei</h2>
</div>
<div class="content">
    <?php if ($message): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="update.php" class="form">
        <label for="nume_actual">Nume Actual:</label>
        <input type="text" name="nume_actual" id="nume_actual" required>
        <label for="nume_nou">Nume Nou:</label>
        <input type="text" name="nume_nou" id="nume_nou" required>
        <label for="antrenor_nou">Antrenor Nou:</label>
        <input type="text" name="antrenor_nou" id="antrenor_nou" required>
        <button type="submit" class="btn">Actualizează Echipa</button>
    </form>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
