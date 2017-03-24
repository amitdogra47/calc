<?php
/**
* Establish the call back on form execution
*/

function sd_priceguide_callback() {
	global $wpdb;
	$wpdb->show_errors();
	
	// CHECK NONCE MATCH WITH FORM ; the nonce is in the wp_localize_script in pricewizard.php
	$pwnonce = $_POST['syscontrol'];
	$do_check = check_ajax_referer( 'studentdiaries', 'syscontrol', false);
	// check_ajax_referrer returns
	// False if the nonce is invalid, 
	// 1 if the nonce is valid and generated between 0-12 hours ago, 
	// 2 if the nonce is valid and generated between 12-24 hours ago.
	
	//DEBUG START
	//echo "<p>check ajax referrer - START</p>";
	//echo "<p>the check value is $do_check</p>";
	//if ( $do_check >=1 ){  //DEBUG code
	//	echo "the nonce was verified - $pwnonce"; // DEBUG code
	//}  //DEBUG code
	//else{  //DEBUG code
	//	echo "the nonce was NOT verified - $pwnonce"; // DEBUG code
	//}  //DEBUG code
	//echo "<p>check ajax referrer - END</p>";
	//wp_die(); 
	//DEBUG END
	
		//DEBUG
		//if ( wp_verify_nonce( $pwnonce, 'studentdiaries' ) ){  //DEBUG code
		//echo "the component01 was verified - $pwnonce - Please consult StudentDiaries"; // DEBUG code
		//}  //DEBUG code
		//else{  //DEBUG code
		//echo "the component01 was NOT verified - $pwnonce - Please consult StudentDiaries"; // DEBUG code
		//}  //DEBUG code
		//wp_die();  //DEBUG code
		
	//if ( ! wp_verify_nonce( $pwnonce, 'studentdiaries' ) )	die("Error-Failed to verify security code01. Please contact StudentDiaries");
	
	// test the ajax_referrer and die if invalid
	if ( $do_check <1 ) die("Error-Failed to verify security code-$do_check, please contact StudentDiaries"); 


	
// PARSE THE FORM DATA	
	parse_str($_POST['data'], $data);
		//DEBUG
		//echo "<pre>";print_r($data);echo "</pre>";

		
// DIARY INFO
// STYLE - Custom or Standard
	$diarystyle = $data['style'];
		//DEBUG
		//echo "Diary Info - the Diary style is $diarystyle \r\n";

		
// BINDING Spiral or Book
	$diarybinding = $data['cover_type'];
		//DEBUG
		//echo "Diary Info - the Binding type is $diarybinding \r\n";

		
// SET COVER TYPES - Sprial= Card or PVC//Book=Vinyl with Stamping or Printed
	if (isset($data['spiralcovertype'])){$diarycovertype_spiral = $data['spiralcovertype'];}else{$diarycovertype_spiral="";}
	if (isset($data['bookcovertype'])){$diarycovertype_book = $data['bookcovertype'];}else{$diarycovertype_book="";}
		//DEBUG
		//echo "Diary Info - the Spiral cover type is $diarycovertype_spiral and the Book cover type is $diarycovertype_book  \r\n";

		
// COVER OPTIONS
	if (isset($data['book_custom_front_cover'])){$diaryoptionbookfrontcover = $data['book_custom_front_cover'];}else{$diaryoptionbookfrontcover="no";}
	if (isset($data['book_custom_back_cover'])){$diaryoptionbookbackcover = $data['book_custom_back_cover'];}else{$diaryoptionbookbackcover="no";}
	$diaryoptionsspiralfrontcover = $data['spiralCustomFront'];
	$diaryoptionsspiralbackcover = $data['spiralCustomBack'];
		// DEBUG
		//echo "Diary Info - Cover Options-Book front cover is $diaryoptionbookfrontcover and back cover is $diaryoptionbookbackcover \r\n";
		//echo "Diary Info - Cover Options-Spiral front cover is $diaryoptionsspiralfrontcover and back cover is $diaryoptionsspiralbackcover \r\n";


// SIZE
	$diarysize = $data['diary_size'];
		//DEBUG
		//echo "Diary Info - Diary size is $diarysize \r\n";

		
// PAGE-CONTENT
	$diarypagescustom = $data['cmbIPPagesCustom'];
	$diarypagescustomcolours = $data['custompagecolours'];
	$diarypagesstandard = $data['cmbIPPagesStandard'];
	if (isset($data['dateentries'])){$dateentries = $data['dateentries'];}else{$dateentries="no";}
		//DEBUG
		//echo "Diary Info - Custom style Pages is $diarypagescustom, # of colours is $diarypagescustomcolours. Standard style Pages is $diarypagesstandard \r\n";
		//echo "Diary Info - Standard Date entries is $dateentries \r\n";

		
//ACCESSORIES
	// Accessories - Spiral
	if (isset($data['spiral_coverprotector'])){$diaryspiralcoverprotector = $data['spiral_coverprotector'];}else{$diaryspiralcoverprotector="no";}
	if (isset($data['spiral_ruler'])){$diaryspiralruler = $data['spiral_ruler'];}else{$diaryspiralruler="no";}
	if (isset($data['spiral_refpages'])){$diaryspiralrefpages = $data['spiral_refpages'];}else{$diaryspiralrefpages="no";}
	if (isset($data['spiral_plastic_sleeve'])){$diaryspiralsleeve = $data['spiral_plastic_sleeve'];}else{$diaryspiralsleeve="no";}
	if (isset($data['spiral_plastic_jacket'])){$diaryspiraljacket = $data['spiral_plastic_jacket'];}else{$diaryspiraljacket="no";}
	if (isset($data['spiral_stickers'])){$diaryspiralstickers = $data['spiral_stickers'];}else{$diaryspiralstickers="no";}
		//DEBUG
		//echo "Diary Info - Spiral Accessories  \r	Cover protector is $diaryspiralcoverprotector, Ruler is $diaryspiralruler, Reference Pages is $diaryspiralrefpages, Plastic Sleeve is  $diaryspiralsleeve, Plastic Jaclet is $diaryspiraljacket and Stickers is $diaryspiralstickers  \r\n";
	
	// Accessories - Book
	if (isset($data['book_metal_corners'])){$diarybookcorners = $data['book_metal_corners'];}else{$diarybookcorners="no";}
	if (isset($data['book_gilded_edges'])){$diarybookgilding = $data['book_gilded_edges'];}else{$diarybookgilding="no";}
	if (isset($data['book_refpages'])){$diarybookrefpages = $data['book_refpages'];}else{$diarybookrefpages="no";}
	if (isset($data['book_plastic_sleeve'])){$diarybooksleeve = $data['book_plastic_sleeve'];}else{$diarybooksleeve="no";}
	if (isset($data['book_plastic_jacket'])){$diarybookjacket = $data['book_plastic_jacket'];}else{$diarybookjacket="no";}
	if (isset($data['book_stickers'])){$diarybookstickers = $data['book_stickers'];}else{$diarybookstickers="no";}
		//DEBUG
		//echo "Diary Info - Book Accessories  \r	Corners is $diarybookcorners, Gilding is $diarybookgilding, Reference Pages is $diarybookrefpages, Plastic Sleeve is  $diarybooksleeve, Plastic Jaclet is $diarybookjacket and Stickers is $diarybookstickers  \r\n";

		
// VISITOR INFO
	$quote_school = $data['your_school'];
	$quote_name = $data['your_name'];
	$quote_email = $data['your_email'];
	$quote_phone = $data['your_phone'];
		//DEBUG
		//echo "Diary Info - Visitor Info  \r 	School is $quote_school, Name is $quote_name, Email is $quote_email and Phone is $quote_phone  \r\n";

		
//QUOTE QUANTITY
	$quote_customqty = $data['customQuantity'];
	$quote_standardqty = $data['standardQuantity'];
		//DEBUG
		//echo "Diary Info - Quote Quantity - Custom qty is $quote_customqty and Standard qty is $quote_standardqty \r\n";

// QUOTE WITH EMAIL OR NOT?
	$quote_emailstatus = $data['emailrequest'];
		//DEBUG
		//echo "The email request status is $quote_emailstatus \r\n";		
		
// HIDDEN DATA
	date_default_timezone_set('Australia/Sydney');
	$when_raw = $data['submissiondate'];
	$when = date('Y-m-d H:i:00');//$browser = $data['browserdetail'];
	$who = $data['visitorip'];
	if (isset($data['browserdetail'])){$browser = $data['browserdetail'];}else{$browser="";}
	$action = $data['action'];

	$dbu = $data['dbupdate'];
		//DEBUG
		//echo "dbupdate is $dbu";
// END OF FORM FIELDS


// open response box
$formupdate =1;




//ESTABLISH QUANTITY FOR THIS QUOTE STYLE
	if ($diarystyle == "standard"){
		$diaryqty = $quote_standardqty;
		$pricebreak = pricebreakcustom($diaryqty);
	}else{
		$diaryqty = $quote_customqty;
		$pricebreak = pricebreak($diaryqty);
	}
		//DEBUG
		//echo  "THIS QUOTE - DIARY SIZE - $diarysize, QUANTITY = $diaryqty and Price break =  $pricebreak \r\n";
	
	
//ESTABLISH COVER TYPE FOR THIS BINDING TYPE
	if ($diarybinding == "spiral")
	{
		$diarycovertype = $diarycovertype_spiral;
	}
	else
	{
		$diarycovertype = $diarycovertype_book;
	}
	$diarynicecovername = getnicecovername($diarycovertype);

	//DEBUG
	//echo  " \r\nTHIS QUOTE - STYLE is $diarystyle \r\n";
	//echo  "THIS QUOTE - BINDING TYPE - $diarybinding and cover type is $diarycovertype \r\n";
	//echo  "THIS QUOTE - the nice cover name is $diarynicecovername \r\n";



// CALCUATE COVER OPTIONS FOR BINDING TYPE - DO BOOK AND SPIRAL SEPARATELY
// CALCUATE COVER OPTIONS FOR BOOK FORMAT 
	$b_ibc_price = 0; 
	$b_ifc_price = 0;
	$bookcoveroptionsprice = 0;
	
	if ($diarybinding == "book"){
		if ($diaryoptionbookfrontcover == "on"){

		//Inside front cover
			$optionname="insidefrontcover";
			$b_ifc_price = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
				//DEBUG
				//echo "THIS QUOTE - Book Inside Front Cover is selected and price = $b_ifc_price \r\n";

		}else{
				//DEBUG
				//echo "THIS QUOTE - Book Inside Front Cover is NOT selected \r\n";
		}
		if ($diaryoptionbookbackcover == "on"){
		
		//Inside back cover
			$optionname="insidebackcover";
			$b_ibc_price = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
				//DEBUG
				//echo "THIS QUOTE - Book Inside Back Cover is selected and price = $b_ibc_price \r\n";
		}else{
				//DEBUG
				//echo "THIS QUOTE - Book Inside BackCover is NOT selected \r\n";
		}

	$bookcoveroptionsprice = $b_ifc_price + $b_ibc_price; 
		//DEBUG
		//echo  "\r\nPRICE = TOTAL BOOK COVER OPTIONS:  $bookcoveroptionsprice \r\n";
	}

	
// CALCUATE COVER OPTIONS FOR SPIRAL FORMAT 

	$s_fc_price = 0; 
	$s_ifc_price = 0; 
	$s_bc_price = 0;
	$spiralcoveroptionsprice = 0;
	if ($diarybinding == "spiral"){
		if ($diaryoptionsspiralfrontcover == "Custom_Front"){
			// Custom Front cover
			$optionname="customfrontcover";
			$s_fc_price = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
				//DEBUG
				//echo "THIS QUOTE - Spiral Custom Front Cover is selected and price = $s_fc_price \r\n";

		}else{
			$s_fc_price = 0;$s_insidefc_price=0;$s_ifc_price=0;
			$optionname="custominsidefrontcover";
			$s_insidefc_price = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
			$optionname="customfrontcover";
			$s_frontcover_price = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
			$s_fc_price = $s_insidefc_price + $s_frontcover_price;
				//DEBUG
				//echo "THIS QUOTE - Spiral Custom Front & Inside Cover is selected and price = $s_fc_price \r\n";
		}
		if ($diaryoptionsspiralbackcover == "Custom_Back"){
			// Custom Back cover
			$optionname="custombackcover";
			$s_bc_price = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
				//DEBUG
				//echo "THIS QUOTE - Spriral Custom Back Cover is selected and price = $s_bc_price \r\n";
			}else{
				$s_bc_price = 0;
				//DEBUG
				//echo "THIS QUOTE - Spiral Standard BackCover is selected. No extra cost \r\n";
		}
	$spiralcoveroptionsprice = $s_fc_price + $s_bc_price; 
	//DEBUG
	//echo  "\r\nPRICE = TOTAL SPIRAL COVER OPTIONS:  $spiralcoveroptionsprice \r\n";
}

// ESTABLISH APPLICABLE PRICE
if($diarystyle=="custom"){
	$optionsprice =0;
	if($diarybinding =="book"){
		$optionsprice = $bookcoveroptionsprice;
	}
	else{
		$optionsprice = 0;
	}
	if($diarybinding =="spiral"){
		$optionsprice = 0;
	}
}
else{
// STANDARD
$optionsprice = 0;
	if($diarybinding =="book"){
		$optionsprice = $bookcoveroptionsprice;
	}
	else{
		$optionsprice = $spiralcoveroptionsprice;
	}
}

//establish the accessories
//set default prices for unique accessories
$coverprotectorprice=0;$access_coverprotector="";
$rulerprice=0;$access_ruler="";
$spiralsleeveprice=0;$access_spiralsleeve="";
$accessoryreport="";$totalaccessoryprice=0;
$spiralstickersprice=0;$spiralrefpagesprice=0;
$bookjacketprice=0;$bookstickersprice=0;$bookrefpagesprice=0;
// spiral-specific accessories
//DEBUG
//if (!empty($accessoryreport)) {echo "accessory report is NOT empty";} else { echo "accessory report is empty";}

if ($diarybinding =="spiral"){
	
	// Cover Protectors
	if ($diaryspiralcoverprotector == "on"){
		$accessname = "protectors";
		$coverprotectorname="";
		$coverprotectorprice = calc_accessory_price($diarybinding,$accessname,$diarysize);
		$coverprotectorname = calc_accessory_name($diarybinding,$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - $coverprotectorname are selected and price = $coverprotectorprice \r\n";		
		$access_coverprotector="yes";
		$accessoryreport .= $coverprotectorname;
		//DEBUG
		//if (!empty($accessoryreport)) {echo "#2accessory report is NOT empty";} else { echo "#@accessory report is empty";}

			//DEBUG
			//echo "THIS QUOTE progrogressive accessory report is $accessoryreport \r\n";		
	}else
	{
			//DEBUG
			//echo "THIS QUOTE - Cover Protectors are NOT selected \r\n";
		$coverprotectorprice = 0;
		$access_coverprotector="no";
	}

	// Ruler
	if ($diaryspiralruler == "on"){
		$rulername="";
		$accessname = "ruler";
		$rulerprice = calc_accessory_price($diarybinding,$accessname,$diarysize);
		$rulername = calc_accessory_name($diarybinding,$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - Ruler is selected and price = $rulerprice \r\n";		
		$access_ruler="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $rulername";} else {$accessoryreport = $rulername;}
		
	}else
	{
			//DEBUG
			//echo "THIS QUOTE - Rulers is NOT selected \r\n";
		$rulerprice = 0;
		$access_ruler="no";
	}

	// Plastic Sleeve (Spiral version)
	if ($diaryspiralsleeve == "on"){
		$accessname = "sleeve_e";
		$spiralsleeveprice = calc_accessory_price($diarybinding,$accessname,$diarysize);
		$spiralsleevename = calc_accessory_name($diarybinding,$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - Plastic Sleeve is selected  AND PRICE = $spiralsleeveprice \r\n";		
		$access_ruler="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $spiralsleevename";} else {$accessoryreport = $spiralsleevename;}
	}else
	{
			//DEBUG
			//echo "THIS QUOTE - Plastic Sleeve  (Spiral version)is NOT selected \r\n";
		$spiralsleeveprice = 0;
		$access_spiralsleeve="no";
	}
	if (empty($accessoryreport)) {
		$accessoryreport = "None";
	}		
}


// book-specific accessories
$cornersprice=0;$access_corners="";
$giltprice=0;$access_gilding= "";
$booksleeveprice=0;$access_booksleave="";

if ($diarybinding =="book"){
	
	// Metal Corners
	if ($diarybookcorners == "on"){
		$accessname = "corner_silver";
		$cornersprice = calc_accessory_price($diarybinding,$accessname,$diarysize);
		$cornersname = calc_accessory_name($diarybinding,$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - BOOK ONLY: Metal Corners are selected and price = $cornersprice \r\n";		
		$access_corners="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $cornersname";} else {$accessoryreport = $cornersname;}
	}
	else
	{
			//DEBUG
			//echo "THIS QUOTE - Metal Corners are NOT selected \r\n";
		$cornersprice = 0;
		$access_corners="no";
	}
	
	//Edge Gilding
	if ($diarybookgilding == "on"){
		$accessname = "gild";
		$giltprice = calc_accessory_price($diarybinding,$accessname,$diarysize);
		$gildingname = calc_accessory_name($diarybinding,$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - BOOK ONLY: Edge Gilding is selected and price = $giltprice \r\n";		
		$access_gilding="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $gildingname";} else {$accessoryreport = $gildingname;}
	}else
	{
			//DEBUG
			//echo "THIS QUOTE - Edge Gilding is NOT selected \r\n";
		$giltprice = 0;
		$access_gilding="no";
	}

	// Plastic Sleeve (Book version)
	if ($diarybooksleeve == "on"){
		$accessname = "sleeve_p";
		$booksleeveprice = calc_accessory_price($diarybinding,$accessname,$diarysize);
		$booksleevename = calc_accessory_name($diarybinding,$accessname,$diarysize);		
			//DEBUG
			//echo "THIS QUOTE - Plastic Sleeve is selected aND PRICE = $booksleeveprice \r\n";		
		$access_booksleave="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $booksleevename";} else {$accessoryreport = $booksleevename;}
	}else
	{
			//DEBUG
			//echo "THIS QUOTE - Plastic Sleeve (Book verswion) is NOT selected \r\n";
		$booksleeveprice = 0;
		$access_booksleave="no";
	}	
}
$spiraljacketprice=0;$access_spiralplasticjacket="";
$spiralstickersprice=0;$access_spiralstickers="";
$spiralstickersprice=0;
// COMMON ACCESSORIES if Spiral is chosen

if ($diarybinding =="spiral"){

	// Plastic jacket
	if ($diaryspiraljacket == "on"){
			$accessname = "plastic_jacket";
			$spiraljacketprice = calc_accessory_price("common",$accessname,$diarysize);
			$spiraljacketname = calc_accessory_name("common",$accessname,$diarysize);		
				//DEBUG
				//echo "THIS QUOTE - Plastic Jacket is selected and price = $spiraljacketprice \r\n";		
			$access_spiralplasticjacket="yes";
			if (!empty($accessoryreport)) {$accessoryreport .= ", $spiraljacketname";} else {$accessoryreport = $spiraljacketname;}
	}
	else
	{
			//DEBUG
			//echo "THIS QUOTE - Plastic Jacket is NOT selected \r\n";
		$spiraljacketprice = 0;
		$access_spiralplasticjacket="no";
	}

	// Stickers
	if ($diaryspiralstickers == "on"){
		$accessname = "stickers";
		$spiralstickersprice = calc_accessory_price("common",$accessname,$diarysize);
		$spiralstickersname = calc_accessory_name("common",$accessname,$diarysize);		
			//DEBUG
			//echo "THIS QUOTE - Stickers are selected and price = $spiralstickersprice \r\n";		
		$access_spiralstickers="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $spiralstickersname";} else {$accessoryreport = $spiralstickersname;}
	}
	else
	{
			//DEBUG
			//echo "THIS QUOTE - Stickersw are NOT selected \r\n";
		$spiralstickersprice = 0;
		$access_spiralstickers="no";
	}
	
	//Reference Pages
	if ($diaryspiralrefpages == "on"){
		$accessname = "ref_pages";
		$spiralrefpagesprice = calc_accessory_price("common",$accessname,$diarysize);
		$spiralrefpagesname = calc_accessory_name("common",$accessname,$diarysize);		
			//DEBUG
			//echo "THIS QUOTE - Reference pages are selected and price = $spiralrefpagesprice \r\n";		
		$access_spiralrefpages="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $spiralrefpagesname";} else {$accessoryreport = $spiralrefpagesname;}
		
	}
	else
	{
		//DEBUG
			//echo "THIS QUOTE - Reference pages are NOT selected \r\n";
		$spiralrefpagesprice = 0;
		$access_spiralrefpages="no";
	}		
}

