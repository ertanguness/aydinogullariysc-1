 <?php

 	function set($vars){
 		global $ac;

	$setque = $ac->prepare("SELECT * FROM settings WHERE var = ?");
	$setque->execute(array($vars));
	$data = $setque->fetch(PDO::FETCH_ASSOC);

	return $data["val"];

 	}
	
	function sesset($vars){
		$sid = $_SESSION["lid"];
 	global $ac;

		$setques = $ac->prepare("SELECT * FROM users WHERE id = ?");
		$setques->execute(array($sid));
		$datas = $setques->fetch(PDO::FETCH_ASSOC);

		return $datas[$vars];

 	}
	
	function pfail(){
		header("Location: logout.php?pfailed=true");
		exit;
	}

	function sadmin(){
		if(sesset("id") == 1){
			return true;
		}else{
			pfail();
		}
	}

	function uset($varsx,$tit){

 	global $ac;

		$setquesx = $ac->prepare("SELECT * FROM users WHERE id = ?");
		$setquesx->execute(array($varsx));
		$dataxc = $setquesx->fetch(PDO::FETCH_ASSOC);

		return $dataxc[$tit];

 	}
	

	function permd(){
		$sid = sesset("perm");
 	global $ac;

		$setques = $ac->prepare("SELECT * FROM perms WHERE id = ?");
		$setques->execute(array($sid));
		$datasdat = $setques->fetch(PDO::FETCH_ASSOC);

		return $datasdat["p_title"];

 	}
	
	function dtf($date1,$date2){
		$dt1 = strtotime($date1);
		$dt2 = strtotime($date2);
		 
		 
		$rep = ($dt2-$dt1)/86400 ;
		return round($rep);
	}

	function title_show($ttlink){
		$ttquery = $ac->prepare("SELECT * FROM pages WHERE p_link = ?");
		$ttquery->execute(array($ttlink));
		$tts = $ttquery->fetch(PDO::FETCH_ASSOC);

		return $tts["p_title"];
	}

	function date_tr($datx){
		
	return $datx;
	}



	function redate_tr($datx){
		
	return $datx;
	}



	function shorted($kelime, $str = 10)
	{
		if (strlen($kelime) > $str)
		{
			if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'..';
			else $kelime = substr($kelime, 0, $str).'..';
		}
		return $kelime;
	}

	// Kullanımı

	function repdate($a){
		explode("-",$a);

		return $a[2]."-".$a[1]."-".$a[0];
	}

	function send_mail($titlek,$text,$sendto){

		include("include/mailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
		$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
		$mail->SMTPSecure = ''; // Normal bağlantı için boş bırakın veya tls yazın, güvenli bağlantı kullanmak için ssl yazın
		$mail->Host = set("mail_host"); // Mail sunucusunun adresi (IP de olabilir)
		$mail->Port = set("mail_port"); // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
		$mail->IsHTML(true);
		$mail->SetLanguage("tr", "phpmailer/language");
		$mail->CharSet  ="utf-8";
		$mail->Username = set("mail_username"); // Gönderici adresiniz (e-posta adresiniz)
		$mail->Password = set("mail_password"); // Mail adresimizin sifresi
		$mail->SetFrom(set("mail_from"), set("mail_name"));
		$mail->AddAddress($sendto); // Gönderilen Alıcı
		$mail->Subject = set("company_name")." - Bilgi"; // Email konu başlığı
		$mail->Body = $text; // Mailin içeriği
		if(!$mail->Send()){
		  return false;
		} else {
		  return true;
		}

	}

		
	function permtrue($var){
		global $ac;
		$pcheck = $ac->prepare("SELECT * FROM perms WHERE id = ?");
		$pcheck->execute(array(sesset("permission")));
		$pd = $pcheck->fetch(PDO::FETCH_ASSOC);
		$pin = @$_GET["p"];
		if($pin){
			if($pd[$var] == "on"){
				return true;
			}else{
				return false;
			}

		}else{
			true;
		}

	}

	function permfalse($var){
		global $ac;
		$pcheck = $ac->prepare("SELECT * FROM perms WHERE id = ?");
		$pcheck->execute(array(sesset("permission")));
		$pd = $pcheck->fetch(PDO::FETCH_ASSOC);
		$pin = @$_GET["p"];
		if($pin){
			if($pd[$var] == "on"){
				return false;
			}else{
				return true;
			}

		}else{
			true;
		}

	}


	function permcontrol($var){
		global $ac;
		$pcheck = $ac->prepare("SELECT * FROM perms WHERE id = ?");
		$pcheck->execute(array(sesset("permission")));
		$pd = $pcheck->fetch(PDO::FETCH_ASSOC);
		$pin = @$_GET["p"];
		if($pin){
			if($pd[$var] == "on"){
				
			}else{
				header("Location:index.php?error=nopermission");
				exit;
				die;
			}

		}else{
			true;
		}
	}

	function showAlert($type,$message) {
		$alertClass = '';
		$firstLetter = '';
	
		if ($type === 'success') {
			$alertClass = 'alert-success';
			$firstLetter="Başarılı!";
		} elseif ($type === 'alert') {
			$alertClass = 'alert-danger';
			$firstLetter="Uyarı";
		} elseif ($type === 'error') {
			$alertClass = 'alert-warning';
			$firstLetter="Uyarı";
		} elseif ($type === 'info') {
			$alertClass = 'alert-info';
			$firstLetter="Bilgi!";
		} 
	
		if ($alertClass && $message) {
			echo '<div class="alert alert-dismissible ' . $alertClass . '">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>' . ucfirst($firstLetter) . '!</strong> ' . $message . '
				  </div>';
		}
	}


	


	
?>