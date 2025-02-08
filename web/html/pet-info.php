<?php

include "includes/header.php"
?>



<body>

<div class="wrapper">

    <main>
        <h1 class="petAdoption"> Pet for Adoption</h1>
<div class="pet-information">


        <div class="pet-info">

            <h2> Pet Information </h2>

        <?php

        require_once "includes/database.php";
        $petID = $_GET['petID'] ?? '';


        $query = "SELECT *
                FROM dog_breed
                JOIN adopt_pets ON dog_breed.dog_breed_id = adopt_pets.petID
                JOIN breed ON dog_breed.breed_id = breed.breed_id
                WHERE adopt_pets.petID = '$petID'";

        $result = (@mysqli_query($db, $query)) or die('You have an error in query');


        ?>


        <?php

        while($pet= mysqli_fetch_array($result, MYSQLI_ASSOC)) {








            echo '<p><b> Pet Name:</b>' .$pet['Name'] . ' </p>';
            echo '<p> <b>Breed:</b>' .$pet['breed'] . ' </p>';
            echo  '<p> <b>Sex:</b> '. $pet['Sex'] .  '</p>';
            echo ' <p> <b>Birthday:</b> ' . $pet['Birthday'] .'</p>';
            echo  '<p> <b>Description</b> : '. $pet['Description']. '</p>';
            echo  '<p> <b>Donation Fee</b> : '. $pet['Donation_Fee']. '</p>';
            echo  '<p> <b>Status:</b> '. $pet['Status']. '</p>';

        }



        ?>


            </div>

        <div class="contact-us">
            <h2> Hours of Operation</h2>
            <p>Monday-Friday<br> 8:00-4pm</p>
            <p>Saturday-Sunday<br>  8:00-6pm</p>


        </div>

    <div class="contact-us">

        <h2> Contact Us</h2>
        <p> Email: adoptpettoday@gmail.com</p>
        <p>Phone Number: 414-414-1111</p>


    </div>







</div>


  </main>



    <?php

    mysqli_close($db);
    ?>



</div>


</body>
</html>






<?php

include "includes/footer.php"
?>
