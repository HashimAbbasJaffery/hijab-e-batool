<?php 



if(!function_exists("getAvatar")) {
    function getAvatar($width = 160, $height = 160) {
        $src = "https://placehold.co/" . $width . "x" . $height;
        if(auth()->user()->picture) {
            $src = "/uploads/" . auth()->user()->picture;
        }
        return $src;
    }
}