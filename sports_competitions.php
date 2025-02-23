<?php
include 'db.php'; // Include conexiunea la baza de date

// Interogare pentru sporturi și competițiile aferente
$query = "SELECT S.Nume AS Sport, C.Nume AS Competitie
          FROM competitii_sporturi CS
          JOIN Sporturi S ON CS.ID_sport = S.ID_sport
          JOIN Competitii C ON CS.ID_competitie = C.ID_competitie
          ORDER BY S.Nume, C.Nume";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sporturi și Competiții</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Sporturi și Competiții</h2>
</div>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Sport</th>
                <th>Competiție</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Sport']; ?></td>
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
