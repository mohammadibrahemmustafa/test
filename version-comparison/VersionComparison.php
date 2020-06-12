<?php
namespace App;

class VersionComparison
{

    public function compare($version){
        $numbers = explode('.', $version);
        $firstNumber =(int)$numbers[0];
        if ($firstNumber>1){
            return 'UTC';
        }
        if ($firstNumber<1){
            return 'Europe/Berlin';
        }
        if ($firstNumber == 1){

            $secondNumber =(int)$numbers[1];
            if ($secondNumber > 0){
                return 'UTC';
            }
            if ($secondNumber < 0){
                return 'Europe/Berlin';
            }
            if ($secondNumber == 0){
                $thirdNumberString = $numbers[2];
                $exist =strpos($thirdNumberString,'+');
                if ($exist !== false){
                    $thirdNumber=(int) substr($thirdNumberString,0,$exist);
                    if ($thirdNumber > 17){
                        return 'UTC';
                    }
                    if ($thirdNumber < 17){
                        return 'Europe/Berlin';
                    }
                    if ($thirdNumber == 17){
                        $fourthNumber=(int) substr($thirdNumberString,$exist);
                        if ($fourthNumber > 60){
                            return 'UTC';
                        }
                        if ($fourthNumber <= 60){
                            return 'Europe/Berlin';
                        }
                    }
                }else{
                    $thirdNumber=(int) $thirdNumberString;
                    if ($thirdNumber > 17){
                        return 'UTC';
                    }
                    if ($thirdNumber <= 17){
                        return 'Europe/Berlin';
                    }
                }

            }
        }
    }
}