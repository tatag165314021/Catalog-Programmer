<?php
include '../config.php';
?>
 
<table border="1">
  <tr>
    <th>No</th>
    <th>Nama</th>                         
  </tr>
  <?php 
  $halaman = 10;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysql_query("SELECT * FROM tb_masjid");
  $total = mysql_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysql_query("select * from tb_masjid LIMIT $mulai, $halaman")or die(mysql_error);
  $no =$mulai+1;
 
 
  while ($data = mysql_fetch_assoc($query)) {
    ?>
    <tr>
      <td><?php echo $no++; ?></td>                  
      <td><?php echo $data['alamat']; ?></td>              
                  
    </tr>
 
    <?php               
  } 
  ?>
  
 
</table>          
 
<div class="">
  <?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
 
  <?php } ?>
 
</div>

<?php//https://www.malasngoding.com/membuat-paging-dengan-php-dan-mysql/?>