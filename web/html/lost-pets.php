<?php
include "includes/header.php";
?>

<?php
require_once "includes/database.php";

/**
 * @var $db mysqli
 */

$id = $_GET['lostID'] ?? ' ';
$id = intval($id);

$query = "SELECT * FROM lost_pets WHERE lostID = '$id'";
$result = mysqli_query($db, $query);
if (!$result) {
    die("Error loading lost pet details: " . mysqli_error($db));
}
$lost = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<body>

<div class="wrapper">
    <main>
        <h1 class="adopt-pet">Lost Pet Dashboard</h1>

        <?php
        $query = "SELECT lostID, Name, Description, DATE_FORMAT(last_seen, '%M %D %Y') as last_seen, Status, contact
              FROM lost_pets";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die("Error loading lost pets list: " . mysqli_error($db));
        }
        ?>

        <table class="lostList">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Last Seen</th>
                <th>Status</th>
                <th>Contact Us</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['last_seen']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Status']) . '</td>';
                echo '<td>' . htmlspecialchars($row['contact']) . '</td>';
                echo '<td><a href="edit-lost-pets.php?lostID=' . htmlspecialchars($row['lostID']) . '">Edit</a></td>';
                echo '<td><a href="delete-lost-pets.php?lostID=' . htmlspecialchars($row['lostID']) . '">Delete</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

        <a href="report-pets.php?lostID=<?= $id ?>" class="report-lost-btn">Report Lost Pet</a>

    </main>
</div>

</body>
</html>

<?php
mysqli_close($db);
?>
