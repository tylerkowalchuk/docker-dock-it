<?php
$pageTitle = "Perfu.ME - Edit Customer";

include "includes/header.php";


$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? md5(uniqid());

require_once "includes/database.php";


$id = $_GET['CustomerId'] ?? '';

//build query
$query = "SELECT CustomerId, FirstName, LastName, Email, 
       Gender, Address, Zipcode
        FROM final__customers
        WHERE final__customers.CustomerId = '$id'";


// execute query
$result = mysqli_query($database, $query) or die('Error loading customer.');

// get one record from the database
$customerRecord = mysqli_fetch_array($result, MYSQLI_ASSOC);

// if form was submitted
if(isset($_POST['delete'])) {
    // get values from form
    $customerId = $_POST['CustomerId'] ?? '';

    // query to add record
    $query = "DELETE FROM `final__customers` 
                WHERE `final__customers`.`CustomerId` = $customerId
                LIMIT 1;";

    // execute query
    $result = mysqli_query($database, $query) or die("Error deleting customer.");

    // check if record was edited
    //if(mysqli_affected_rows($database)){
    // redirect
    header('Location: customers.php?');
    //}
}
?>

<form method="post">
    <p>Are you sure you want to delete "<?= $customerRecord['FirstName'] ?>"?</p>
    <p>
        <input type="hidden" name="CustomerId" value="<?= $customerRecord['CustomerId'] ?>">
        <button type="submit" name="delete" class="btn btn-danger">Delete Customer</button>
    </p>
</form>
    <a href="customers.php"><button name="cancel" class="btn btn-primary">Cancel</button></a>

<?php
mysqli_close($database);


include "includes/footer.php";

