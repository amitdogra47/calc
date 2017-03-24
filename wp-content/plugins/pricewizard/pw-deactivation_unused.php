<?php


// drop all databases
require("activation/deactivatetables.php");
register_deactivation_hook( __FILE__, 'deactivatetables' );
function deactivatetables()
{
pw_deactivate_cp();
pw_deactivate_de();
pw_deactivate_nn();
pw_deactivate_oa();
pw_deactivate_oc();
pw_deactivate_pc();
pw_deactivate_ps();
pw_deactivate_qbc();
pw_deactivate_qbs();
pw_deactivate_quotes();
pw_deactivate_sc();
}

?>