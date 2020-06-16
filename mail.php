<?php
// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
//if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
 
  // detect & prevent header injections
//  $test = "/(content-type|bcc:|cc:|to:)/i";
 // foreach ( $_POST as $key => $val ) {
   // if ( preg_match( $test, $val ) ) {
    //  exit;
  //  }
 // }

//$headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    //'Reply-To: ' . $_POST["email"] . "\r\n" .
  //  'X-Mailer: PHP/' . phpversion();

 // mail( "jackkao8752@gmail.com", $_POST['subject'], $_POST['message'], $headers );
 
//}
　$to="jackkao8752@gmail.com";
　$subject=$_POST['subject'];
　$message=$_POST['message'];
　$headers = "From: ".$_POST['email'] . "\r\n" .
　　
  if(mail($to,$subject,$message,$headers)):
   echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
  else:
   echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
  endif;
?>