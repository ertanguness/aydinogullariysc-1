<?php
permcontrol("uadd");
if ($_POST) {

	if (!$_POST["uusername"] || !$_POST["uemail"] || !$_POST["uname"] || !$_POST["usurname"] || !$_POST["upassword"]) {
		header("Location: index.php?p=new-user&st=empties");
		exit;
	}

	$uusername = @$_POST["uusername"];
	$utc = @$_POST["utc"];
	$uemail = @$_POST["uemail"];
	$uname = @$_POST["uname"];
	$usurname = @$_POST["usurname"];
	$upassword = md5(md5(md5($_POST["upassword"])));
	$ugsm = @$_POST["ugsm"];
	$ugsm2 = @$_POST["ugsm2"];
	$uaddress = @$_POST["uaddress"];
	$ucity = @$_POST["ucity"];
	$uperm = 1;
	$uprs = @$_POST["permission"];
	$ugiristarihi = @$_POST["ugiristarihi"];
	$udgmtarihi = @$_POST["udgmtarihi"];
	$ucikistarihi = @$_POST["ucikistarihi"];
	$ulinked = @$_POST["ulinked"];

	$regg = $ac->prepare("INSERT INTO users SET
    username = ?,
	tckimlikno = ?,
    password = ?,
    avatar_link = ?,
    email = ?,
    gsm = ?,
	gsm2 = ?,
    city = ?,
    address = ?,
    name = ?,
    surname = ?,
    regdate = ?,
    creativer = ?,
    giristarihi = ?,
    dogumtarihi = ?,
    cikistarihi = ?,
    perm = ?,
    permission = ?,
    statu = ?");

	$regg->execute(array($uusername, $utc, $upassword, "vendors/images/photo2.jpg", $uemail, $ugsm, $ugsm, $ucity, $uaddress, $uname, $usurname, TODAY, sesset("id"), $ugiristarihi, $udgmtarihi, $ucikistarihi, $uperm, $uprs, 1));

	if ($regg) {

		header("Location:index.php?p=all-users&st=newsuccess");
	} else {
		//header("Location: index.php?p=all-customers&st=newerror&code=acmd008");
	}
}

if (@$_GET["st"] == "empties") {
	showAlert('alert', "(*) ile işaretli alanları boş bırakmadan tekrar deneyin.");
}
?>



<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">

		<!-- Default Basic Forms Start -->
		<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
			<div class="clearfix">
				<div class="pull-left">
					<h4 class="text-blue"><?php echo $pdat["p_title"]; ?></h4>
					<p class="mb-30 font-14">Sayfadaki <font color="red">(*)</font> yıldız ile belirtilen alanları boş bırakmayın..<br></p>
				</div>
				<div class="form-group">
					<input type="submit" id="submitbutton" value="Kaydet" class="float-right btn btn-primary">
				</div>
			</div>
			<form enctype="multipart/form-data" id="myform" action="" method="POST">
				<div class="row">

					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font>Kimlik No
							</label>
							<input required type="text" id="utc" name="utc" class="form-control" maxlength="11">
						</div>
					</div>

					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font> Ad:
							</label>
							<input required type="text" name="uname" class="form-control">
						</div>
					</div>
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font> Soyad:
							</label>
							<input required type="text" name="usurname" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font> E-Posta:
							</label>
							<input required name="uemail" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font> Kullanıcı Adı
							</label>
							<input required type="text" name="uusername" class="form-control">
						</div>
					</div>
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font> Parola:
							</label>
							<input required name="upassword" type="text" class="form-control">
						</div>
					</div>

				</div>
				<div class="row">

					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label> Adres:</label>
							<input name="uaddress" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label> Şehir:</label>
							<input name="ucity" type="text" class="form-control">
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label> Telefon:</label>
							<input name="ugsm" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label> Telefon 2:</label>
							<input name="ugsm2" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Doğum Tarihi</label>
							<input name="udgmtarihi" class="form-control date-picker" placeholder="dd.mm.yyyy">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>İşe Başlama Tarihi</label>
							<input name="ugiristarihi" class="form-control date-picker" placeholder="dd.mm.yyyy">
						</div>
					</div>
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>İşten Çıkış Tarihi</label>
							<input name="ucikistarihi" class="form-control date-picker" placeholder="dd.mm.yyyy">
						</div>
					</div>

					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>
								<font color="red">(*)</font> Pozisyon:
							</label>
							<select name="permission" class="custom-select col-12">
								<?php
								$pquery = $ac->prepare("SELECT * FROM perms ");
								$pquery->execute();
								while ($pm = $pquery->fetch(PDO::FETCH_ASSOC)) {
								?>

									<option value="<?php echo $pm["id"]; ?>"><?php echo $pm["p_title"]; ?></option>
								<?php } ?>

							</select>
						</div>
					</div>

				</div><br><br>
			</form>
		</div>


	</div>
</div>
</div>
<!-- Input Validation End -->

</div>
<script>
	document.getElementById("submitbutton").addEventListener("click", function() {
		var form = document.getElementById("myform");
		form.submit();
	})
</script>
<?php include 'include/footer.php'; ?>