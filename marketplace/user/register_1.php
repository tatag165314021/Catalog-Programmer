<?php
include('includes/config.php');

function email_validation($str) {
    return (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) ? FALSE : TRUE;
}

if (isset($_POST['submit'])) {
    if (($_POST['password'] == $_POST['konfirm_password']) and email_validation($_POST['email'])) {
        $email = $_POST['email'];
        $nama = $_POST['nama_pegawai'];
        $telepon = $_POST['no_telp'];
        $status = $_POST['status'];
        $role = $_POST['role'];
        $skill = $_POST['skill'];
        $bintang = $_POST['bintang'];
        $pass = $_POST['password'];

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
        if ($file_size < 64000000 and ( $file_type == 'image/jpeg' or $file_type == 'image/png')) {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $query1 = mysqli_query($con, "INSERT INTO user(email, nama, telepon, status, role, password, foto) VALUES ('$email','$nama','$telepon','$status','$role','$pass','$image')");

            $number = count($_POST["skill"]);
            if ($number >= 1) {
                for ($i = 0; $i < $number; $i++) {
                    if (trim($_POST["skill"][$i] != '')) {
                        $sql = "INSERT INTO skills(skill,bintang,email) VALUES('" . mysqli_real_escape_string($con, $_POST["skill"][$i]) . "'," . mysqli_real_escape_string($con, $_POST["bintang"][$i]) . ",'$email')";
                        mysqli_query($con, $sql);
                    }
                }
                echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
            } else {
                echo "Skill Gagal Dimasukkan";
            }
        } elseif ($file_name == NULL) {

            $query1 = mysqli_query($con, "INSERT INTO user(email, nama, telepon, status, role, password) VALUES ('$email','$nama','$telepon','$status','$role','$pass')");

            $number = count($_POST["skill"]);
            if ($number >= 1) {
                for ($i = 0; $i < $number; $i++) {
                    if (trim($_POST["skill"][$i] != '')) {
                        $sql = "INSERT INTO skills(skill,bintang,email) VALUES('" . mysqli_real_escape_string($con, $_POST["skill"][$i]) . "'," . mysqli_real_escape_string($con, $_POST["bintang"][$i]) . ",'$email')";
                        mysqli_query($con, $sql);
                    }
                }
                echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
            } else {
                echo "Skill Gagal Dimasukkan";
            }
        } else {
            echo 'Ukuruan File / Tipe File Tidak Sesuai';
        }
    } else {
        echo 'Tolong Masukkan Lagi';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <title>Register</title>
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        
        <!--autocomplete-->
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
        
        <style type="text/css">
            body{
                color: #fff;
                background: #ED3F7C;
                font-family: 'Roboto', sans-serif;
            }
            .form-control{
                height: 40px;
                box-shadow: none;
                color: #969fa4;
            }
            .form-control:focus{
                border-color: #5cb85c;
            }
            .form-control, .btn{        
                border-radius: 3px;
            }
            .signup-form{
                width: 400px;
                margin: 0 auto;
                padding: 30px 0;
            }
            .signup-form h2{
                color: #636363;
                margin: 0 0 15px;
                position: relative;
                text-align: center;
            }
            .signup-form h2:before, .signup-form h2:after{
                content: "";
                height: 2px;
                width: 30%;
                background: #d4d4d4;
                position: absolute;
                top: 50%;
                z-index: 2;
            }	
            .signup-form h2:before{
                left: 0;
            }
            .signup-form h2:after{
                right: 0;
            }
            .signup-form .hint-text{
                color: #999;
                margin-bottom: 30px;
                text-align: center;
            }
            .signup-form form{
                color: #999;
                border-radius: 3px;
                margin-bottom: 15px;
                background: #f2f3f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .signup-form .form-group{
                margin-bottom: 20px;
            }
            .signup-form input[type="checkbox"]{
                margin-top: 3px;
            }
            .signup-form .btn{        
                font-size: 16px;
                font-weight: bold;		
                min-width: 140px;
                outline: none !important;
            }
            .signup-form .row div:first-child{
                padding-right: 10px;
            }
            .signup-form .row div:last-child{
                padding-left: 10px;
            }    	
            .signup-form a{
                color: #fff;
                text-decoration: underline;
            }
            .signup-form a:hover{
                text-decoration: none;
            }
            .signup-form form a{
                color: #5cb85c;
                text-decoration: none;
            }	
            .signup-form form a:hover{
                text-decoration: underline;
            } 
            .picture-container{
                position: relative;
                cursor: pointer;
                text-align: center;
            }
            .picture{
                width: 106px;
                height: 106px;
                background-color: #999999;
                border: 4px solid #CCCCCC;
                color: #FFFFFF;
                border-radius: 50%;
                margin: 0px auto;
                overflow: hidden;
                transition: all 0.2s;
                -webkit-transition: all 0.2s;
            }
            .picture:hover{
                border-color: #2ca8ff;
            }
            .content.ct-wizard-green .picture:hover{
                border-color: #05ae0e;
            }
            .content.ct-wizard-blue .picture:hover{
                border-color: #3472f7;
            }
            .content.ct-wizard-orange .picture:hover{
                border-color: #ff9500;
            }
            .content.ct-wizard-red .picture:hover{
                border-color: #ff3b30;
            }
            .picture input[type="file"] {
                cursor: pointer;
                display: block;
                height: 100%;
                left: 0;
                opacity: 0 !important;
                position: absolute;
                top: 0;
                width: 100%;
            }

            .picture-src{
                width: 100%;

            }

            .tombol{
                width: 30px;
                height: 30px;
                border-radius: 3px;
                font-size: 16px;
                font-weight: bold;		
                min-width: 30px;
                outline: none !important;
            }
        </style>
    </head>
    <body class="body">
        <div class="signup-form">
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <h2>Register</h2>
                <p class="hint-text">Buat Akun Anda</p>

                <div class="form-group">
                    <div class="picture-container">
                        <div class="picture">
                                <!--<img src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no" class="picture-src" id="wizardPicturePreview" title="">-->
                            <img src="assets/img/blank-profile-picture-973461_640.png" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" id="wizard-picture" name="image" class="">
                        </div>
                        <h6 class="">Pilih Gambar</h6>

                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_pegawai" placeholder="nama" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="no_telp" placeholder="No HP" required="required">
                </div>
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="status">Status</label></td>
                            <td>&emsp;</td>
                            <td>
                                <select class="form-control" name="status" id="status" style="width: 285px;">
                                    <option value="Fresh Graduate">Fresh Graduate</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Bekerja">Bekerja</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="role" placeholder="Role" required="required">
                </div>
                <div class="form-group">
                    <table id="dynamic_field">
                        <tr>
                            <td><input type="text" id="skills"  name="skill[]" class="form-control" placeholder="Skill" required="required" size="19"></td>
                            <td>&nbsp;</td>
                            <td>
                                <select class="form-control" name="bintang[]" id="category" required>
                                    <option value="1">Newbie</option>
                                    <option value="2">Junior</option>
                                    <option value="3">Senior</option>
                                    <option value="4">Expert</option>
                                    <option value="5">Legend</option>
                                </select>
                            </td>
                            <td>&emsp;</td>
                            <td><button type="button" name="add" id="add" class="tombol btn-success">+</button></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" onkeyup="check();" placeholder="Password" required="required">
                    <span id = "password_validation" class="error"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="konfirm_password" id="konfirm_password" onkeyup="check();" placeholder="Ulangi Password" required="required">
                    <span id = "konfirm_password_validation" class="error"></span>
                    <span id = 'message_confirm'></span>
                </div>        
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Daftar</button>
                </div>
            </form>
            <div class="text-center">Sudah punya akun? <a href="login.php">Masuk</a></div>
            <div class="text-center"><a href="../index.php">Kembali</a></div>
        </div>
       
        <script type="text/javascript">
            $(document).ready(function () {
// Prepare the preview for profile picture
                $("#wizard-picture").change(function () {
                    readURL(this);
                });
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <script>
            $(document).ready(function () {
                var i = 1;
                $('#add').click(function () {
                    i++;
                    $('#dynamic_field').append('<tr id="row' + i + '">\n\
                                            <td><input type="text" id="skills" name="skill[]" class="form-control name_list" /></td>\n\
                                            <td>&nbsp;</td>\n\
                                            <td>\n\
                                            <select class="form-control" name="bintang[]" id="category" required>\n\
                                            <option value="1">Newbie</option>\n\
                                            <option value="2">Junior</option>\n\
                                            <option value="3">Senior</option>\n\
                                            <option value="4">Expert</option>\n\
                                            <option value="5">Legend</option>\n\
                                            </select>\n\
                                            </td>\n\
                                            <td>&emsp;</td>\n\
                                            <td><button type="button" name="remove" id="' + i + '" class="tombol btn-danger btn_remove">x</button></td></tr>');
                });

                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });

                $('#submit').click(function () {
                    $.ajax({
                        url: "daftar2.php",
                        method: "POST",
                        data: $('#add_name').serialize(),
                        success: function (data)
                        {
                            alert(data);
                            $('#add_name')[0].reset();
                        }
                    });
                });

            });
        </script>
        <script>
            $(function () {
                $("#skills").autocomplete({
                    source: 'autocomplete_search.php'
                });
            });
        </script>
        <script>
            /*==================================================================
             [ Mengecek password dan konfirmasi password Saat mendaftar ]*/
            var check = function () {
                if (document.getElementById('password').value === document.getElementById('konfirm_password').value) {
                    document.getElementById('message_confirm').style.color = 'green';
                    document.getElementById('message_confirm').style.display = "block";
                    document.getElementById('message_confirm').innerHTML = '';
                } else {
                    document.getElementById('message_confirm').style.color = 'red';
                    document.getElementById('message_confirm').style.display = "block";
                    document.getElementById('message_confirm').innerHTML = 'Tidak Cocok Dengan Password Yang Dibuat';
                }
            };

        </script>
    </body>
</html>   