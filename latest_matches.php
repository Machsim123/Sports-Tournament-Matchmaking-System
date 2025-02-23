<?php
include 'db.php';

// Interogare SQL cu subcerere pentru cel mai recent meci
$query = "SELECT E.Nume AS Echipa, M.Data
          FROM Echipe E
          JOIN Meciuri M ON E.ID_echipa IN (M.ID_echipa1, M.ID_echipa2)
          WHERE M.Data = (
              SELECT MAX(Data) 
              FROM Meciuri 
              WHERE E.ID_echipa IN (M.ID_echipa1, M.ID_echipa2)
          )
          ORDER BY M.Data DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimele Meciuri</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Ultimele Meciuri pentru Fiecare Echipă</h2>
</div>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Echipă</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Echipa']; ?></td>
                    <td><?php echo $row['Data']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $conn->close(); ?>
