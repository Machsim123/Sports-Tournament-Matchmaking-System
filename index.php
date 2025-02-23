<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

include 'db.php'; // Include conexiunea la baza de date

// Obținem toate echipele din baza de date
$queryTeams = "SELECT * FROM Echipe";
$resultTeams = $conn->query($queryTeams);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pagina Principală</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Echipe</h2>
</div>
<div class="content">
    <?php if (isset($_SESSION['username'])) : ?>
        <p style="text-align: center;">Bun venit, <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p style="text-align: center;"><a href="index.php?logout='1'" class="logout">Deconectare</a></p>
    <?php endif ?>

    <!-- Tabelul cu echipe -->
    <h3>Lista Echipe</h3>
    <table>
        <thead>
            <tr>
                <th>Nume</th>
                <th>Data Fondare</th>
                <th>Antrenor</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultTeams->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Nume']; ?></td>
                    <td><?php echo $row['Data_fondare']; ?></td>
                    <td><?php echo $row['Antrenor']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Butoane CRUD pentru echipe -->
    <div class="navigation">
        <h3>Funcționalități pentru Echipe</h3>
        <a href="insert.php" class="btn">Adaugă Echipă</a>
        <a href="update.php" class="btn">Actualizează Echipă</a>
        <a href="delete.php" class="btn">Șterge Echipă</a>
    </div>

    <!-- Buton către pagina de jucători -->
    <div>
        <a href="players.php" class="btn">Vezi Jucători</a>
    </div>

    <!-- Interogări SQL -->
    <div class="queries">
        <h3>Interogări SQL</h3>
        <a href="teams.php" class="btn">Lista Echipe</a>
        <a href="matches.php" class="btn">Meciuri din Competiție</a>
        <a href="top_team.php" class="btn">Echipa cu Cele Mai Multe Victorii</a>
        <a href="sports_competitions.php" class="btn">Sporturi și Competiții</a>
        <a href="team_matches.php" class="btn">Meciuri per Echipă</a>
        <a href="locations.php" class="btn">Locații și Competiții</a>
        <a href="winning_teams.php" class="btn">Echipe cu Victorii</a>
        <a href="latest_matches.php" class="btn">Ultimele Meciuri</a>
        <a href="teams_all_competitions.php" class="btn">Echipe în Toate Competițiile</a>
        <a href="popular_location.php" class="btn">Locația Cel Mai Des Utilizată</a>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>