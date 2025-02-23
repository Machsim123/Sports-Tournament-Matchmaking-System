<?php
include 'db.php'; // Include conexiunea la baza de date

// Interogare pentru echipa cu cele mai multe victorii
$query = "SELECT E.Nume AS Echipa, COUNT(R.ID_rezultat) AS Victorii
          FROM Rezultate R
          JOIN Echipe E ON R.Echipa_castigatoare = E.ID_echipa
          GROUP BY R.Echipa_castigatoare
          ORDER BY Victorii DESC
          LIMIT 1";
$result = $conn->query($query);

$topTeam = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echipa cu Cele Mai Multe Victorii</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Echipa cu Cele Mai Multe Victorii</h2>
</div>
<div class="content">
    <?php if ($topTeam): ?>
        <p>Echipa cu cele mai multe victorii este <strong><?php echo $topTeam['Echipa']; ?></strong> cu 
        <strong><?php echo $topTeam['Victorii']; ?></strong> victorii.</p>
    <?php else: ?>
        <p>Nu există date despre victorii în baza de date.</p>
    <?php endif; ?>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $conn->close(); ?>
