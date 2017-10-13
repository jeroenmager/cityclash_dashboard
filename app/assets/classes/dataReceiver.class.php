<?php

class dataReceiver {
    
    function decode_json($url){
        $json = file_get_contents($url);
        return json_decode($json, true);
    }
    
    function set_anwers(){
        
    }
    
    
}