// COMMON ACCESSORIES if Style = Book
if ($diarybinding =="book"){

	// Plastic jacket
	if ($diarybookjacket == "on"){
			$accessname = "plastic_jacket";
			$bookjacketprice = calc_accessory_price("common",$accessname,$diarysize);
			$bookjacketname = calc_accessory_name("common",$accessname,$diarysize);
				//DEBUG
				//echo "THIS QUOTE - Plastic Jacket is selected and price = $bookjacketprice \r\n";		
			$access_bookplasticjacket="yes";
			if (!empty($accessoryreport)) {$accessoryreport .= ", $bookjacketname";} else {$accessoryreport = $bookjacketname;}
	}
	else
	{
			//DEBUG
			//echo "THIS QUOTE - Plastic Jacket is NOT selected \r\n";
		$bookjacketprice = 0;
		$access_bookplasticjacket="no";
	}

	// Stickers
	if ($diarybookstickers == "on"){
		$accessname = "stickers";
		$bookstickersprice = calc_accessory_price("common",$accessname,$diarysize);
		$bookstickersname = calc_accessory_name("common",$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - Stickers are selected and price = $bookstickersprice \r\n";		
		$access_bookstickers="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $bookstickersname";} else {$accessoryreport = $bookstickersname;}
	}
	else
	{
			//DEBUG
			//echo "THIS QUOTE - Stickers is NOT selected \r\n";
		$bookstickersprice = 0;
		$access_bookstickers="no";
	}
	
	//Reference Pages
	if ($diarybookrefpages == "on"){
		$accessname = "ref_pages";
		$bookrefpagesprice = calc_accessory_price("common",$accessname,$diarysize);
		$bookrefpagesname = calc_accessory_name("common",$accessname,$diarysize);
			//DEBUG
			//echo "THIS QUOTE - Reference pages are selected and price = $bookrefpagesprice \r\n";		
		$access_bookrefpages="yes";
		if (!empty($accessoryreport)) {$accessoryreport .= ", $bookrefpagesname";} else {$accessoryreport = $bookrefpagesname;}		
	}
	else
	{
		//DEBUG
			//echo "THIS QUOTE - Reference pages are NOT selected \r\n";
		$bookrefpagesprice = 0;
		$access_bookrefpages="no";
	}
	if (empty($accessoryreport)) {
	$accessoryreport = "None";
	}		
}
//Summarise Accessory Price
$spiralaccessoryprice=0; $bookaccessoryprice=0; $totalaccessoryprice=0;
$spiralaccessoryprice=$coverprotectorprice+$rulerprice+$spiralsleeveprice+$spiraljacketprice+$spiralstickersprice+$spiralrefpagesprice;
$bookaccessoryprice=$cornersprice+$giltprice+$booksleeveprice+$bookjacketprice+$bookstickersprice+$bookrefpagesprice;
$totalaccessoryprice=$spiralaccessoryprice+$bookaccessoryprice;
	//DEBUG
	//echo "THIS QUOTE - spiral accessories = $spiralaccessoryprice \r\n";
	//echo "THIS QUOTE - book accessories = $bookaccessoryprice \r\n";
	//echo "THIS QUOTE - total accessories = $totalaccessoryprice \r\n";

