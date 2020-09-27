<?php
if(isset($_POST['name'])){
	$font=realpath("BRUSHSCI.TTF");
	$font2=realpath("AGENCYR.TTF");
	$image=imagecreatefromjpeg("certificate.jpg");
	$color=imagecolorallocate($image,19,21,22);
	imagettftext($image,50,0,365,420,$color,$font,$_POST['name']);
	$date="6th may 2020";
	imagettftext($image,20,0,450,595,$color,$font2,$date);
	$file=time();
	$file_path="certificate/".$file.".jpg";
	imagejpeg($image,$file_path);
	imagedestroy($image);

	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="laxmipress95@gmail.com";
	$mail->Password="Sanjay@3324";
	$mail->setFrom("laxmipress95@gmail.com");
	$mail->addAddress($_POST['email']);
	$mail->isHTML(true);
	$mail->Subject="Certificate Generated";
	$mail->Body="Certificate Generated";
	$mail->addAttachment($file_path);
	$mail->SMTPOptions=array("ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
		"allow_self_signed"=>false,
	));
	if($mail->send()){
		header("Location: http://localhost/dynamicPHPCertificate2/");
	}else{
		echo $mail->ErrorInfo;
	}
}
?>
