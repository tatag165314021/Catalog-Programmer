<?php
include('includes/config.php');
$id = $_GET['id'];
?>
<?php
$sql = "select * from user where user_id='" . $id . "'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $email = $row['email'];
    $nama = $row['nama'];
    $telepon = $row['telepon'];
    $status = $row['status'];
    $role = $row['role'];
    $foto = $row['foto'];
    ?>
    <div class="modal-dialog" >

        <div class="modal-content">
            <div class="align-self-center">
                <br>
                <h6 style="font-size: 25px"><b>Lihat Detail</b></h6>
            </div>
            <div class="modal-header">

            </div>        
            <div class="modal-body align-self-center">
                <div class="row align-items-center" style="margin-left: 25px">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php if ($foto == null) { ?>
                                <div class="card-img-block">
                                    <img class="align-self-center" src="assets/img/blank-profile-picture-973461_640.png" alt="Card image cap" height="200" width="200">
                                </div>
                            <?php } else { ?>
                                <div class="card-img-block align-self-center">
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($foto) . '" alt="Card image cap" height="200" width="200"/>'; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="control-label"><b>Nama :</b></label>
                            <label class="control-label"><?= $nama ?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Status Pekerjaan :</label>
                            <label class="control-label"><?= $status ?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Role (Bidang Keahlian) :</label>
                            <label class="control-label"><?= $role ?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="control-label"><b>List Skill(Kemampuan) :</b></label>                   
                </div>
                <div class="row" style="margin-top:5px; margin-bottom:5px; height:1px; width:300px; border-top:1px solid gray;"></div>
                <?php
                $sqlSkill = "select skill,bintang from skills where user_id = '$id'";
                $querySkill = mysqli_query($con, $sqlSkill);
                while ($rowSkill = mysqli_fetch_assoc($querySkill)) {
                    ?>
                    <div class="row">
                        <div class="col-ms-8">
                            <div class="form-group">
                                <table class="table table-bordered table-striped table-sm">
                            <tr>
                            <td>
                                <label class="control-label"><?= $rowSkill['skill'];?></label>
                            </td> 
                            <td align=Right>
                                <?php if ($rowSkill['bintang'] == 5) { ?>
                                    <label class="control-label" align=Right>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span><br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 4) { ?>
                                    <label class="control-label">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 3) { ?>
                                    <label class="control-label">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 2) { ?>
                                    <label class="control-label">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 1) { ?>
                                    <label class="control-label">
                                        <span class="fa fa-star checked"></span>
                                        <br>
                                    </label>
                                <?php } ?>
                                </td> 
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="modal-footer ">

            </div>
            <div class="align-self-center">
                <button  style="font-size: 15px" data-dismiss="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Kembali</button>              
                <br>
                <br>
            </div>
        </div>

    </div>
    <?php
}?>