// PAGES Content Options
//	Users own content ("Custom Pages") and Date Entries
	//Style = Standard
	$contentprice=0;
	if ($diarystyle == "standard"){
	$pagecontentreport="";
		//custom pages
		//$test = is_numeric($diarypagesstandard);
		//DEBUG
		//echo "the variable is numeric (Y/N) $test \r\n";
		//$pagesqty = ((int)$diarypagesstandard);
		//DEBUG
		$pagesprice=0;
		//echo "the number of pages is $diarypagesstandard \r\n";
	if ($diarypagesstandard > 0){	
		//$pagesprice=0;
			$pagesprice = calc_custom_pages_std($diarypagesstandard,$diarysize,$diaryqty);
			//DEBUG
			//echo "THIS QUOTE - # of custom pages is $diarypagesstandard and the price = $$pagesprice \r\n";
			$pagecontentreport = "Custom pages = $diarypagesstandard";
		}
		else
		{
			//DEBUG
			//echo "THIS QUOTE - # of custom pages is $diarypagesstandard and the price = $$pagesprice \r\n";
			$pagecontentreport = "No custom pages requested, ";
			$pagecontentreport = "";
		}
		
		// Date entries
		if ($dateentries == "yes"){
			$dateprice = calc_date_price($diarysize,$diaryqty);
				//DEBUG
				//echo "THIS QUOTE - Date Entries is chosen and the price is $$dateprice \r\n";
			$datename= "Date Entries";
				if (!empty($pagecontentreport)) {$pagecontentreport .= "<br/>$datename";} else {$pagecontentreport = $datename;}
		}else{
			$dateprice = 0;
			//echo "THIS QUOTE - Date Entries is NOT chosen \r\n";
			$pagecontentreport .= "";
		}
		$contentprice = $pagesprice+$dateprice;
	}
	
	//Style = Custom
	if ($diarystyle == "custom"){
	$pagecontentreport="";
	$colours="";
			//DEBUG
			//echo "\r\nQUOTE INFO: Custom Diary - Custom Pages info: Cover type = $diarycovertype, Size = $diarysize, Order quantity = $diaryqty, # of Pages is $diarypagescustom, colours = $diarypagescustomcolours \r\n";
		//custom pages

		if ($diarypagescustomcolours=="one"){
			$colours="1 Colour";
				//DEBUG
				//echo "1 colour displays as $colours";
		}
		if ($diarypagescustomcolours=="two"){
			$colours="2 Colour";
				//DEBUG
				//echo "2 colour displays as $colours";			
		}
		if ($diarypagescustomcolours=="full"){
			$colours="Full Colour";
				//DEBUG
				//echo "Full colour displays as $colours";			
			}
		$customprice = calc_custom_pages_custom($diarycovertype,$diarysize,$diaryqty,$diarypagescustom,$colours);
		//DEBUG
		//echo "THIS QUOTE - Custom Pages - # of pages is $diarypagescustom, Colours is $colours  \r\n";
		//echo "THIS QUOTE - Custom Diary Base Price = $$customprice \r\n";
		$pagecontentreport = "$diarypagescustom Custom Pages requested in $colours";

	}


