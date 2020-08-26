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
    $deskripsi = $row['deskripsi'];
    ?>
    <div class="modal-dialog" >

        <div class="modal-content">
            <div class="modal-header align-self-center">
                <h6 style="font-size: 25px"><b>Lihat User</b></h6>
            </div>
            <div class="modal-body align-self-center">
                <div class="row">
                    <table>
                        <tr>
                            <td>
                                <label class="control-label"><b>Nama&nbsp;&nbsp;:</b></label> 
                            </td>
                            <td>
                                <label class="control-label"><?= $nama ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <label class="control-label" data-toggle="tooltip" title="Deskripsi Singkat"><b>Desc&nbsp;&nbsp;&nbsp;&nbsp;:</b></label>
                            </td>
                            <td>
                                 <textarea style="width:238px;" class="control-label" disabled><?= $deskripsi ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row" style="margin-top:5px; margin-bottom:5px; height:1px; width:100%; border-top:1px solid gray;"></div>
                <?php
                $sqlSkill = "select skill,bintang from skills where user_id = '$id'";
                $querySkill = mysqli_query($con, $sqlSkill);
                while ($rowSkill = mysqli_fetch_assoc($querySkill)) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="control-label"><?= $rowSkill['skill']; ?></label>
                                <label class="control-label"><span></span></label>
                                <?php if ($rowSkill['bintang'] == 5) { ?>
                                    <label class="control-label" align=Right>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span><br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 4) { ?>
                                    <label class="control-label" align=Right>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 3) { ?>
                                    <label class="control-label" align=Right>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 2) { ?>
                                    <label class="control-label" align=Right>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <br>
                                    </label>
                                <?php } elseif ($rowSkill['bintang'] == 1) { ?>
                                    <label class="control-label" align=Right>
                                        <span class="fa fa-star checked" style="color: goldenrod"></span>
                                        <br>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php ?>
                <?php } ?>
            </div>
            
            
            <div class="modal-footer">
                <button  style="margin-right: 180px; font-size: 15px" data-dismiss="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Kembali</button>
            </div>
        </div>

    </div>
    <?php
}?>