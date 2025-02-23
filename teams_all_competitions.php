<?php
include 'db.php';

// Interogare SQL cu subcerere pentru echipe în toate competițiile
$query = "SELECT Nume 
          FROM Echipe E 
          WHERE NOT EXISTS (
              SELECT C.ID_competitie 
              FROM Competitii C
              WHERE NOT EXISTS (
                  SELECT M.ID_meci 
                  FROM Meciuri M
                  WHERE M.ID_competitie = C.ID_competitie 
                  AND (M.ID_echipa1 = E.ID_echipa OR M.ID_echipa2 = E.ID_echipa)
              )
          )";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echipe în Toate Competițiile</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Echipe care au Jucat în Toate Competițiile</h2>
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
