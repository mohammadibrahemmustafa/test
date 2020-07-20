<?php
/**
 * Created by PhpStorm.
 * User: Bcc
 * Date: 7/20/2020.0020
 * Time: 11:01 م
 */


use Factory\SenderFactory;
use Factory\EmailSender;
use Factory\SMSSender;

class SenderFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testEmail(){
        $factory = new SenderFactory();
        $emailSender = $factory->create('email');

        $this->assertInstanceOf(EmailSender::class,$emailSender);
    }
    public function testSms(){
        $factory = new SenderFactory();
        $smsSender = $factory->create('sms');

        $this->assertInstanceOf(SMSSender::class,$smsSender);
    }
}
