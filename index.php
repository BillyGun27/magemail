<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mailtype = $_POST["mailtype"];
$subject = $_POST["subject"];
$body= $_POST["body"];
$to = $_POST["to"];

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
//$mail->Host = gethostbyname('smtp.gmail.com');
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
//$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';
$mail->Host = 'tls://smtp.gmail.com:587';
$mail->SMTPOptions = array(
   'ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true
    )
);
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "mage.autosend@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "mageCE0721";

$mail->setFrom('mage.ce.its@gmail.com', $mailtype);
//Set an alternative reply-to address
$mail->addReplyTo('mage.ce.its@gmail.com', 'Mage Admin');
//Set who the message is to be sent to
$mail->addAddress($to, 'Peserta');

$mail->AddEmbeddedImage('img/www.png',1000,'www.png');
$mail->AddEmbeddedImage('img/fb.png',1001,'fb.png.jpg');
$mail->AddEmbeddedImage('img/inst.png',1002,'inst.png');
$mail->AddEmbeddedImage('img/line.png',1003,'line.png');
$mail->AddEmbeddedImage('img/twit.png',1004,'twit.png');
$mail->AddEmbeddedImage('img/ytube.png',1005,'ytube.png');


 //Content
 $mail->isHTML(true);                                  // Set email format to HTML
 $mail->Subject = $subject;
 $mail->Body    = "<div>".$body."</div>".
 "<br><div>Regards,<br>Panitia MAGE 2018<br>".
 "--<h4 style='color:gray;'>Multimedia and Game Event 2018</h4>
 <h4 style='color:orange;'>\"Exploring Digital Technology for Indonesian Society\"</h4>
 Departemen Teknik Komputer, Fakultas Teknologi Elektro<br>
 Institut Teknologi Sepuluh Nopember, Surabaya</div><br>".
 "<a href=\"mage.telematics.its.ac.id/\"><img src='cid:1000' alt='www'></a> ".
 "<a href=\"www.facebook.com/mageits\"><img src='cid:1001' alt='FB'></a> ".
 "<a href=\"www.instagram.com/mage_its/\"><img src='cid:1002' alt='Instagram'></a> ".
 "<a href=\"line.me/R/ti/p/%40rio5948f\"><img src='cid:1003' alt='Line'></a> ".
 "<a href=\"twitter.com/mage_its\"><img src='cid:1004' alt='Twitter'></a> ".
 "<a href=\"www.youtube.com/channel/UCO1SuldERZu0jgBBDzzOkoQ\"><img src='cid:1005' alt='Youtube'></a> ";
 
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
/*function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}*/