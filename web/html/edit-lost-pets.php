<?php

include "includes/header.php"
?>

<?php
require_once "includes/database.php";

/**
 * @var $db mysqli

 */
$id = intval($_GET['lostID']) ?? ' ';
$query = " SELECT * FROM lost_pets WHERE lostID = '$id'";
$result = @mysqli_query($db, $query) or die("Error loading lost pets");
$lost = @mysqli_fetch_array($result, MYSQLI_ASSOC );


?>


<body>


<div class="wrapper">

    <main>



        <?php



        if(isset($_POST['update'])){

            $lostId = $_POST['lostID'] ?? '';
            $name = $_POST['Name'] ?? '';
            $description = $_POST['Description'] ?? '';
            $status = $_POST['Status'] ?? '';
            $lastSeen = $_POST['last_seen'] ?? '';
            $contact = $_POST['contact'] ?? '';


            $lostId = intval($lostId);
            $description = strip_tags($description);
            $status = strip_tags($status);
            $lastSeen = strip_tags($lastSeen);
            $contact = strip_tags($contact);

            $query = "UPDATE `lost_pets` 
                    SET `Name` = ?, 
                  `Description` = ?, 
                  `Status` = ?,
                  `last_seen` = ?,
                  `contact` = ? 
                WHERE `lost_pets` .`lostID` = ?;";

            $stmt = @mysqli_prepare($db, $query) or die('Error in query');

            mysqli_stmt_bind_param($stmt, 'sssssi',$name,$description,$status,$lastSeen,$contact,$lostId );
            $result = @mysqli_stmt_execute($stmt) or die('Error in edit');






            header('Location: lost-pets.php?lostID=' . $lostId);



        }


        ?>


        <form method="post">
            <div class="edit-form">
            <div class="edit-input">
                <label for="Name" >Name</label>
                <input type="text"  id="name" name="Name" value="<?= $lost['Name']?>">
                <input type="hidden" name="lostID" value="<?= $lost['lostID']?>">
            </div>

            <div class="edit-input">
                <label for="Description" >Description</label>
                <textarea id="description" name="Description"><?= $lost['Description']?></textarea>
            </div>

            <div class="edit-input"><label for="Status" >Status</label>
                <input type="text"  id="status" name="Status" value="<?= $lost['Status']?>">
            </div>

            <div class="edit-input"><label for="last_seen" >Last Seen</label>
                <input type="date"  id="last-seen" name="last_seen" value="<?= $lost['last_seen']?>">
            </div>

            <div class="edit-input"><label for="contact" >Contact</label>
                <input type="text"  id="contact" name="contact" value="<?= $lost['contact']?>">
            </div>


                <div class="update-btn">
            <input type="hidden" name="lostID" value="<?= $lost['lostID']?>">
            <button type="submit" name="update" class="update-btn" >Update Information</button>

                </div>
            </div>
        </form>



    </main>






    <?php

    mysqli_close($db);

    ?>



</div>


<?php

include "includes/footer.php"
?>
</body>
</html>
