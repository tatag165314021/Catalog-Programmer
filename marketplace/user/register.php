<?php
include('includes/config.php');

function email_validation($str) {
    return (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) ? FALSE : TRUE;
}

function checkValue($val){
    if(count($val) != count(array_unique($val))){
        return true;
    }
    return false;
}

function encrypted($kode){
	// Store the cipher method 
	$ciphering = "AES-128-CTR"; 
  
	// Use OpenSSl Encryption method 
	$iv_length = openssl_cipher_iv_length($ciphering); 
	$options = 0; 
  
	// Non-NULL Initialization Vector for encryption 
	$encryption_iv = '1234567891011121'; 
  
	// Store the encryption key 
	$encryption_key = "orcoiste"; 
  
	// Use openssl_encrypt() function to encrypt the data 
	$encryption = openssl_encrypt($kode, $ciphering, 
            $encryption_key, $options, $encryption_iv); 
	return $encryption;
}

if (isset($_POST['submit'])) {
    if (($_POST['password'] == $_POST['konfirm_password']) and email_validation($_POST['email'])) {
        $email = $_POST['email'];
        $nama = htmlspecialchars($_POST['nama_pegawai']);
        $telepon = htmlspecialchars($_POST['no_telp']);
        $status = htmlspecialchars($_POST['status']);
        $role = htmlspecialchars($_POST['role']);
        $skill = htmlspecialchars($_POST['skill']);
        $bintang = htmlspecialchars($_POST['bintang']);
        $pass = htmlspecialchars($_POST['password']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
        if ($file_size < 1048576 and ( $file_type == 'image/jpeg' or $file_type == 'image/png')) {
            if (checkValue($_POST["skill"])) {
                echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
            } else {
                $mysql_get_users = mysqli_query($con, "SELECT * FROM USER WHERE email='" . $_POST['email'] . "'");
                if (mysqli_num_rows($mysql_get_users) > 0) {
                    echo "<script type='text/javascript'> alert('email sudah digunakan !'); </script>";
      
                } else {
                    try {
                        $number = count($_POST["skill"]);
                        if ($number >= 1) {
                            //cari id terakhir
                            $q1 = "SELECT MAX(CONVERT(substring(user_id,4),unsigned)) AS kode FROM user ORDER BY kode DESC";
                            $hasil = mysqli_query($con, $q1);
                            $jum_data = mysqli_num_rows($hasil);
                            $cekTerbesar= mysqli_fetch_assoc($hasil);
                            $user_id;
                            if ($jum_data > 0) {
                                $terakhir = intval($cekTerbesar['kode']);
                                $terakhir++;
                                $kode = str_pad($terakhir, 0, "0", STR_PAD_LEFT);
                                $user_id = "MU-" . $kode;
                            } else {
                                $user_id = "MU-1";
                            }
                            
                            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                            //$pass_enkripsi = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            
                            if(strlen($deskripsi) <= 100){
                                $pass_enkripsi = encrypted($_POST['password']);
                                $query1 = mysqli_query($con, "INSERT INTO user(user_id, email, nama, telepon, status, role, password, foto, aktif,deskripsi) VALUES ('$user_id','$email','$nama','$telepon','$status','$role','$pass_enkripsi','$image',1,'$deskripsi')");
                                for ($i = 0; $i < $number; $i++) {
                                    if (trim($_POST["skill"][$i] != '')) {
                                        $id_skill = base_convert(date('Ymd').microtime(false),10,36);
                                        $sql = "INSERT INTO skills(skill,bintang,user_id,id) VALUES('" . mysqli_real_escape_string($con, $_POST["skill"][$i]) . "'," . mysqli_real_escape_string($con, $_POST["bintang"][$i]) . ",'$user_id','$id_skill')";
                                        mysqli_query($con, $sql);
                                    }
                                }
                                echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
                            }else{
                                echo "<script type='text/javascript'> alert('Jumlah Karakter di deskripsi lebih dari 100 !'); </script>";
                            }
                        } else {
                            echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
                        }
                    } catch (Exception $ex) {
                        echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
                    }
                }
            }

        } else if ($file_name == NULL) {
            if (checkValue($_POST["skill"])) {
                echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
            } else {
                $mysql_get_users = mysqli_query($con, "SELECT * FROM USER WHERE email='" . $_POST['email'] . "'");
                if (mysqli_num_rows($mysql_get_users) > 0) {
                    echo "<script type='text/javascript'> alert('email sudah digunakan !'); </script>";
                } else {
                    try {
                        //cari id terakhir
                        $q1 = "SELECT MAX(CONVERT(substring(user_id,4),unsigned)) AS kode FROM user ORDER BY kode DESC";
                        $hasil = mysqli_query($con, $q1);
                        $jum_data = mysqli_num_rows($hasil);
                        $cekTerbesar= mysqli_fetch_assoc($hasil);
                        $user_id;
                        if ($jum_data > 0) {
                            $terakhir = intval($cekTerbesar['kode']);
                            $terakhir++;
                            $kode = str_pad($terakhir, 0, "0", STR_PAD_LEFT);
                            $user_id = "MU-" . $kode;
                        } else {
                            $user_id = "MU-1";
                        }
                        
                        if(strlen($deskripsi) <= 100){
                            $number = count($_POST["skill"]);
                            if ($number >= 1) {
                                $pass_enkripsi = encrypted($_POST['password']); 
                                $query1 = mysqli_query($con, "INSERT INTO user(user_id, email, nama, telepon, status, role, password, aktif, deskripsi) VALUES ('$user_id', '$email','$nama','$telepon','$status','$role','$pass_enkripsi',1,'$deskripsi')");
                                for ($i = 0; $i < $number; $i++) {
                                    if (trim($_POST["skill"][$i] != '')) {
                                        $id_skill = base_convert(date('Ymd').microtime(false),10,36);
                                        $sql = "INSERT INTO skills(skill,bintang,user_id, id) VALUES('" . mysqli_real_escape_string($con, $_POST["skill"][$i]) . "'," . mysqli_real_escape_string($con, $_POST["bintang"][$i]) . ",'$user_id','$id_skill')";
                                        mysqli_query($con, $sql);
                                    }
                                }
                                echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
                            } else {
                                echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
                            }
                        }else{
                            echo "<script type='text/javascript'> alert('Jumlah Karakter di deskripsi lebih dari 100 !'); </script>";
                        }
                    } catch (Exception $ex) {
                        echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
                    }
                }
                
            }
        } else if($file_size > 1048576){
            echo "<script type='text/javascript'> alert('Ukuran File lebih dari 1 MB !'); </script>";
            echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
        }else if($file_type != 'image/jpeg' or $file_type != 'image/png'){
            echo "<script type='text/javascript'> alert('File Tidak Didukung ! Harus JPG atau PNG'); </script>";
            echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Gagal, Tolong Isi Kembali !'); </script>";
        echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
    }
}
?>
<html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>CODER | REGISTER</title>
            
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
            <link rel="shortcut icon" href="assets/img/orcois_logo.png">
            <!--bootstraps 4-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
            <!--autocomplete-->
            <!--<link rel="stylesheet" href="assets/css/jquery-ui.css">
            <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="assets/js/jquery-ui.js"></script>-->
            
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
            <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
            <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
            
            <style  type="text/css">
               
            body{
                color: black;
                background: white;
                font-family: 'Roboto', sans-serif;
            }
            
            #login {
                -webkit-perspective: 1000px;
                -moz-perspective: 1000px;
                perspective: 1000px;
                margin-top:50px;
                margin: 50px auto;
            }
            .login {
                font-family: 'Josefin Sans', sans-serif;
            }
            .login:hover {
                -webkit-transform: rotate(0);
                -moz-transform: rotate(0);
                transform: rotate(0);
            }
            .login article {

            }
            .login .form-group {
                margin-bottom:17px;
            }
            .login .form-control,
            .login .btn {
                border-radius:0;
            }
            .login .btn {
                text-transform:uppercase;
                letter-spacing:3px;
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
        <body>
            <div class="col-md-4 col-md-offset-4" id="login">
                <div id="inner-wrapper" class="login">
                    <article>
                        <form action="register.php" method="POST" enctype="multipart/form-data">
                        <!--<label style="margin-left:100px">Edit Profil Anda</label>-->
                            <center><h2>Register</h2>
                                <p class="hint-text">Buat Akun Anda</p>
                            </center>
                                <div class="form-group">
                                    <div style="margin: 10px auto 20px; display: block;" class="input-group">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img src="assets/img/blank-profile-picture-973461_640.png" class="picture-src" id="wizardPicturePreview" title="">
                                                <input type="file" id="wizard-picture" name="image" class="" accept="image/x-png,image/jpeg">
                                            </div>
                                            <h6 class="">Pilih Gambar</h6>
                                            <h8 class="">Ukuran File Gambar Maksimal 1 MB</h8><br>
                                            <h8 class="">Gunakan foto identitas yang rapi, usahakan tampilkan bagian wajah dan setengah badan</h8>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
                                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <input type="text" name="no_telp" placeholder="No HP atau Telepon" required="required" maxlength="13" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <table>
                                            <tr>
                                                <td><label for="exampleFormControlInput1" >Status Pekerjaan</label></td>
                                                <td>&emsp;</td>
                                                <td>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="status" id="status" >
                                                        <option value="Fresh Graduate">Fresh Graduate</option>
                                                        <option value="Freelance">Freelance</option>
                                                        <option value="Bekerja">Bekerja</option>
                                                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <input type="text" id="roles" name="role" placeholder="Role (Bidang keahlian)" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <table id="dynamic_field">
                                                <tr>
                                                    <td>
                                                        <input type="text" id="skills"  name="skill[]" class="form-control" placeholder="Skill (keahlian yang dimiliki)" size="19" required="required">
                                                    </td>
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
                                                    <td>&nbsp;</td>
                                                    <td><button type="button" name="add" id="add" class="tombol btn-success">+</button></td>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" placeholder="Tuliskan Deskripsi Tentang Anda dalam 100 karakter" rows="3" maxlength="100"></textarea>
                                        
                                    </div>
                                    <div class="input-group">
                                        <label for="exampleFormControlInput1" > tersisa <b><span id="chars">100</span></b> karakter</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <input type="password" class="form-control" name="password" id="password" onkeyup="check();" placeholder="Password" required="required">
                                        <span id = "password_validation" class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                                        <input type="password" class="form-control" name="konfirm_password" id="konfirm_password" onkeyup="check();" placeholder="Ulangi Password" required="required">
                                        <span id = "konfirm_password_validation" class="error"></span>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span id = 'message_confirm'></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-success btn-block" name="submit"><b>Daftar</b></button>
                                    </div>
                                </div>
                        </form>
                        <div class="text-center" style="color: black">Sudah punya akun? <a href="login.php" style="color: black">Masuk</a></div>
                        <div class="text-center" ><a href="../index.php" style="color: black">Kembali</a></div>
                    </article>
                </div>
            </div>
            <script>
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
                                            <td><input type="text" id="skills'+i+'" name="skillBaru[]" class="form-control name_list" placeholder="Skill (keahlian yang dimiliki)" size="14"/></td>\n\
                                            <td>&nbsp;</td>\n\
                                            <td>\n\
                                            <select class="form-control" name="bintangBaru[]" id="category" required>\n\
                                            <option value="1">Newbie</option>\n\
                                            <option value="2">Junior</option>\n\
                                            <option value="3">Senior</option>\n\
                                            <option value="4">Expert</option>\n\
                                            <option value="5">Legend</option>\n\
                                            </select>\n\
                                            </td>\n\
                                            <td>&nbsp;</td>\n\
                                            <td><button type="button" name="remove" id="' + i + '" class="tombol btn-danger btn_remove">x</button></td></tr>');
                        $(function () {
                            $("#skills"+i).autocomplete({
                                source: 'autocomplete_skills.php'
                            });
                        });
                        
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
                    source: 'autocomplete_skills.php'
                });
            });
            $(function () {
                $("#roles").autocomplete({
                    source: 'autocomplete_roles.php'
                });
            });
            var maxLength = 100;
            $('textarea').keyup(function() {
            var length = $(this).val().length;
            var length = maxLength-length;
            $('#chars').text(length);
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