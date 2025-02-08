<?php

include "includes/header.php"
?>

<?php
require_once "includes/database.php";

/**
 * @var $db mysqli

 */
$id = $_GET['lostID'] ?? ' ';
$id =intval($id);
$query = " SELECT * FROM lost_pets WHERE lostID = '$id'";
$result = @mysqli_query($db, $query) or die("Error loading lost pets");
$lost = @mysqli_fetch_array($result, MYSQLI_ASSOC );


?>


<body>


<div class="wrapper">

    <main>



        <?php



        if(isset($_POST['delete'])){

            $lostId = $_POST['lostID'] ?? '';

            $lostId = intval($lostId);


            $query = "DELETE FROM `lost_pets` 
              WHERE  `lost_pets` .`lostID` = '$lostId';";


            $result = (@mysqli_query( $db, $query)) or die('Error in query');

            echo $query;


                header('Location: lost-pets.php?lostID=' . $lostId);



        }


        if(isset($_POST['cancel'])) {



            $lostId = $_POST['lostID'] ?? '';



            header('Location: lost-pets.php?lostID=' . $lostId);

        }


        ?>

        <div class="found-pet">

        <form method="post">
            <div class="found-content">
            <p>Are you sure you want to delete <b><?= $lost['Name']?></b>?  Has <?= $lost['Name']?> been found?</p>
            <input type="hidden" name="lostID" value="<?= $lost['lostID']?>">

            </div>

            <div class="found-btn">
            <button type="submit" name="cancel" class="update-btn" >Still Missing</button>
            <button type="submit" name="delete"  class="update-btn">We found our pet</button>

            </div>
        </form>

        </div>

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

