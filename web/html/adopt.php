<?php
include "includes/header.php";
?>

<div class="wrapper">

    <main>

        <div class="adopt-content">
            <h2 class="adopt-pet">Pets for Adoption</h2>
            <p>Please select pet name to view more information!</p>
        </div>

        <?php
        require_once "includes/database.php";

        $sort = $_GET['sort'] ?? 'Name';
        $start = $_GET['start'] ?? 0;
        $per_page = 5;

        // Sanitize inputs to prevent SQL injection
        $sort = in_array($sort, ['Name', 'Sex', 'Description', 'Birthday', 'Donation_Fee', 'Status']) ? $sort : 'Name';
        $safe_start = mysqli_real_escape_string($db, $start);
        $safe_per_page = mysqli_real_escape_string($db, $per_page);
        $safe_sort = mysqli_real_escape_string($db, $sort);

        // Build the query
        $query = "SELECT adopt_pets.petID, Name, Sex, Description, DATE_FORMAT(Birthday, '%M %D %Y') AS Birthday, Donation_Fee, Status
                  FROM adopt_pets
                  ORDER BY $safe_sort";

        // Execute the query
        $result = (@mysqli_query($db, $query)) or die('You have an error in query');

        // Get total rows for pagination
        $total_rows = mysqli_num_rows($result);

        // Add LIMIT for pagination
        $query .= " LIMIT $safe_start, $safe_per_page";
        $result = (@mysqli_query($db, $query)) or die('You have an error in query');
        ?>

        <table class="adopt-list">
            <thead>
            <th><a href="?sort=Name">Pet Name</a></th>
            <th><a href="?sort=Sex">Sex</a></th>
            <th><a href="?sort=Description">Description</a></th>
            <th><a href="?sort=Birthday">Birthday</a></th>
            <th><a href="?sort=Donation_Fee">Donation Fee</a></th>
            <th><a href="?sort=Status">Status</a></th>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>';
                echo '<td><a href="pet-info.php?petID='.htmlspecialchars($row['petID']).'">'.htmlspecialchars($row['Name']).'</a></td>';
                echo '<td>'.htmlspecialchars($row['Sex']).'</td>';
                echo '<td>'.htmlspecialchars($row['Description']).'</td>';
                echo '<td>'.htmlspecialchars($row['Birthday']).'</td>';
                echo '<td>'.htmlspecialchars($row['Donation_Fee']).'</td>';
                echo '<td>'.htmlspecialchars($row['Status']).'</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

        <nav aria-label="Pet pagination">
            <ul class="pagination">
                <li class="page-item <?= $safe_start == 0 ? 'disabled' : ''?>">
                    <a class="page-link" href="?start=<?= $safe_start - $safe_per_page ?>">Previous</a>
                </li>

                <?php
                for($i = 0; $i < $total_rows; $i .= $safe_per_page) {
                    $page_number = ceil(($i + 1) / $safe_per_page);
                    ?>
                    <li class="page-item <?= $i == $safe_start ? 'active' : ''?>">
                        <a class="page-link" href="?start=<?= $i ?>"><?= $page_number ?></a>
                    </li>
                <?php } ?>

                <li class="page-item <?= $total_rows < $safe_start . $safe_per_page ? 'disabled' : ''?>">
                    <a class="page-link" href="?start=<?= $safe_start . $safe_per_page ?>">Next</a>
                </li>
            </ul>
        </nav>

        <h2 class="adopt-pet">Pet Gallery</h2>

        <div class="pet-images">
            <div><img src="images/dachshund.jpg" alt="Bella Dachshund">
                <h3>Bella</h3></div>
            <div><img src="images/german-shepard.jpeg" alt="Bailey German Shepherd">
                <h3>Bailey</h3></div>
            <div><img src="images/Samoyed.jpeg" alt="Buddy Samoyed">
                <h3>Buddy</h3></div>
            <div><img src="images/Bulldog.jpg" alt="Chloe Bulldog">
                <h3>Chloe</h3></div>
            <div><img src="images/Shiba%20Inu.jpg" alt="Honey Shiba Inu">
                <h3>Honey</h3></div>
            <div><img src="images/Poodle.jpg" alt="Max Poodle">
                <h3>Max</h3></div>
        </div>

    </main>

    <?php
    mysqli_close($db);
    ?>

</div><!-- closing tag for wrapper -->

<?php
include "includes/footer.php";
?>

</body>
</html>
