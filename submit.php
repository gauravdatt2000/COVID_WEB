<?php
require('config.php');
require('settings.php');
if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data=\Stripe\Charge::create(array(
		"amount"=>1000,
		"currency"=>"inr",
		"description"=>"Covid-Funding",
		"source"=>$token,
	));

	//echo($data['id'];
	$email_id= strval($data['source']['name']);
	$card_id=strval($data['source']['id']);
	$fingerprint_id=strval($data['source']['fingerprint']);
	$rec=strval($data['receipt_url']);
	$money=strval($data['currency']);


	$con=mysqli_connect("localhost","root","","Covid");
	if($con){
		//echo("connected");
             $q1="INSERT INTO donate (email , card_info , card_foot_print , receipt , currency ) VALUES ('$email_id','$card_id','$fingerprint_id','$rec' ,'$money' );" ;
             if(mysqli_query($con,$q1)){
				 thanksdo($email_id ,$rec);
                 }
			 }
			mysqli_close($con);
		}
    else{
        echo "Error: " . $q1 . "<br>" . mysqli_error($con);
        die("connection failed ".mysqli_connect_error() );
	}


?>

<?php 
  
// Redirect browser 
header('location:index.php');
?> 