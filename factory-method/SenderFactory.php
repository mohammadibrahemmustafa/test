<?php
/**
 * Created by PhpStorm.
 * User: Bcc
 * Date: 7/20/2020.0020
 * Time: 10:58 م
 */

namespace Factory;


class SenderFactory implements ISenderFactory
{

    public function create($senderType) : Sender
    {
        if ($senderType == 'sms'){
            return new SMSSender();
        }else{
            return new EmailSender();
        }
    }
}