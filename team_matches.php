<?php
include 'db.php'; // Include conexiunea la baza de date

// Interogare pentru numărul total de meciuri pentru fiecare echipă
$query = "SELECT E.Nume AS Echipa, 
                 COUNT(CASE WHEN M.ID_echipa1 = E.ID_echipa THEN 1 END) +
                 COUNT(CASE WHEN M.ID_echipa2 = E.ID_echipa THEN 1 END) AS Total_Meciuri
          FROM Echipe E
          LEFT JOIN Meciuri M ON E.ID_echipa IN (M.ID_echipa1, M.ID_echipa2)
          GROUP BY E.ID_echipa
          ORDER BY Total_Meciuri DESC";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numărul Total de Meciuri per Echipă</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Numărul Total de Meciuri per Echipă</h2>
</div>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Echipă</th>
                <th>Total Meciuri</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Echipa']; ?></td>
                    <td><?php echo $row['Total_Meciuri']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php $conn->close(); ?>
