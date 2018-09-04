<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/3/18
 * Time: 5:30 PM
 */

namespace Matcha\Controllers\Auth;

use Matcha\Models\User;

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
        $from_name = "Camagru Co";
        $from_mail = "olegzharko@gmail.com";
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
                            <h2>Hello $username and Welcome to Camagru World</h2>
                            <form method=\"post\" action=\"$confirmPage\">
                                <input type=\"hidden\" name=\"uniqid\" value=\"$uniqid\">
                                <input type=\"hidden\" name=\"email\" value=\"$email\">
                                <button>Confirm</button>
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
}
