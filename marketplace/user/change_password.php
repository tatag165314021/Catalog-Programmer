<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['id_login']) == 0) {
    header('location:login.php');
} else {
    ?>
    <html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>CODER | GANTI PASSWORD</title>
            
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
            <link rel="shortcut icon" href="assets/img/orcois_logo.png">
            <!--bootstraps 4-->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
            <!--autocomplete-->
            <link rel="stylesheet" href="assets/css/jquery-ui.css">
            <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
            
            
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
            <?php include('header.php'); ?>
            <h1><span></span></h1><br><br><br>

            <div class="col-md-4 col-md-offset-4" id="login">
                <div id="inner-wrapper" class="login">
                    <article>
                        <form action="update_password.php" method="POST" enctype="multipart/form-data">
                        <!--<label style="margin-left:100px">Edit Profil Anda</label>-->
                            <center><h2>Menu Ubah Password</h2></center><br>
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id_login']; ?>">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                                        <input type="password" name="password_lama" id="password_baru" onkeyup="check();" class="form-control" placeholder="Password Lama">
                                        <!--<span id = "password_validation" class="error"></span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                                        <input type="password" name="password_baru" id="password" onkeyup="check();" class="form-control" placeholder="Password Baru"><br/>
                                        <span id = "konfirm_password_validation" class="error"></span>
                                        <!--<span id = 'message_confirm'></span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                                        <input type="password" name="konfirm_password_baru" id="konfirm_password" onkeyup="check();" class="form-control" placeholder="Konfirmasi Password Baru"><br/>
                                        <span id = "konfirm_password_validation" class="error"></span><br/>
                                        
                                    </div>
                                    <div class="input-group">
                                        <span id = 'message_confirm'></span>
                                    </div>
                                    
                                </div><br>

                            <button type="submit" class="btn btn-success btn-block" name="ganti_password"><b>Ubah Password</b></button>
                        </form>
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
                                            <td><input type="text" id="skills" name="skillBaru[]" class="form-control name_list" size="14"/></td>\n\
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
                $('#skills').autocomplete({
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

<?php } ?>



