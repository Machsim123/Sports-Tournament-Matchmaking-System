<?php
include 'db.php';

// Interogare SQL cu subcerere pentru a găsi echipele care au câștigat cel puțin un meci
$query = "SELECT Nume 
          FROM Echipe 
          WHERE ID_echipa IN (
              SELECT DISTINCT Echipa_castigatoare 
              FROM Rezultate
          )";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echipe cu Victorii</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Echipe cu Cel Puțin o Victorie</h2>
</div>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Echipă</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Nume']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $conn->close(); ?>
