<?php

function con() {$c1=mysqli_connect("localhost","root","","Covid");
    if($c1){
        echo"connection success";
    }
    else{
        die("connection failed ".mysqli_connect_error() );
    }
}

function OTP() {
    $n=8; 
   $generator = "1357902468"; 
   $result = ""; 
   for ($i = 1; $i <= $n; $i++) { 
       $result .= substr($generator, (rand()%(strlen($generator))), 1); 
   }
   return $result; 
}


function verify($to){
    //$to = "gauravdatt2000@gmail.com";
    $mm=OTP();
    $con=mysqli_connect("localhost","root","","login");
    if($con){
        $qr="UPDATE persons
         SET otp='".$mm."' WHERE email='".$to."' limit 1";
         if(mysqli_query($con,$qr)){ 
    $subject = "verfication otp";
    $message = "<b>This is automated verfication.</b>";
    $message .= "<h1>Verification OTP- ".$mm."</h1>";
    $header = "From:abc@somedomain.com \r\n";
    $header .= "Cc:afgh@somedomain.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail ($to,$subject,$message,$header);

    if( $retval) {
       echo "Message sent successfully , otp is send on your mail id...";
    }else {
       echo "Message could not be sent...";
    }


        } 
    mysqli_close($con);
    }
    else{
        echo"database not connected";
    }
    return $mm;
}

function thanks($to){
    
    $subject = "Thanks for supporting our community ";
    $message = "<h4>We are  warmed by your suggestion and thanks for suppoting our commumity"."</h4>\n";
    $message .= "<h4>It means a lot !</h4>\n";
    $message .= "<h2>#FIGHT_AGAINST_COVID19"."</h2>";
    $header = "From:Covid_care_community@somedomain.com \r\n";
    $header .= "Cc:afgh@somedomain.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail ($to,$subject,$message,$header);
    if($retval){
        return 1;
    }
    else{
        return 0;
    }

}
// <a href="https://www.w3schools.com">Visit W3Schools.com!</a>
function thanksdo($to,$rec){    
    $subject = "Thanks for Donating ";
    $message = "<h4>Thank for your warm support  and donation"."</h4>\n";
    $message .= "<h4>It means a lot !</h4>\n";
    $message .= "<h2>this is your Receipt"."</h2>";
    $message .= "<a href='$rec'>Recipt"."</a>"; 
    $header = "From:Covid_care_community@somedomain.com \r\n";
    $header .= "Cc:afgh@somedomain.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail ($to,$subject,$message,$header);
    if($retval){
        ?>
        <script>
        window.alert("Thanks for your donation ,receipt has been send to your email");
        </script>
        <?php
    }

}




function vol() {
    $con=mysqli_connect("localhost","root","","Covid");
    if($con){
        if(isset($_POST['submit'])){

            $username = $_POST['username'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $msg = $_POST['msg'];
            $qr="INSERT INTO volunteer (username , email , mobile , suggestion) VALUES ('$username','$email','$mobile','$msg');" ;
            if(mysqli_query($con,$qr)){

                if(thanks($email)){
                ?>
                <script>
                    window.alert("Thank for becoming a volunteer");
                </script>
                
                <?php
                }
            }
            mysqli_close($con);
        }

    }
    else{
        echo "Error: " . $qr . "<br>" . mysqli_error($con);
        die("connection failed ".mysqli_connect_error() );
    }
}



?>