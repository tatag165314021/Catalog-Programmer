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
                               <label class="control-label" data-toggle="tooltip" title="Status pekerjaan"><b>Status&nbsp;:</b></label>
                            </td>
                            <td>
                                 <label class="control-label"><?= $status ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <label class="control-label" data-toggle="tooltip" title="Bidang keahlian"><b>Role&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></label>
                            </td>
                            <td>
                                 <label class="control-label"><?= $role ?></label>
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
                <br>
                <div class="row">
                    <label class="control-label" data-toggle="tooltip" title="Keahlian spesifik"><b>List Skills :</b></label>                   
                </div>
                <div class="row" style="margin-top:5px; margin-bottom:5px; height:1px; width:300px; border-top:1px solid gray;"></div>
                <?php
                $sqlSkill = "select skill,bintang from skills where user_id = '$id'";
                $querySkill = mysqli_query($con, $sqlSkill);
                while ($rowSkill = mysqli_fetch_assoc($querySkill)) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                               <table style="width:300px;" class="table table-bordered table-striped table-sm">
                            <tr>
                            <td>
                                <label class="control-label"><?= $rowSkill['skill'];?></label>
                            </td> 
                            
                            <td Align=Right>
                                <div >
                                <?php if ($rowSkill['bintang'] == 5) { ?>
                                    <!--<label class="control-label">-->
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span><br>
                                    <!--</label>-->
                                <?php } elseif ($rowSkill['bintang'] == 4) { ?>
                                    <!--<label class="control-label">-->
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                       
                                        <br>
                                    <!--</label>-->
                                <?php } elseif ($rowSkill['bintang'] == 3) { ?>
                                    <!--<label class="control-label">-->
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        
                                        <br>
                                    <!--</label>-->
                                <?php } elseif ($rowSkill['bintang'] == 2) { ?>
                                    <!--<label class="control-label">-->
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                   
                                        <br>
                                    <!--</label>-->
                                <?php } elseif ($rowSkill['bintang'] == 1) { ?>
                                    <!--<label class="control-label">-->
                                        <span class="fa fa-star checked"></span>
                                        <br>
                                    <!--</label>-->
                                <?php } ?>
                                </div>
                                </td> 
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php ?>
                <?php } ?>
            </div>
            
            <!--<div class="align-self-center">-->
            <!--    <center>-->
            <!--    <p>Jika Ingin Menggunakan Jasa User Ini.<br> Silahkan Hubungi Admin Orcois Lewat WhatsApp <i class="fa fa-whatsapp"></i></p>-->
            <!--    <a href="https://wa.me/6285725898422"><button style="font-size: 15px" class="btn btn-success">Hire <i class="fa fa-whatsapp"></i></button></a>-->
            <!--    </center>-->
            <!--    <br>-->
            <!--</div>-->
            <div class="modal-footer ">

            </div>

            <div class="align-self-center">
                <p>Jika Ingin Menggunakan Jasa User Ini.<br> Silahkan Hubungi Admin Orcois Lewat WhatsApp <i class="fa fa-whatsapp"></i></p>
                <a href="https://wa.me/6285725898422"><button style="font-size: 15px" class="btn btn-success">Minta Kontak User &nbsp; <i class="fa fa-whatsapp"></i></button></a>
                <button  style="font-size: 15px" data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span>Kembali</button>              
                <br>
                <br>
            </div>
        </div>

    </div>
    <?php
}?>