<?php
function activate_tablesanddata()
{
// create custompages
	require("activation/custompages.php");
  pw_db_cp();
	pw_data_cp();
	 
// create dateentries
	require("activation/dateentries.php");
  pw_db_de();
	pw_data_de();
	 
// create nicenames
	require("activation/nicenames.php");
  pw_db_nn();
	pw_data_nn();

// create optionsaccessories
	require("activation/optionsaccessories.php");
  pw_db_oa();
	pw_data_oa();
	 
// create optionscovers
	require("activation/optionscovers.php");
  pw_db_oc();
	pw_data_oc();

// create pricescustom
	require("activation/pricescustom.php");
  pw_db_pc();
	pw_data_pc();

// create pricesstandard
	require("activation/pricesstandard.php");
  pw_db_ps();
	pw_data_ps();

// create qytbreakcustom
	require("activation/qtybreakcustom.php");
  pw_db_qbc();
	pw_data_qbc();

// create qytbreakstd
	require("activation/qtybreakstd.php");
  pw_db_qbs();
	pw_data_qbs();

// create quotes
	require("activation/quotes.php");
  pw_db_quotes();
	// no data added to the quotes db
	 
// create stampingcustom
	require("activation/stampingcustom.php");
  pw_db_sc();
	pw_data_sc();

}

function activate_customsettings()
{
// create options
	require("activation/settings.php");
  pw_settings_setup();
}

?>