// Cover Options - Format for output
//STANDARD
if ($diarystyle =="standard" )
{
	$coveroptionsreport="";
	if ($diarybinding == "book")
	{
		// Book
		if($diaryoptionbookfrontcover == "on" || $diaryoptionbookbackcover == "on")
		{
			
			//DEBUG
			//echo " \r\nat least one Cover Option for Book diary \r\n";
			if ($diaryoptionbookfrontcover == "on")
			{
				//$coveroptionsreport = "Inside Front cover required, ";
				if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Inside Front Cover";} else {$coveroptionsreport = "Inside Front Cover";}
				//DEBUG
				//echo "Inside Front cover required ";
			}
			if ($diaryoptionbookbackcover == "on"){
				//DEBUG
				//echo "Inside Back cover required \r\n";
				//$coveroptionsreport .="Inside Back cover required";
				if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Inside Back Cover";} else {$coveroptionsreport = "Inside Back Cover";}
			}
		}
		else
		{
			//echo " \r\nNo Cover Options requested\r\n";
			$coveroptionsreport = "None";
		}
	}
	else{
	
		//Spiral
		if ($diaryoptionsspiralfrontcover == "Custom_Front"){
			//DEBUG
				//echo "Custom Front Cover required\r\n";
			//$coveroptionsreport = "Custom Front Cover required, ";
			if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Custom Front Cover";} else {$coveroptionsreport = "Custom Front Cover";}
		}
		else{
			//DEBUG
				//echo "Custom Front & Inside Cover required\r\n";
			//$coveroptionsreport = "Custom Front & Inside Cover required, ";
			if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Custom Front & Inside Cover";} else {$coveroptionsreport = "Custom Front & Inside Cover";}
		}

		if ($diaryoptionsspiralbackcover == "Custom_Back"){
			//DEBUG
				//echo "Custom Back Cover required \r\n";
			//$coveroptionsreport .= "Custom Back Cover required";
			if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Custom Back Cover";} else {$coveroptionsreport = "Custom Back Cover";}
		}
		else{
			//DEBUG
				//echo " \r\nStandard Front Cover required \r\n";
			//$coveroptionsreport .= "Standard Back Cover required";
			if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Standard Back Cover";} else {$coveroptionsreport = "Standard Back Cover";}
		}
	}
}
// END OF STANDARD

