<?php
/**
 * Created by PhpStorm.
 * User: Bcc
 * Date: 7/20/2020.0020
 * Time: 10:39 م
 */

namespace Factory;


class SMSSender implements Sender
{

    public function send($to)
    {
        echo "SMS Sender ". $to;
    }
}