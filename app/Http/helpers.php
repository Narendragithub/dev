<?php
function get_array_value(array $array, array $indexes)
{
    if (count($array) == 0 || count($indexes) == 0) {
        return false;
    }

    $index = array_shift($indexes);
    if(!array_key_exists($index, $array)){
        return false;
    }

    $value = $array[$index];
    if (count($indexes) == 0) {
        return $value;
    }

    if(!is_array($value)) {
        return false;
    }

    return get_array_value($value, $indexes);
}
function assetbundlepath($filename){
    //return  $_SERVER['DOCUMENT_ROOT'].'/project_files/'.$filename;
    $filename = str_replace('https://s3-us-west-2.amazonaws.com/cubedots', 'https://d2ywba6r11jsvi.cloudfront.net', $filename);
    return  $filename;
}
function adminurl($str) {
    return url(config('app.adminurl')) . '/' . $str;
}

function checkperms($permissions, $tocheck) {
    $access = false;
    foreach ($permissions as $permission) {

        if ((int) $permission->module_id === (int) $tocheck) {
            $access = true;
            break;
        }
    }
    return $access;
}

function sendemail($toemail,$firstname,$lastname,$template, $additional=array(),$from = null) {
    $settings = App\Settings::find(1);
    $tempdata = array('FIRST_NAME' => $firstname?$firstname:'',
        'LAST_NAME' => $lastname?$lastname:'',
        //'MEMBER_EMAIL'=>$user->email,
        'SITE_TITLE' => $settings->site_title,
        'SITE_URL' => url(),
        'ACTIVATION_LINK' => url(),
        'to_email' =>$toemail,
        'to_name' => $firstname .' '.$lastname,
        'from' =>  'test@dewas.co.in', //$settings->from_email,
        'mailsignature' => $settings->mailsignature);
    $userdata = array_merge($tempdata, $additional);
    if ($settings->smtp_on == 1) {
        $emailsettings = App\Emailsettings::find(1);
        Config::set('mail.driver', 'smtp');
        Config::set('mail.host', $emailsettings->smtp_server);
        Config::set('mail.port', $emailsettings->smtp_port);
        Config::set('mail.encryption', $emailsettings->smtp_type);
        Config::set('mail.username', $emailsettings->smtp_username);
        Config::set('mail.password', $emailsettings->smtp_password);
    }
    if(env('APP_ENV') == 'local'){
        Config::set('mail.pretend', true);
    }
    \Mail::send([], [], function($message) use ($template, $userdata) {
        $message->from($userdata['from']);
        $message->to($userdata['to_email'], $userdata['to_name'])
                ->subject(parse($template->subject, $userdata))
                ->setBody($template->parse($userdata) . parse($userdata['mailsignature'], $userdata), 'text/html');
    });
    
}

function parse($content, $data) {
    $parsed = preg_replace_callback('/\[(.*?)\]/', function ($matches) use ($data) {
        list($shortCode, $index) = $matches;

        if (isset($data[$index])) {
            return $data[$index];
        } else {
            throw new \Exception("Shortcode {$shortCode} not found in template id {$this->id}", 1);
        }
    }, $content);

    return $parsed;
}

function newproject() {
    $data = App\Project::where('view_status',0)->where('is_submitted',1)->count();
    return $data;
}

function newtickets() {
    $data = App\Tickets::where('status',0)->count();
    return $data;
}

function newcustomer() {
    $data = App\Tickets::where('status',0)->count();
    return $data;
}


function safe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
    return $data;
}

function safe_b64decode($string) {
    $data = str_replace(array('-', '_'), array('+', '/'), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function encrypt($value, $skey = "s7GR03Ld55p1k00") {
    if (!$value) {
        return false;
    }
    $text = $value;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey."\0", $text, MCRYPT_MODE_ECB, $iv);
    return trim(safe_b64encode($crypttext));
}

function decrypt($value, $skey = "s7GR03Ld55p1k00") {
    if (!$value) {
        return false;
    }
    $crypttext = safe_b64decode($value);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey."\0", $crypttext, MCRYPT_MODE_ECB, $iv);
    $pos = strpos($decrypttext, '.');
    //return substr($decrypttext, 0, $pos);
    return $decrypttext;
}

function generateLogString($string,$array){
    $fields=array();
    foreach($array as $key=>$value){
        $fields[]=$key;
    }
    return $string.implode(',', $fields);
}
function compressImage($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

    //save file
    imagejpeg($image, $destination_url, $quality);

    //return destination file
    return $destination_url;
}
function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

function beliefmedia_recurse_copy($src, $dst) 
{
    /* Returns false if src doesn't exist */
    $dir = @opendir($src);
    /* Make destination directory. False on failure */
    if(!file_exists($dst)) @mkdir($dst);
    /* Recursively copy */
    while(false !== ($file = readdir($dir))) 
    {
        if(($file != '.') && ($file != '..')) 
        {
          if(is_dir($src . '/' . $file)) beliefmedia_recurse_copy($src . '/' . $file, $dst . '/' . $file); 
          else copy($src . '/' . $file, $dst . '/' . $file);
        }

    }

    closedir($dir); 
}


/*function compress_image($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
    }*/