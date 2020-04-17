<?php
class eCareUtility extends Yii
{
    public static function guid(){
        $key = md5(microtime());
        $new_key = '';
        for($i=1; $i <= 25; $i ++ ){
               $new_key .= $key[$i];
               if ( $i%5==0 && $i != 25) $new_key.='-';
        }
        return strtoupper($new_key);
    }

   public function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function formatIn($value){
        if(!$value){return false;}
        $text = json_encode($value,true);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 'ddv21sd5dv56sd51', $text, MCRYPT_MODE_ECB, $iv);
        return trim(eCareUtility::safe_b64encode($crypttext));
    }

    public function formatOut($value){
        if(!$value){return false;}
        $crypttext = eCareUtility::safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 'ddv21sd5dv56sd51', $crypttext, MCRYPT_MODE_ECB, $iv);
        return json_decode(trim($decrypttext),true);
    }

    public function getMAC(){

        if ( preg_match('/linux/i', php_uname() ) ) {
            $cmd = 'ifconfig -a';
        }
        else {
            $cmd = 'ipconfig /all';
        }

        ob_start(); // Turn on output buffering

        system($cmd); //Execute external program to display output
        $mycom=ob_get_contents(); // Capture the output into a variable

        ob_clean(); // Clean (erase) the output buffer

        $findme = 'Physical';
        $pmac = strpos($mycom, $findme); // Find the position of Physical text
        $mac=substr($mycom,($pmac+36),17); // Get Physical Address

        $new_file_name = preg_replace('/\s+|\(|\)|\[|\]|\;|\:/','_',$mac);

        return $new_file_name;
    }

    public function Check(){

        $todays_date = date("d-m-Y");
        $today   = strtotime($todays_date);

        $folder = Yii::getPathOfAlias('application.runtime');
        $file = "$folder/system.runtime";

        if ( !file_exists($file) ){
            return -1;
        }

        $lines   = file_get_contents($file);
        $lic     = eCareUtility::formatOut($lines);
        $lic_obj = json_decode( $lic );

        if ( !$lic_obj ) {
            return 1;
        }
        $ex_date = strtotime($lic_obj->expiry);
        if ($today > $ex_date) {
            return 1;
        } else {
            return 0;
        }
        return 0;
    }

}
