<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['id_login']) == 0) {
    header('location:login.php');
}else {
    $idSession = $_SESSION['id_login'];
    $active= mysqli_query($con, "select aktif from user where user_id='$idSession'");
    $rowActive = mysqli_fetch_assoc($active);
    if($rowActive['aktif'] == 0){
        header('location:blocked.php');
    }else{
    ?>
   <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Coder</title>
        
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
        
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="assets/img/orcois_logo.png">
        
        <style>
            body{
                 
                
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

        <?php include('header.php'); ?>
        <section>
            <div class="container-fluid bg-light">
            
                <div class="row justify-content-center ">
                    <h1><span></span></h1>
                    <div class="container">
                        <br/>
                        <div class="row justify-content-center">
                           <div class="col-md-10">
                                    <form class="card card-sm" method="get">
                                        <div class="card-body row no-gutters align-items-center">
                                             <div class="mdb-select md-form">
                                                <select style="border-radius:4px; font-weight:bold;" data-trigger="" name="pilih">
                                                <option value="nama" data-toggle="tooltip" title="Filter berdasarkan nama"><b>Nama</b></option>
                                                <option value="role" data-toggle="tooltip" title="Filter berdasarkan keahlian"><b>Role</b></option>
                                                <option value="skill" data-toggle="tooltip" title="Filter berdasarkan keahlian lebih spesifik"><b>Skill</b></option>
                                                </select>
                                            </div>
                                            <div class="col">
                                            <input name="cari" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Temukan Coder" id="cari">
                                            </div>
                                   
                                            <button class="btn btn-success" name="submit" type="submit"><center><i class="fa fa-search"></center></i></button>
                                     
                                    </div>
                                </form>
                            </div>
                           
                        </div>
                    </div>
  
                    <?php
                    if (isset($_GET['cari'])) {
                        $cari = @$_GET['cari'];
                        $pilih = @$_GET['pilih'];
                        if (strcmp($pilih, "nama") == 0) {
                            if(empty($cari)){
                               $message = "Data Tidak Ditemukan!";
                               echo "<script type='text/javascript'>alert('$message');</script>";
                            }else if(!empty($cari)){
                            $query = mysqli_query($con, "select * from user where aktif=1 AND nama like '%" . $cari . "%' ORDER BY (CONVERT(substring(user_id,4),unsigned)) ASC");
                            }
                        } else if (strcmp($pilih, "role") == 0) {
                            if(empty($cari)){
                               $message = "Data Tidak ditemukan";
                               echo "<script type='text/javascript'>alert('$message');</script>";
                            }else if(!empty($cari)){
                            $query = mysqli_query($con, "select * from user where aktif=1 AND role like '%" . $cari . "%' ORDER BY (CONVERT(substring(user_id,4),unsigned)) ASC");
                            }
                        } else if (strcmp($pilih, "skill") == 0) {
                            if(empty($cari)){
                               $message = "Data Tidak ditemukan";
                               echo "<script type='text/javascript'>alert('$message');</script>";
                            }else if(!empty($cari)){
                               $query = mysqli_query($con, "SELECT user.user_id as user_id, user.foto as foto, user.email as email, user.nama as nama FROM `skills` JOIN user ON skills.user_id = user.user_id WHERE aktif=1 AND skill LIKE '%" . $cari . "%'");
                                
                            }
                        } 

                    } else {
                        $query = mysqli_query($con, "select * from user where aktif=1 ORDER BY (CONVERT(substring(user_id,4),unsigned)) ASC");
                    }
//                    
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="col-sm-3 ; shadow m-2 bg-white rounded ; wow fadeInUp ">
                            <div class="card profile-card-5">
                                <?php if ($row['foto'] == null) { ?>
                                    <div class="card-img-block">
                                        <img style="margin: 10px auto 20px; display: block;" src="assets/img/blank-profile-picture-973461_640.png" alt="Card image cap" height="200" width="200">
                                    </div>
                                <?php } else { ?>
                                    <div class="card-img-block">
                                        <?php echo '<img style="margin: 10px auto 20px; display: block;" src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" alt="Card image cap" height="200" width="200"/>'; ?>
                                    </div>
                                <?php } ?>
                                <div class="card-body pt-0">
                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                    <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                                    <label class="card-title"><?php echo $row['role']; ?></label>
                                    <?php
                                    $user_id = $row['user_id'];
                                    $querySkill = mysqli_query($con, "select skill,bintang from skills where user_id = '$user_id' order by bintang DESC LIMIT 3");
                                    while ($rowSkill = mysqli_fetch_assoc($querySkill)) {
                                        $id = $row['user_id'];
                                        ?>
                                       <table class="table table-bordered table-striped table-sm">
                                         <tr >
                                        <td>
                                        <h7 class="card-text"><?php echo $rowSkill['skill']; ?></h7>
                                       </td>
                                      
                                       <td align=Right>
                                        <?php if ($rowSkill['bintang'] == 5) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span><br>
                                        <?php } elseif ($rowSkill['bintang'] == 4) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <br>
                                        <?php } elseif ($rowSkill['bintang'] == 3) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <br>
                                        <?php } elseif ($rowSkill['bintang'] == 2) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <br>
                                        <?php } elseif ($rowSkill['bintang'] == 1) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <br>
                                        <?php } ?>
                                        </td>
                                         </tr>
                                       </table>
                                    <?php } ?>
                                    <hr>

                                    <?php echo "<a id='tampil' data-toggle='modal' data-target='#modalTampil' href='modal_detail.php?id=" . $row['user_id'] . "'>" ?><button style="margin-left: 115px auto"class="btn btn-success">Detail</button></a>

                                    <div class="modal" id="modalTampil" tabindex="-1" role="dialog"></div>

                                </div>
                            </div>

                        </div>
                        <?php
                    }
                    ?>
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
    <?php
    }
}?>