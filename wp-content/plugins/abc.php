<?php

register_activation_hook(__FILE__, 'si_activation');
register_deactivation_hook(__FILE__, 'si_deactivation');
register_uninstall_hook(__FILE__, 'si_delete');


function si_activation(){

}

function si_deactivation(){
    
}

function si_delete(){
    
}

?>