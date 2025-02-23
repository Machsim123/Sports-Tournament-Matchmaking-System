<?php
include 'db.php';

$query = "SELECT L.Nume AS Locatie, C.Nume AS Competitie
          FROM competitii_locatii CL
          JOIN Locatii L ON CL.ID_locatie = L.ID_locatie
          JOIN Competitii C ON CL.ID_competitie = C.ID_competitie";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locații și Competiții</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Locații și Competiții</h2>
</div>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Locație</th>
                <th>Competiție</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Locatie']; ?></td>
                    <td><?php echo $row['Competitie']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $conn->close(); ?>
