<?php
//session_start();
include('includes/config.php');
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>CODER</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--bootstraps 4-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--star rating-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css"> 
        
        <link rel="shortcut icon" href="assets/img/orcois_logo.png">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style>
            body{
                font-family: 'Open Sans', sans-serif;
            }
            *:hover{
                -webkit-transition: all 1s ease;
                transition: all 1s ease;
            }
            section{
                float:left;
                width:100%;
                background: #fff;  /* fallback for old browsers */
                padding:30px 0;
            }
            h1{float:left; width:100%; color:#232323; margin-bottom:30px; font-size: 14px;}
            h1 span{font-family: 'Libre Baskerville', serif; display:block; font-size:45px; text-transform:none; margin-bottom:20px; margin-top:30px; font-weight:700}
            h1 a{color:#131313; font-weight:bold;}

            /*Profile Card 5*/
            .profile-card-5{
                margin-top:20px;
            }
            .profile-card-5 .btn{
                border-radius:2px;
                text-transform:uppercase;
                font-size:12px;
                padding:7px 20px;
            }
            .profile-card-5 .card-img-block {
                width: 91%;
                margin: 0 auto;
                position: relative;
                top: -20px;

            }
            .profile-card-5 .card-img-block img{
                border-radius:5px;
                box-shadow:0 0 10px rgba(0,0,0,0.63);
            }
            .profile-card-5 h5{
                color:#4E5E30;
                font-weight:600;
            }
            .profile-card-5 p{
                font-size:14px;
                font-weight:300;
            }
            .profile-card-5 .btn-primary{
                background-color:#4E5E30;
                border-color:#4E5E30;
            }
            /*star rating*/
            .checked {
                color: orange;
            }
            .form-control-borderless {
                border: none;
            }

            .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
                border: none;
                outline: none;
                box-shadow: none;
            }
            
        </style>
    </head>
    <body >

        <?php include('navbar.php'); ?>
        <section>
            <div class="container">
                <div class="row">
                    <h1><span></span></h1>
                    <div class="container">
                        <br/>
                        <p>Jika Ingin Merekrut Salah Satu Dari User Ini Atau Ingin Mendapatkan Kontak Mereka<br>
                        Silahkan Hubungi Admin Orcois Lewat WhatsApp <i class="fa fa-whatsapp"></i><br>
                        <a href="https://wa.me/6285725898422"><button style="margin-left: 115px auto"class="btn btn-success">Kontak Admin <i class="fa fa-whatsapp"></i></button></a>
                        </p>
                    </div>
  
                    
                </div>
            </div>
        </section>
        <!-- js untuk jquery -->
        <script src="assets/js/jquery-1.11.2.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('a#tampil').click(function () {
                    var url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        success: function (response) {
                            $('#modalTampil').html(response);
                        }
                    });
                });

            });
        </script>
        

    </body>
</html>
<?php ?>