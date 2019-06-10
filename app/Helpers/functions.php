<?php

function var_log($val , $mark = null){
    if($mark)Log::debug($mark . ' >>>>>>');
    Log::debug(var_export($val , true));
    return true;
}
