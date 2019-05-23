<?php require_once 'init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <H1> PHOTO GALLERY</H1>

    <?php

// find_all_users
      
/*
      $res= User::find_all_users();

      while($row = mysqli_fetch_array($res)){

        echo $row['username'] . '<br>' ;
      }

===============================================*/




// ==================================== reading OOP way for find_user_by_id

$found_user= User::find_user_by_id(2);
echo $found_user->id;
echo $found_user->username;
echo $found_user->password;
echo $found_user->first_name;




// reading OOP way for find_all_users


$users= User::find_all_users();
foreach ($users as $user) {
  echo $user->id . '<br>';
  echo $user->username . '<br>';
  echo $user->password . '<br>';
  echo $user->first_name . '<br>';
}




//  Create method =================

$user = new User();

$user->username = "Jetboy";
$user->password = "0987yh";
$user->first_name = "Dickson";
$user->last_name = "Freke";

$user->create();

// =============================


// ******************************
// update ======================

$user = User::find_user_by_id(9);

$user->first_name = "Amisco";

$user->update();




// END Update ***********************


// ?DELETE

/*$user = User::find_user_by_id(10);
$user->delete();

*/

// ++++++++++++++++++++++++++++++++++++++++++


//  Save Method  to update
/*
$user = User::find_user_by_id(9);
$user->username = ' Amisco';
$user->save();
*/


// save method to create
/*
$user = new User;
$user->username = 'Bimbo';
$user->password = 'ghstr75';
$user->first_name = 'Benneth';
$user->last_name = 'Ringo';
$user->save();

*/








     ?>
</body>
</html>