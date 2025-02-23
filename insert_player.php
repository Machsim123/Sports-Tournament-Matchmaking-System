<?php
include 'db.php'; // Include conexiunea la baza de date

$message = ""; // Variabilă pentru mesaje de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'];
    $dataNasterii = $_POST['data_nasterii'];
    $numeEchipa = $_POST['nume_echipa'];

    // Verificăm dacă toate câmpurile sunt completate
    if (!empty($nume) && !empty($dataNasterii) && !empty($numeEchipa)) {
        // Căutăm ID-ul echipei pe baza numelui echipei
        $queryEchipa = "SELECT ID_echipa FROM Echipe WHERE Nume = ?";
        $stmtEchipa = $conn->prepare($queryEchipa);
        if ($stmtEchipa) {
            $stmtEchipa->bind_param("s", $numeEchipa);
            $stmtEchipa->execute();
            $result = $stmtEchipa->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $idEchipa = $row['ID_echipa'];

                // Inserăm jucătorul cu ID-ul echipei găsite
                $queryInsert = "INSERT INTO Jucatori (Nume, Data_nasterii, ID_echipa) VALUES (?, ?, ?)";
                $stmtInsert = $conn->prepare($queryInsert);

                if ($stmtInsert) {
                    $stmtInsert->bind_param("ssi", $nume, $dataNasterii, $idEchipa);
                    if ($stmtInsert->execute()) {
                        $message = "Jucătorul '$nume' a fost adăugat cu succes în echipa '$numeEchipa'!";
                    } else {
                        $message = "Eroare la inserare: " . $stmtInsert->error;
                    }
                    $stmtInsert->close();
                } else {
                    $message = "Eroare la pregătirea interogării de inserare: " . $conn->error;
                }
            } else {
                $message = "Eroare: Echipa cu numele '$numeEchipa' nu există.";
            }
            $stmtEchipa->close();
        } else {
            $message = "Eroare la pregătirea interogării pentru căutarea echipei: " . $conn->error;
        }
    } else {
        $message = "Toate câmpurile trebuie completate corect!";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Jucător</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Adaugă Jucător</h2>
</div>
<div class="content">
    <?php if ($message): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="insert_player.php" class="form">
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required>
        <label for="data_nasterii">Data Nașterii:</label>
        <input type="date" name="data_nasterii" id="data_nasterii" required>
        <label for="nume_echipa">Nume Echipa:</label>
        <input type="text" name="nume_echipa" id="nume_echipa" required>
        <button type="submit" class="btn">Adaugă Jucător</button>
    </form>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