//CUSTOM
if ($diarystyle =="custom" )
{
	$coveroptionsreport="";
	if ($diarybinding == "book")
	{
		// Book
		if($diaryoptionbookfrontcover == "on" || $diaryoptionbookbackcover == "on")
		{
			
			//DEBUG
			//echo " \r\nat least one Cover Option for Book diary \r\n";
			if ($diaryoptionbookfrontcover == "on"){
				//$coveroptionsreport = "Inside Front cover required, ";
				if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Inside Front Cover";} else {$coveroptionsreport = "Inside Front Cover";}
				//DEBUG
				//echo "Inside Front cover required \r\n";
			}
			if ($diaryoptionbookbackcover == "on"){
				//DEBUG
				//echo "Inside Back cover required \r\n";
				//$coveroptionsreport .="Inside Back cover required";
				if (!empty($coveroptionsreport)) {$coveroptionsreport .= "<br/>Inside Back Cover";} else {$coveroptionsreport = "Inside Back Cover";}
			}
		}
		else
		{
			//DEBUG
				//echo " \r\nNo Cover Options requested \r\n";
			$coveroptionsreport = "None";
		}
	}
	else
	{
		//DEBUG
		//echo "No Cover Options available for this style and binding combination\r\n";
		$coveroptionsreport = "";
	}	

}
// END OF CUSTOM


