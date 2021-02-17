<?php 
//Kol vyskta sesija laikinai išaugomi duomenys, kad veiktų puslapiuose.
    session_start();
    if(isset($_POST['submit'])) {
        include_once 'db.inc.php';
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
//Tikriname ar yra tuščių langelių
        if(empty($uid) || empty($pwd)) {
            header("Location: ../signup.php?=login=empty");
            exit();
        } else {
//Tikriname ar atitinka duomenys
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);
            if($result_check < 1) {
                header("Location: ../signup.php?=login=error");
                exit();
            } else {
                if($row = mysqli_fetch_assoc($result)) {
//Palyginame slaptažodžius ar atitinka
                    $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                    if($hashedPwdCheck == false) {
                        header("Location: ../signup.php?=login=error");
                        exit();
//Priskiriame kintamuosius kurie galios sesijos metu.
                    } elseif($hashedPwdCheck == true) {
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_first'] = $row['user_first'];
                        $_SESSION['u_last'] = $row['user_last'];
                        $_SESSION['u_email'] = $row['user_email'];
                        $_SESSION['u_uid'] = $row['user_uid'];
                        header("Location: ../signup.php?=login=success");
                        exit();
                    }
                }
            }
        }
    } else {
        header("Location: ../index.php?=login=error");
        exit();
    }