<?php

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



function emptyInputLogIn($email, $password) {
    $result;
    if(empty($email) || empty($password) ){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    $result;
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? $result = TRUE : $result = FALSE;

    return $result;
}

function invalidPhone($phone){
    $result;
 // Allow +, - and . in phone number
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
 // Remove "-" from number
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
 // Check the length of number
 // This can be customized if you want phone number from a specific country
    if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 10) {
    $result = true;
    } else {
    $result = false;
    }  
    
 return $result;
}

function passwordVerifyLength( $password){

    if(strlen($password) < 8){
        return true;
    } else{
        return false;
    }
}

function passwordMatch( $password, $repassword ){
    $result;
     if( $password == $repassword){
        $result = false;
     } else {
        $result = true;
     }

     return $result;
}

function emailExists($db, $email){

    try{
    $sql ="SELECT * FROM tclients WHERE email=:email";
    $query=$db->prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0){
      
        return $results;
    }
    else{
        $result = false;
        return $result;
    }

    }  catch(PDOException $ex){
        header("location: ../signup.php?error=somethingwentwrong");
        exit();
    }

  
}

function phoneExists($db, $phone){
    
    try{
        $sql ="SELECT * FROM tclients WHERE phone=:phone";
        $query=$db->prepare($sql);
        $query-> bindParam(':phone', $phone, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
    
        if($query->rowCount() > 0){
            $result = true;
            return $result;
        }
        else{
            $result = false;
            return $result;
        }
    
        }  catch(PDOException $ex){
            header("location: ../signup.php?error=somethingwentwrong");
            exit();
        }
}

function rememberMe($userId){

 $encryptedCookieData = base64_encode("nLBrTF-4MfEtxJ7xBl3GQf34AZYZlEfeBGLAo-l1WCw8-komC5sqLtHmHoW8n5BV{$userId}");

 setcookie("remeberUserCookie", $encryptedCookieData, time()+(10 * 365 * 24 * 60 * 60),"/",FALSE,TRUE);
}

function signout(){
    unset($_SESSION['id']);
    unset($_SESSION['email']);

    if(isset($_COOKIE["remeberUserCookie"])) {
        unset($_COOKIE["remeberUserCookie"]);
        setcookie("remeberUserCookie", null, -1, '/');
    }
    session_destroy();
    session_start();
    session_regenerate_id(true);
    header("location: index.php");
}

?>