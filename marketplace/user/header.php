
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #CDCCC8;">

    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/orcois_white.png" width="100" height="30" alt="logo perusahaan">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left:10px">
            <ul class="navbar-nav ml-auto">
                <li style="margin-right:50px; margin-top:8px;">
                    <a class="nav-link" href="index.php"><b>Beranda Coder</b>      
                        </a>
                </li>
                <li class="nav-item dropdown">
                    <?php
                    $idSession = $_SESSION['id_login'];
                    $queryNav = mysqli_query($con, "select * from user where user_id='$idSession'");
                    while ($rowNav = mysqli_fetch_array($queryNav)) {
                        ?>  
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if ($rowNav['foto'] == null) { ?>
                                <img src="assets/img/blank-profile-picture-973461_640.png" class="rounded-circle" alt="foto profil" height="40" width="40">
                            <?php } else { ?>
                                <?php echo '<img class="rounded-circle" src="data:image/jpeg;base64,' . base64_encode($rowNav['foto']) . '" alt="foto profil" height="40" width="40"/>'; ?>
                            <?php } ?>
                        </a>
                    <?php } ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="change_profile.php">
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="change_password.php">
                            Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</nav>