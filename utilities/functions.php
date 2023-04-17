<?php

function checkSessionStart() : void{
    
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
}
