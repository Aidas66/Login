<?php 
    if(isset($_POST['submit'])) {
        include_once 'db.inc.php';
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        
// mysqli_real_escape_string pašalina tuščius tarpus ir pakeičia kodą į tekstą 
// If empty tikriname ar yra tučių laukelių
        if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
            header("Location: ../signup.php?signup=empty");
            exit();
        } else {
// Tikriname ar teisingi simboliai įvesti
            if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../signup.php?signup=invalid");
                exit();
            } else {
//Tikriname ar galiojantis email formatas                
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../signup.php?signup=invalidemail");
                    exit();
                } else {
//Tikriname ar username dar nėra pasirinktas toks                    
                    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
                    $result = mysqli_query($conn, $sql);
                    $result_check = mysqli_num_rows($result);
                    if($result_check > 0) {
                        header("Location: ../signup.php?signup=usertaken");
                        exit();
                    } else {
//Sukuriame kodavimą slaptažodžiui kad jis būtų visada užšifruotas       
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
//Įkeliame vartotoją į duomenų bazę                        
                        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES('$first','$last','$email','$uid','$hashedPwd');";
                        mysqli_query($conn, $sql);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                } 
            }
        }
    } else {
//Jei bando atspėti kelia nukreipia į sigup.php
        header("Location: ../signup.php");
        exit();
    }