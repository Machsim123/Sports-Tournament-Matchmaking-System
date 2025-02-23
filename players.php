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

// Obținem toți jucătorii din baza de date
$queryPlayers = "SELECT J.Nume AS NumeJucator, J.Data_nasterii, E.Nume AS NumeEchipa
                 FROM Jucatori J
                 JOIN Echipe E ON J.ID_echipa = E.ID_echipa";
$resultPlayers = $conn->query($queryPlayers);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jucători</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Jucători</h2>
</div>
<div class="content">
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Bun venit, <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p><a href="index.php?logout='1'" style="color: red;">Deconectare</a></p>
    <?php endif ?>

    <!-- Tabelul cu jucători -->
    <h3>Lista Jucători</h3>
    <table>
        <thead>
            <tr>
                <th>Nume</th>
                <th>Data Nașterii</th>
                <th>Echipa</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultPlayers->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['NumeJucator']; ?></td>
                    <td><?php echo $row['Data_nasterii']; ?></td>
                    <td><?php echo $row['NumeEchipa']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Butoane CRUD pentru jucători -->
    <div class="navigation">
        <h3>Funcționalități pentru Jucători</h3>
        <a href="insert_player.php" class="btn">Adaugă Jucător</a>
        <a href="update_player.php" class="btn">Actualizează Jucător</a>
        <a href="delete_player.php" class="btn">Șterge Jucător</a>
    </div>

    <!-- Buton pentru a reveni la echipe -->
    <div>
        <a href="index.php" class="btn">Înapoi la Echipe</a>
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
