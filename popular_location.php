<?php
include 'db.php';

// Preluăm locația introdusă de utilizator
$locationFilter = isset($_GET['location']) ? $_GET['location'] : '';

// Preluăm lista locațiilor pentru dropdown
$queryLocations = "SELECT DISTINCT L.Nume AS Locatie FROM Locatii L";
$locations = $conn->query($queryLocations);

// Pregătim interogarea pentru numărul de meciuri pentru locația selectată utilizând o subcerere
$result = null;
if (!empty($locationFilter)) {
    $query = "SELECT L.Nume AS Locatie, 
                     (SELECT COUNT(*) 
                      FROM Meciuri M 
                      WHERE M.ID_locatie = L.ID_locatie) AS Nr_Meciuri
              FROM Locatii L
              WHERE L.Nume = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $locationFilter);
    $stmt->execute();
    $result = $stmt->get_result();
    $locationData = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meciuri pe Locație</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body>
<div class="header">
    <h2>Meciuri pe Locație</h2>
</div>
<div class="content">
    <!-- Formular pentru selectarea locației -->
    <form method="GET" action="popular_location.php" class="form">
        <label for="location">Selectează Locația:</label>
        <select name="location" id="location" required>
            <option value="">-- Alege Locația --</option>
            <?php while ($location = $locations->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($location['Locatie']); ?>" 
                    <?php echo ($locationFilter === $location['Locatie']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($location['Locatie']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" class="btn">Filtrează</button>
    </form>

    <?php if (!empty($locationFilter)): ?>
        <?php if ($locationData): ?>
            <p>Locația <strong><?php echo htmlspecialchars($locationData['Locatie']); ?></strong> a fost utilizată pentru 
            <strong><?php echo $locationData['Nr_Meciuri']; ?></strong> meciuri.</p>
        <?php else: ?>
            <p>Nu există meciuri înregistrate pentru locația selectată.</p>
        <?php endif; ?>
    <?php endif; ?>

    <p><a href="index.php" class="btn">Înapoi la pagina principală</a></p>
</div>
</body>
</html>
<?php
if (isset($stmt) && $stmt) {
    $stmt->close();
}
$conn->close();
?>