$basediaryprice=0;
// ESTABLISH PRICE CALC BASIS
if ($diarystyle =="standard"){
	$basediaryprice = calc_base_price_std($diarybinding,$diarysize);
	// if book_vinyl then add cost of one stamping
	if($diarycovertype == "book_vinyl"){
		$mybook_vinyl_stampingprice = calc_bookstamping($diaryqty);
		$basediaryprice = $basediaryprice + $mybook_vinyl_stampingprice;
	}
	if($diarycovertype == "book_printed"){
		$optionname="printedcover";
		$mybook_printed_customcoverprice = calc_coveroptions($optionname,$diarysize,$diarycovertype,$diaryqty);
		$basediaryprice = $basediaryprice + $mybook_printed_customcoverprice;	
	}
}
else
{
	$basediaryprice = $customprice;
}



// set the show/hide tag for Style-Custom  and Binding = Spiral
	//DEBUG
	//echo "Looking for the combination of Style = Custom and cover type = spiral \r\n";
	$stylestring = "custom";
	$bindingstring="spiral";
	$coveroptionsdisplay= "";
	//DEBUG
	//echo "THIS QUOTE: the diary style = $diarystyle and the cover type is $diarycovertype\r\n";
	if($diarystyle==$stylestring) 
	{
		// Result = this is a Custom Style diary
		//DEBUG
		//echo "Matched the style, now looking in binding. This binding is $diarycovertype \r\n";
		$coveroutcome =strstr($diarycovertype,$bindingstring);
		//DEBUG
		//echo "the cover outcome is $coveroutcome \r\n";
		if($coveroutcome) 
		{
			//Result: Style = Custom and Binding Type = Spiral; Display= hide both
			//DEBUG 
			//echo "Found a match setting, display to yes. \r\n";
			$coveroptionsdisplay= "displaynone";
		} 
		else 
		{
			//Result: Style = Custom and Binding Type =NOT Spiral; Display= book
			//DEBUG 
			//echo "Found a match setting, display to no. \r\n";
			$coveroptionsdisplay= "displaybook";
		}
	}
	else{
		//Result: Style = Standard; find out if this is Spiral
		$coveroutcome =strstr($diarycovertype,$bindingstring);
				//DEBUG
		//echo "the cover outcome is $coveroutcome \r\n";
		if($coveroutcome) 
		{
			//Result: Binding Type = Spiral; Display= display spiral
			$coveroptionsdisplay= "displayspiral";
		} 
		else 
		{
			//Result: Binding Type = Book; Display= display book
			$coveroptionsdisplay= "displaybook";
		}	
	}

