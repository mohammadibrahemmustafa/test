<?php
/**
 * Created by PhpStorm.
 * User: Bcc
 * Date: 7/20/2020.0020
 * Time: 10:34 م
 */
namespace Factory;
class EmailSender implements Sender
{

    public function send($to)
    {
        echo "Email Sender ". $to;
    }
}