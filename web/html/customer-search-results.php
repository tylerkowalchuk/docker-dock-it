<?php
$pageTitle = "Perfu.ME - Customer Search";

require_once 'includes/database.php';
?>

<div class="container-md" id="customerResults">

    <?php
// get sort parameters
$sort = $_GET['sort'] ?? 'LastName';

$dir = $_GET['dir'] ?? 'ASC';

// sanitize/validate
// TODO SORT $dir = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC';
$dir = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC';
?>

<?php
//get the search term
$search = $_GET['search'] ?? '';
$search = "%$search%";

// build query, test in phpMyAdmin first
$query = "SELECT 
                CustomerId, LastName, FirstName, Email, Gender, Address, Zipcode 
                FROM `final__customers` 
                WHERE FirstName like ?
                OR LastName like ?
                OR Email like ?
                ORDER BY LastName $dir";

$stmt = mysqli_prepare($database, $query);
mysqli_stmt_bind_param($stmt, 'sss', $search , $search , $search );
mysqli_stmt_execute($stmt);

/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);

$totalRows = mysqli_stmt_num_rows($stmt);
//echo "<p>$totalRows customers found.</p>";

//run again with limit for pagination
$start = $_GET['start'] ?? 0;
$query .= " LIMIT ?, 50";
$stmt = mysqli_prepare($database, $query);
mysqli_stmt_bind_param($stmt, 'sssi', $search , $search , $search, $start );
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $customerID, $firstName, $lastName, $email,
    $gender, $address, $zipcode);

/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);

// if rows are returned, display table
if (mysqli_stmt_num_rows($stmt)):
    ?>


    <br>
    <table class="table table-light table-striped" id="customerTable">
        <thead>
        <tr>
            <th><a href="?sort=LastName">Last Name</a></th>
            <th><a href="?sort=FirstName">First Name</a></th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Zipcode</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // loop through all the records
        while (mysqli_stmt_fetch($stmt)) {

            // use the primary key as data being passed through the URL
            echo "<tr>
                   <td><a href=\"?id=$customerID]\">$lastName</a></td>
                   <td>$firstName</td>
                   <td>$email</td>
                   <td>$gender</td>
                   <td>$address</td>
                   <td>$zipcode</td> 
                   <td></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination">
            <li class="page-item <?= $start == 0 ? 'disabled' : '' ?>">
                <a class="page-link" href="?start=<?= $start - 50 ?>#customerTable">Previous</a>
            </li>

            <?php
            $totalPages = ceil($totalRows / 50);
            for ($page = 1; $page <= $totalPages; $page++) {
                $newStart = (($page - 1) * 50);
                $link = "?start=$newStart#customerTable";

                echo '  <li class="page-item ' . ($start == $newStart ? 'active' : '') . ' ">
                    <a class="page-link" href=" ' . $link . '">' . $page . '</a>
                    </li>';
            }
            ?>
            <li class="page-item <?= $totalRows <= $start + 50 ? 'disabled' : '' ?>">
                <a class="page-link" href="?start=<?= $start + 50 ?>#customerTable">Next</a>
            </li>
        </ul>
    </nav>


<?php
endif;


mysqli_close($database);

?>
 </div>
