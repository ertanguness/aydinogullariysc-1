<?php
permcontrol("cedit");



if($_POST && $_GET["mode"] == "new"){


	$title = $_POST["title"];


	$ekle = $ac->prepare("INSERT INTO cgroups SET
	title = ?,
	statu = ?");
	$ekle->execute(array($title,1));

	header("Location:index.php?p=customer-groups&st=newsuccess");
}

	$id = @$_GET["id"];
	if(@$id && @$_GET["mode"] == "delete" && @$_GET["code"] == "04md177"){
		permcontrol("cdelete");
			$stcontrol = $ac->prepare("SELECT * FROM cgroups WHERE id = ?");
			$stcontrol->execute(array($id));
			$sts = $stcontrol->fetch(PDO::FETCH_ASSOC);
			if(!$sts){
				header("Location: index.php?p=customer-groups&err=true");
				exit;
				die;
			}
			
			$stdel = $ac->prepare("DELETE FROM cgroups WHERE id = ?");
			$stdel->execute(array($id));
			
			header("Location: index.php?p=customer-groups&type=delete&code=0882md25&pid=$pids");

		}

	
?>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
	<?php
	if(@$_GET["st"] == "newsuccess" ){



?>
<div class="alert alert-success" role="alert">
								İşlem başarılı!
							</div>
	<?php
}
	if(@$_GET["type"] == "delete"){
	?>
		<div class="alert alert-success" role="alert">
								<?php echo "#".$_GET["pid"]; ?> no'lu hizmetinize ait bilgiler başarıyla silindi.
							</div>
	<?php
}
	?>
	<div class="clearfix mb-20">
						<div class="pull-left">
							<h5 class="text-blue">Müşteri Grupları</h5>
							
						</div>
						
					</div><form method="POST" action="index.php?p=customer-groups&mode=new&code=38&cc=087s3">
	
	<div class="row">
		<h4>&nbsp;&nbsp;Yeni Müşteri Grubu Oluştur</h4><br><br>

		<div class="col-sm-12 col-md-12">

		
	
			<div class="form-group"> 
				<label><font color="red">(*)</font>Başlık:</label>
				<input name="title" value="" class="form-control" type="text" ><br>
				
			</div><button type="submit" style="float:right;" type="button" class="btn btn-success">Ekle</button><br><br><br>
		</div></form>
<table class="data-table stripe hover "><br>
  <thead>
    <tr>
      <th>#Sıra <br> No</th>
      <th>Grup <br> Başlığı</th>
      <th>Oluşturulma <br> Tarihi</th>
      <th>Müşteri <br> Sayısı</th>
      <th class="datatable-nosort">İşlem <br> Yap</th>
		<?php




		?>
    </tr>
  </thead>
  <tbody> <br><br>
    	<?php
    		$categ1 = $ac->prepare("SELECT * FROM cgroups ORDER BY id ASC");
    		$categ1->execute();
    		$kx = 1;
    		while($ccs = $categ1->fetch(PDO::FETCH_ASSOC)){

    	$sfetch = $ac->prepare("SELECT COUNT(*) FROM customers WHERE grp = ?");
    	$sfetch->execute(array($ccs["id"]));
    	$ss = $sfetch->fetchColumn();

    	?>
    	<tr">
      <td scope="row"><?php echo $kx;?></td>
      <td><?php echo $ccs["title"];?></td>
      <td><?php echo $ccs["regdate"];?></td>
      <td><?php echo $ss; ?></td>
    

      <td>

      	&nbsp;&nbsp; <a href="index.php?p=edit-cgroup&id=<?php echo $ccs["id"];?>"><span class="badge badge-primary">Düzenle</span></a>&nbsp;&nbsp;<a onClick="return confirm('Bu kategori başlığını silmek istediğinize emin misiniz?')" href="index.php?p=customer-groups&mode=delete&code=04md177&md=active&id=<?php echo $ccs["id"];?>"><span class="badge badge-danger">Sil</span></a></td>

    </tr>
<?php 
$kx = $kx+1;
} ?>
  </tbody>
</table>
</div>