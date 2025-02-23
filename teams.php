<?php
include 'db.php'; // Include conexiunea la baza de date

// Interogare SQL
$query = "SELECT Nume, Antrenor, Data_fondare FROM Echipe";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Echipe</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Lista Echipe</h2>
</div>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Nume</th>
                <th>Antrenor</th>
                <th>Data Fondare</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Nume']; ?></td>
                    <td><?php echo $row['Antrenor']; ?></td>
                    <td><?php echo $row['Data_fondare']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $conn->close(); ?>
