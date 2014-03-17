<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('script_tag'))
{
    function script_tag($script_file = '')
    {
            if ($script_file )
              $script = '<script type="text/javascript" type="screen" src="'.base_url().$script_file.'"></script>';

            return $script;
    }
}

function pre($array = '',$msg="" )
{
    echo "<pre> $msg "; print_r($array); echo "</pre>";
}


function app_file_extension($filename=""){
    return strtolower(substr(strrchr($filename, '.'), 1));
}

function app_galeria_imagen($path="",$img="",$param=""){
    $extension = strtolower(app_file_extension($img));
    $imginfo = getimagesize($path.$img);
    $width = ( (int)$imginfo[0] > 70)? 70 : (int)$imginfo[0]; 
    $border = (isset($param['style']['border']))? $param['style']['border'] :'border:solid 1px #d0d0d0;'; 
    $str_imagen = '';
    if(in_array($extension, array('jpg','jpeg','jpe','png','gif'))){
        $str_imagen ='<div style="float:left; width:73px; padding:3px; '.$border.' margin-top: 3px; margin-right: 3px; text-align: center; overflow: hidden"><a href="###" rel="'.$path.$img.'" onclick="img_selected(this.rel)" title="'.$img.'"><img src="'.$path.$img.'" width="'.$width.'" ></a><div style="font-size: 10px; height:25px; border-top:solid 0px #d0d0d0; overflow: hidden;">'.$img.'</div></div>';
    }

    return $str_imagen;
}

function app_format_size($size) {
    $mod = 1024;
    $units = explode(' ','B KB MB GB TB PB');
    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }
    return round($size, 2) . ' ' . $units[$i];
}
