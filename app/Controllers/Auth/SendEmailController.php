<?php

namespace Matcha\Controllers\Auth;


class SendEmailController
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function sendEmail($email, $username, $uniqid)
    {
        $confirmPage = 'http://'.$_SERVER['HTTP_HOST'] . "/activate";
        $from_name = "[Matcha] ";
        $from_mail = "<noreply@matcha.com>";
        $mail_subject = "test mail fun";
        $tokeNameKey = trim($this->container->csrf->getTokenNameKey());
        $tokenName = trim($this->container->csrf->getTokenName());
        $tokenValueKey = trim($this->container->csrf->getTokenValueKey());
        $tokenValue = trim($this->container->csrf->getTokenValue());
        $mail_message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body style=\"background: linear-gradient(to bottom right,#84afff 44%,#e4b0ff 100%);padding: 40px;color: white;min-height: 430px;\">
                            <h2>Hello $username and Welcome to Matcha</h2>
                            <h3>Just click the button below to activate your account</h3>
                            <form method=\"post\" action=\"$confirmPage\">
                                <input type=\"hidden\" name=\"uniq_id\" value=\"$uniqid\">
                                <input type=\"hidden\" name=\"email\" value=\"$email\">
                                <button type=\"submit\">Confirm</button>
                                <input type=\"hidden\" name=\"$tokeNameKey\" value=\"$tokenName\">
                                <input type=\"hidden\" name=\"$tokenValueKey\" value=\"$tokenValue\">
                            </form>
                        </body>
                        </html>
                        ";
        $encoding = "utf-8";

        // Set preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );

        // Set mail header
        $header = "Content-type: text/html; charset=".$encoding." \r\n";
        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

        // Send mail
        mail($email, $mail_subject, $mail_message, $header);
    }

    public function sendNewPasswordEmail($email, $username, $password)
    {
        // $confirmPage = 'http://'.$_SERVER['HTTP_HOST'] . "/activate";
        $from_name = "[Matcha 42] ";
        $from_mail = "<noreply@matcha42.com>";
        $mail_subject = "[Matcha 42] Please reset your password";
        $mail_message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body style=\"background: linear-gradient(to bottom right,#84afff 44%,#e4b0ff 100%);padding: 40px;color: white;min-height: 430px;\">
                            <h3>We heard that you lost your Matcha password. Sorry about that!</h3>
                            <p>But don't worry! Here is you new password that was randomly generated.</p>
                            <p>------------------------</p>
                            <p>Email: ".$email."</p>
                            <p>Password: ".$password."</p>
                            <p>------------------------</p>
                            </br>
                            <p>Thanks,</p>
                            <p>your friends at Matcha 42.</p>
                        </body>
                        </html>
                        ";
        $encoding = "utf-8";

        // Set preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );

        // Set mail header
        $header = "Content-type: text/html; charset=".$encoding." \r\n";
        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

        // Send mail
        mail($email, $mail_subject, $mail_message, $header);
    }
}