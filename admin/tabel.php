<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['id_login']) == 0) {
    header('location:login.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

            
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>ADMIN | ORCOIS</title>
            <link rel="shortcut icon" href="img/orcois_logo.png">

            <!-- Custom fonts for this template-->
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

            <!-- Page level plugin CSS-->
            <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="css/sb-admin.css" rel="stylesheet">

        </head>

        <body id="page-top">

            <?php include('includes/navbar.php'); ?>

            <div id="wrapper">

                <!-- Sidebar -->
                <?php include('includes/sidebar.php'); ?>

                <div id="content-wrapper">

                    <div class="container-fluid">

                        <!-- Breadcrumbs-->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Tabel User</li>
                        </ol>
<!--                        <form method="GET">
                                <input type="text" placeholder="Type the name here" name="search">&nbsp;
                                <input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
                        </form>-->
                        <!-- DataTables Example -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                <?php
                                $halaman = 20;
                                $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                                $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                                $result = mysqli_query($con, "SELECT * FROM user where aktif=1");
                                $total = mysqli_num_rows($result);
                                $pages = ceil($total / $halaman);
                                $current=$_GET["halaman"];
                                ?>
                                Data User
                                
                            </div>
                            <div class="card-body">
                                <!--<div>-->
                                <!--    <form method="get">-->
                                <!--        <input type="text" name="cari" placeholder="Cari Berdasarkan Nama">-->
	                               <!--     <input type="submit" value="Cari">-->
	                               <!-- </form>-->
                                <!--</div>-->
                                <div class="table-responsive">
                                    <?php
                                if($current == 0 OR $current == 1){
                                ?>
                                    <div class="page-item active"><b>Halaman 1</b></div>
                                <?php
                                }else{?>
                                    <div class="page-item active"><b>Halaman <?php echo $current; ?></b></div>
                                <?php
                                }?>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No. Telp</th>
                                                <th>Status Pekerjaan</th>
                                                <th>Role</th>
                                                <th>Skills & Deskripsi</th>
                                                <th>Blokir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // if (isset($_GET['cari'])) {
                                                // $cari = $_GET['cari'];
                                                // $sql = "select * from user where aktif=1 and nama like '%".$name."%' LIMIT $mulai, $halaman";
                                                // $query = mysqli_query($con, $sql);
                                            // }else{
                                                $query = mysqli_query($con, "select * from user where aktif=1 ORDER BY (CONVERT(substring(user_id,4),unsigned)) ASC LIMIT $mulai, $halaman");
                                            // }
                                            $no = $mulai + 1;

                                            while ($row = mysqli_fetch_assoc($query)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['user_id']; ?></td>
                                                    <td>
                                                        <?php if ($row['foto'] == null) { ?>
                                                            <img src="img/blank-profile-picture-973461_640.png" height="50" width="50">
                                                        <?php } else { ?>
                                                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" height="50" width="50"/>'; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['telepon']; ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    <td><?php echo $row['role']; ?></td>
                                                    <td><?php echo "<a id='tampil' data-toggle='modal' data-target='#modalTampil' href='modal_detail.php?id=" . $row['user_id'] . "'>" ?><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true" title="Lihat Skill User Ini"></i></button></a></td>
                                                    <td>
                                                        <a href="user_block.php?sid=<?php echo $row['user_id']; ?>" onclick="return confirm('Apakah Anda Ingin Memblokir User Ini ?')"><button class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true" title="Blokir User Ini"></i></button></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <ul class="pagination">
                                    <?php 
                                    for ($i = 1; $i <= $pages; $i++) {?>
                                    <li class="page-item">
                                        <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                    <?php
                                    } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="modal" id="modalTampil" tabindex="-1" role="dialog"></div>
                    </div>
                    <!-- /.container-fluid -->

                    <!-- Sticky Footer -->
                    <?php include('includes/footer.php'); ?>

                </div>
                <!-- /.content-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

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

            <!-- Page level plugin JavaScript-->
          <!--  <script src="vendor/chart.js/Chart.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.js"></script>-->

            <!-- Custom scripts for all pages-->
            <!--<script src="js/sb-admin.min.js"></script>-->

            <!-- Demo scripts for this page-->
          <!--  <script src="js/demo/datatables-demo.js"></script>
            <script src="js/demo/chart-area-demo.js"></script>-->

        </body>

    </html>
    <?php
}
?>