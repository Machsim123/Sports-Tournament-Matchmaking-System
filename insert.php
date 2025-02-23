<?php
include 'db.php'; // Include conexiunea la baza de date

// Verificăm dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preluăm datele din formular
    $nume = $_POST['nume'];
    $dataFondare = $_POST['data_fondare'];
    $antrenor = $_POST['antrenor'];

    // Interogare SQL pentru inserare
    $query = "INSERT INTO Echipe (Nume, Data_fondare, Antrenor) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nume, $dataFondare, $antrenor);

    // Executăm interogarea și oferim feedback
    if ($stmt->execute()) {
        $message = "Inserare reușită!";
    } else {
        $message = "Eroare la inserare: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Echipa</title>
    <link rel="stylesheet" href="stil.css"> <!-- Stilurile tale -->
</head>
<body>
<div class="header">
    <h2>Adaugă o echipă nouă</h2>
</div>
<div class="content">
    <?php if (isset($message)): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" action="insert.php" class="form">
        <div class="input-group">
            <label for="nume">Nume Echipa:</label>
            <input type="text" name="nume" id="nume" required>
        </div>
        <div class="input-group">
            <label for="data_fondare">Data Fondare:</label>
            <input type="date" name="data_fondare" id="data_fondare" required>
        </div>
        <div class="input-group">
            <label for="antrenor">Antrenor:</label>
            <input type="text" name="antrenor" id="antrenor" required>
        </div>
        <div class="input-group">
            <button type="submit" class="btn">Adaugă Echipa</button>
        </div>
    </form>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
