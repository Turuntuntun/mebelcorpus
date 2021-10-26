<?php
AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    if(defined("ERROR_404") ) {
        LocalRedirect("/404.php", "404 Not Found");
    }
}