$style = ucfirst($diarystyle);

// CALCULATE TOTAL PRICE PER UNIT AND AGGREGATE QUOTE PRICE
$totaldiaryprice = $basediaryprice+$optionsprice+$contentprice+$totalaccessoryprice;
//$aggregateprice = $totaldiaryprice*$diaryqty;

// International Rate converter
	$rates=get_option( 'pw-settings' );
	$rate_multiplier = $rates['wizard_int_rate'];
	//DEBUG
	// echo "the rate multiplier is $rate_multiplier";
	$totaldiaryprice = round(($totaldiaryprice * $rate_multiplier),3); 

$aggregateprice = $totaldiaryprice*$diaryqty;
// FORMAT PRICS FOR QUOTE SUMMARY PRESENTATION (easier to do in PHP than javascript)
$total_formatted = number_format($totaldiaryprice, 3, '.', '');
$totalpricetext = "$$total_formatted";
$aggregate_formatted = number_format($aggregateprice, 2, '.', ',');
$aggregatepricetext = "$$aggregate_formatted";
	//DEBUG
	//echo "Diary price/unit:$$totaldiaryprice\r\n";
	//echo "Total Diary price:$$aggregateprice\r\n";
	//echo "\r\nthe aggregate price is $$aggregate_formatted\r\n";
	//echo "\r\nthe aggregate text price is $aggregatepricetext\r\n";


// ESTABLISH CALCULATION & DATABASE REFERENCES
// establish the cover format for chosen binding
if ($diarybinding =="spiral"){$coverformat = $diarycovertype_spiral;}else{$coverformat = $diarycovertype_book;}
// establish the number of pages of own content
if ($diarystyle =="custom"){$custompages = $diarypagescustom;}else{$custompages = $diarypagesstandard;}
// establish the quantity
if ($diarystyle =="custom"){$diaryqty = $quote_customqty;}else{$diaryqty = $quote_standardqty;}
//DEBUG
//echo "cover format is ".$coverformat.", diary size is ".$diarysize.", custom pages is ".$custompages.", diary quantity is ".$diaryqty;


//BUILD REQUEST DETAILS
	//SCHOOL = $quote_school
	//REQUESTER = $quote_name
	$sub_date = date('l j F Y g:ia');
	$request_details = "Requested by ".$quote_name."<br/>for ".$quote_school."<br/>on ".$sub_date;
		//DEBUG
		//echo "\r\n$request_details\r\n";


