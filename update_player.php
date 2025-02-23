<?php
include 'db.php'; // Include conexiunea la baza de date

$message = ""; // Variabilă pentru mesaje de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeActual = $_POST['nume_actual'];
    $numeNou = $_POST['nume_nou'];
    $dataNasteriiNoua = $_POST['data_nasterii_noua'];
    $numeEchipaNou = $_POST['nume_echipa_nou'];

    // Verificăm dacă toate câmpurile sunt completate
    if (!empty($numeActual) && !empty($numeNou) && !empty($dataNasteriiNoua) && !empty($numeEchipaNou)) {
        // Căutăm ID-ul echipei pe baza numelui echipei
        $queryEchipa = "SELECT ID_echipa FROM Echipe WHERE Nume = ?";
        $stmtEchipa = $conn->prepare($queryEchipa);

        if ($stmtEchipa) {
            $stmtEchipa->bind_param("s", $numeEchipaNou);
            $stmtEchipa->execute();
            $result = $stmtEchipa->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $idEchipaNou = $row['ID_echipa'];

                // Actualizăm jucătorul cu ID-ul echipei găsite
                $queryUpdate = "UPDATE Jucatori SET Nume = ?, Data_nasterii = ?, ID_echipa = ? WHERE Nume = ?";
                $stmtUpdate = $conn->prepare($queryUpdate);

                if ($stmtUpdate) {
                    $stmtUpdate->bind_param("ssis", $numeNou, $dataNasteriiNoua, $idEchipaNou, $numeActual);
                    if ($stmtUpdate->execute()) {
                        if ($stmtUpdate->affected_rows > 0) {
                            $message = "Jucătorul '$numeActual' a fost actualizat cu succes!";
                        } else {
                            $message = "Nu s-a găsit niciun jucător cu numele '$numeActual'.";
                        }
                    } else {
                        $message = "Eroare la actualizare: " . $stmtUpdate->error;
                    }
                    $stmtUpdate->close();
                } else {
                    $message = "Eroare la pregătirea interogării de actualizare: " . $conn->error;
                }
            } else {
                $message = "Eroare: Echipa cu numele '$numeEchipaNou' nu există.";
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
    <title>Actualizează Jucător</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Actualizează Jucător</h2>
</div>
<div class="content">
    <?php if ($message): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="update_player.php" class="form">
        <label for="nume_actual">Nume Actual:</label>
        <input type="text" name="nume_actual" id="nume_actual" required>
        <label for="nume_nou">Nume Nou:</label>
        <input type="text" name="nume_nou" id="nume_nou" required>
        <label for="data_nasterii_noua">Data Nașterii Nouă:</label>
        <input type="date" name="data_nasterii_noua" id="data_nasterii_noua" required>
        <label for="nume_echipa_nou">Nume Echipa Nouă:</label>
        <input type="text" name="nume_echipa_nou" id="nume_echipa_nou" required>
        <button type="submit" class="btn">Actualizează Jucător</button>
    </form>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
