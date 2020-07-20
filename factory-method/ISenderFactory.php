<?php
/**
 * Created by PhpStorm.
 * User: Bcc
 * Date: 7/20/2020.0020
 * Time: 10:42 م
 */

namespace Factory;


interface ISenderFactory
{
    public function create($senderType) : Sender;
}