// PREPARE QUOTE INFO TO DATABASE
	// ESTATBLISH INFO FOR COVER OPTIONS
	$coveroptions="";	
	$coveroption_columnstart = '<tr><td style="width:90px; border-width:1px; padding:3px 8px; border-style:solid; border-color:#666666; background-color:#ffffff;" valign="top">';
	if ($coveroptionsdisplay=="displayspiral"){
		$coveroptions = '<tr>
		<td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;" valign="top">Cover Options:</td>
		<td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$coveroptionsreport.'</td>
		</tr>';
	}
	if ($coveroptionsdisplay=="displaybook"){
		$coveroptions= '<tr>
		<td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;" valign="top">Inside Cover Options:</td>
		<td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$coveroptionsreport.'</td></tr>';
	}
	if ($coveroptionsdisplay=="displaynone"){
		$coveroptions = "";
	}

	// name of the school and person who requested the quote
	$quote_name= stripslashes($quote_name);
	$quote_school= stripslashes($quote_school);



	// insert a new row in the wp_pwquotes table for the basic quote details 
	$reply = $wpdb->insert( 'wp_pwquotes', array ('submission_date' => $when,'visitorip' => $who,'school' => $quote_school,'phone' => $quote_phone,'name' => $quote_name, 'email' => $quote_email,'message' => $request_details, 'mail_status' => "") );

	// Set a hidden field to show that the form has been been submitted
	$yourdbupdate = 1;

	// get the row number (ID) of the newly created quote 
	$replyid = $wpdb->insert_id;

	// update the content of request details
	$refid = $replyid;
	$request_details = "Quote ID:".$refid." (issued E&OE)<br/>".$request_details;
	$request_details = stripslashes($request_details);
	//$request_info = "<html>".$request_info."</html>";
	
	//BUILD the message - for screen and wp_pwquotes table. Build line by line.
	$pwquotetext = "";
	$pw_quote01_tablestart='<div id="quotesummary" style="width:375px;display:block;position:relative;margin:0;border:1px solid #000000;padding:5px;font: bold 12px Verdana, Arial, Helvetica, sans-serif;clear:both;text-align:left;z-index:88;background-color: #efff79;"><table style="font-family:verdana,arial,sans-serif;font-size:11px;color:#333333;border-width:1px;border-color:#666666;border-collapse:collapse;width:100%;padding:10px;">';
	$pw_quote02_titlerow = '<tr><th colspan="2" style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#dedede;margin:0px;">Diary Pricing Summary</th></tr>';
	$pw_quote_03_stylerow = '<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">Style:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$style.'</td></tr>';
	$pw_quote_04_bindingrow = '<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">Binding:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$diarynicecovername.'</td></tr>';
	$pw_quote_05_sizerow='<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">Size:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$diarysize.'</td></tr>';
	$pw_quote_06_qtyrow = '<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">Quantity:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$diaryqty.'</td></tr>';
	$pw_quote_07_coveroptionsrow = $coveroptions;
	$pw_quote_08_diarycontentrow = '<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">Diary content:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$pagecontentreport.'</td></tr>';
	$pw_quote_09_accessoriesrow='<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">Accessories:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$accessoryreport.'</td></tr>';
	$pw_quote_10_ppurow='
	<tr>
		<td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">
			Price per unit:
		</td>
		<td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$totalpricetext.'
		</td>
	</tr>';
	$pw_quote_11_totalpricerow='<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style: solid;border-color:#666666;background-color:#ffffff;">Total price:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$aggregatepricetext.'</td></tr>';
	$pw_quote_12_requestinforow='<tr><td style="width:90px;border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;" valign="top">Request Info:</td><td style="border-width:1px;padding:3px 8px;border-style:solid;border-color:#666666;background-color:#ffffff;">'.$request_details.'</td></tr>';
	$pw_quote_13_tableend='</table></div>';

	// build the quote by adding all the the lines together
	$pwquotetext = $pw_quote01_tablestart.$pw_quote02_titlerow.$pw_quote_03_stylerow.$pw_quote_04_bindingrow.$pw_quote_05_sizerow.$pw_quote_06_qtyrow.$pw_quote_07_coveroptionsrow.$pw_quote_08_diarycontentrow.$pw_quote_09_accessoriesrow.$pw_quote_10_ppurow.$pw_quote_11_totalpricerow.$pw_quote_12_requestinforow.$pw_quote_13_tableend;
	
	//update the quote details in wp_pwquotes
	$wpdb->update( 
		'wp_pwquotes', 
		array( 
			'message' => $pwquotetext,	
		), 
		array( 'ID' => $replyid ), 
		array( 
			'%s'	// message
		), 
		array( '%d' ) 
	);

	// remove the div name but keep the tabel settings for the email
	$pw_email_tablestart='<div style="width:375px;display:block;position:relative;margin:0;border:1px solid #000000;padding:5px;font: bold 12px Verdana, Arial, Helvetica, sans-serif;clear:both;text-align:left;z-index:88;background-color: #efff79;"><table style="font-family:verdana,arial,sans-serif;font-size:11px;color:#333333;border-width:1px;border-color:#666666;border-collapse:collapse;width:100%;padding:10px;border-spacing: 0;">';

	$pw_email_tableend='</table></div>';
	// Check whether to send an email to the prospect

		// build the quote for the email
	$pw_emailquotetext = $pw_email_tablestart.$pw_quote02_titlerow.$pw_quote_03_stylerow.$pw_quote_04_bindingrow.$pw_quote_05_sizerow.$pw_quote_06_qtyrow.$pw_quote_07_coveroptionsrow.$pw_quote_08_diarycontentrow.$pw_quote_09_accessoriesrow.$pw_quote_10_ppurow.$pw_quote_11_totalpricerow.$pw_quote_12_requestinforow.$pw_email_tableend;
	


	// did propect request an email
	if ($quote_emailstatus =="yes"){
		// if visitor requests email, then we send one email to the prospect and another to Andrew
	
		prospect_email($refid,$pw_emailquotetext,$quote_email);
		admin_email($refid,$quote_name,$quote_school,$quote_email,$quote_phone,$pw_emailquotetext,"yes");

	}
	else
	{
		//vistor does NOT request email, so we just send an email to Andrew
		admin_email($refid,$quote_name,$quote_school,$quote_email,$quote_phone,$pw_emailquotetext,"no");
	}



// echo the quote text - this is an part of the Ajax call; the quote is picked up by jQuery and returned to the form
echo $pwquotetext;

// always exit the ajax call
exit;
}
?>