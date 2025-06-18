<?php

session_start();
include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$email = $_POST["e"];
$vcode = uniqid();
$year = date("Y");

$rs = DataBase::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");
$num = $rs->num_rows;

if ($num > 0) {
    //User Found

    DataBase::iud("UPDATE `admin` SET `code` = '" . $vcode . "' WHERE `email` = '" . $email . "'");
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'sithuninudara17@gmail.com';                     //SMTP username
        $mail->Password = 'wqbo ktzi ndgx xhkd';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sithuninudara17@gmail.com', 'Vertex Campus');
        $mail->addAddress($email);     //Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset your account password';
        $mail->Body = '<table style="width: 100%; font-family:sans-serif;">
        
      
        <tbody>
  <tr>
    <td align="center" style="padding: 20px; font-family: Arial, sans-serif;">
      <table style="max-width: 600px; width: 100%; border-collapse: collapse;">
        
        <tr>
          <td align="center" style="padding-bottom: 20px;">
            <a href="#" style="font-size: 35px; font-weight: bold; color: black; text-decoration: none;">
              Vertex Campus
            </a>
            <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
          </td>
        </tr>

        <tr>
          <td style="padding: 0 20px;">
            <h1 style="font-size: 25px; line-height: 1.5; font-weight: 600;">Reset Password</h1>
            <p style="margin-bottom: 24px; font-size: 16px;">
              You can use the code below to change your password:
            </p>
            <div style="margin: 20px 0;">
              <h2 style="background-color: #007BFF; color: white; padding: 10px 20px; display: inline-block; border-radius: 4px; text-align:center;">
                ' . $vcode . '
              </h2>
            </div>


            <p style="margin-top: 24px; font-size: 14px; color: #555;">
              If you did not ask to reset your password, you can safely ignore this email.
            </p>
            <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
          </td>
        </tr>

        <tr>
          <td align="center" style="font-size: 14px; color: #777;">
            &copy; ' . $year . ' VertexCampus.lk || All Rights Reserved.
          </td>
        </tr>

      </table>
    </td>
  </tr>
</tbody>

        
           
    </table>';

        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo ("User Not Found");
}


?>