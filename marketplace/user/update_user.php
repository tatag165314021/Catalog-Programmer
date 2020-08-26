<?php

include('includes/config.php');
error_reporting(0);
$user_id = $_POST['user_id'];
$email = $_POST['email'];
$nama = htmlspecialchars($_POST['nama']);
$telepon = htmlspecialchars($_POST['noHP']);
$status = $_POST['status'];
$role = htmlspecialchars($_POST['role']);
//$pass = $_POST['password'];

$idSkil = $_POST['idSkillLama'];
$skill = $_POST['skillLama'];
$bintang = $_POST['bintangLama'];
$deskripsi = htmlspecialchars($_POST['deskripsi']);

$file_name = $_FILES['image']['name'];
$file_size = $_FILES['image']['size'];//max 2MB
$file_type = $_FILES['image']['type'];

function redudant($lama, $baru) {
    for ($i = 0; $i < count($lama); $i++) {
        for ($j = 0; $j < count($baru); $j++) {
            if (strcasecmp($lama[$i], $baru[$j]) == 0) {
                return true;
            }
        }
    }
    return false;
}

function checkValue($val) {
    if (count($val) != count(array_unique($val))) {
        return true;
    }
    return false;
}

try {
        
        if ($file_size < 1048576 and ( $file_type == 'image/jpeg' or $file_type == 'image/png')) {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $queryImage = "UPDATE `user` SET foto='" . $image . "' WHERE `email`='" . $email . "'";
            mysqli_query($con, $queryImage);
        }else if($file_size > 1048576){
            echo "<script type='text/javascript'> alert('Ukuran File lebih dari 1 MB !'); </script>";
            echo "<script type='text/javascript'> document.location = 'change_profile.php'; </script>";
        }else if($file_type == 'image/jpeg' or $file_type == 'image/png'){
            echo "<script type='text/javascript'> alert('Tipe File bukan JPG atau PNG !'); </script>";
            echo "<script type='text/javascript'> document.location = 'change_profile.php'; </script>";
        }
        
        
        $numberLama = count($_POST["skillLama"]);
        $numberBaru = count($_POST["skillBaru"]);
        if(strlen($deskripsi) <= 100){
            $query = "UPDATE `user` SET `email`='" . $email . "', `nama`='" . $nama . "',`telepon`='" . $telepon . "',`status`='" . $status . "',`role`='" . $role . "',`deskripsi`='" . $deskripsi . "' WHERE `user_id`='" . $user_id . "'";
            mysqli_query($con, $query);
        }else{
            echo "<script type='text/javascript'> alert('Jumlah Karakter di deskripsi lebih dari 100 !'); </script>";
        }
        


        if ($numberLama >= 1) {
            for ($i = 0; $i < $numberLama; $i++) {
                if (trim($_POST["skillLama"][$i] != '')) {
                    try {
                        $sql = "UPDATE skills SET skill='" . mysqli_real_escape_string($con,$_POST["skillLama"][$i]) . "', bintang=" . $_POST["bintangLama"][$i] . " WHERE id='" . $_POST["idSkillLama"][$i] . "'";
                        mysqli_query($con, $sql);
                    } catch (Exception $ex) {
                        echo "<script type='text/javascript'> alert('Gagal Mengubah Skill !'); </script>";
                    }
                } else {
                    echo "<script type='text/javascript'> alert('Gagal Mengubah Skill !'); </script>";
                }
            }
        }
     
        //echo 'berhasil';
        if (redudant($_POST["skillLama"], $_POST["skillBaru"])) {
            echo "<script type='text/javascript'> document.location = 'change_profile.php'; </script>";
        } else {
            if (checkValue($_POST["skillBaru"])) {
                echo "<script type='text/javascript'> document.location = 'change_profile.php'; </script>";
            } else {
                if ($numberBaru >= 1) {
                    for ($i = 0; $i < $numberBaru; $i++) {
                        if (trim($_POST["skillBaru"][$i]) != '') {
                            try {
                                $id_skill = base_convert(date('Ymd').microtime(false),10,36);
                                $sql = "INSERT INTO skills(skill,bintang,user_id,id) VALUES('" . mysqli_real_escape_string($con, $_POST["skillBaru"][$i]) . "'," . mysqli_real_escape_string($con, $_POST["bintangBaru"][$i]) . ",'$user_id','$id_skill')";
                                mysqli_query($con, $sql);
                            } catch (Exception $ex) {
                                echo "gagal mengubah skill";
                            }
                        } else {
                            echo 'gagal';
                        }
                    }
                }
            }
            echo "<script type='text/javascript'> document.location = 'change_profile.php'; </script>";
        }
        echo "<script type='text/javascript'> document.location = 'change_profile.php'; </script>";
        
        
    
} catch (Exception $ex) {
    echo 'gagal';
}
?>
