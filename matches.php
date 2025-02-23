<?php
include 'db.php';

$dateFilter = isset($_GET['date']) ? $_GET['date'] : ''; // Preluăm data din parametrii GET

$query = "SELECT E1.Nume AS Echipa1, E2.Nume AS Echipa2, M.Data 
          FROM Meciuri M
          JOIN Echipe E1 ON M.ID_echipa1 = E1.ID_echipa
          JOIN Echipe E2 ON M.ID_echipa2 = E2.ID_echipa";

if (!empty($dateFilter)) {
    $query .= " WHERE M.Data = ?";
}

$stmt = $conn->prepare($query);

if (!empty($dateFilter)) {
    $stmt->bind_param("s", $dateFilter);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meciuri după Dată</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Meciuri după Dată</h2>
</div>
<div class="content">
    <!-- Formular pentru selectarea datei -->
    <form method="GET" action="matches.php" class="form">
        <label for="date">Introduceți Data:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($dateFilter); ?>" required>
        <button type="submit" class="btn">Filtrează</button>
    </form>

    <!-- Afișarea tabelului cu meciuri -->
    <table>
        <thead>
            <tr>
                <th>Echipa 1</th>
                <th>Echipa 2</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Echipa1']; ?></td>
                        <td><?php echo $row['Echipa2']; ?></td>
                        <td><?php echo $row['Data']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nu există meciuri pentru data selectată.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>
