<?php

$dirname = dirname ( __FILE__ );
$root    = false !== mb_strpos ( $dirname , 'wp-content' ) ? mb_substr (
	$dirname , 0 , mb_strpos ( $dirname , 'wp-content' )
) : $dirname;

$plugins_url = plugins_url ();

require_once ( $root . "wp-config.php" );
global $wpdb;

$pc_cat_type = 'pc_cat_type';
$pc_cat      = 'pc_cat';
$pcRel       = 'pc_rel';


// form data
$catList = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 17" );
$cat     = '';
foreach ( $catList as $cList ) {
	$typeName = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $cList->typeid" );
	$cat .= '<option value="' . $cList->cost . '">' . $typeName->type_name . '</option>';
}


$catListcover = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 19 order by id DESC" );
//echo "SELECT * FROM $pcRel where catid = 19 order by catid DESC<br>";
//print_r ( $catListcover );
$coveropt     = '';
foreach ( $catListcover as $cover ) {

	$typeName = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $cover->typeid" );

	if ( $cover->cost == '0.500' ) {
		$coveropt .= '<option data-img-label="Soft Cover" data-img-src="' . $plugins_url . '/pc/img/softcover.png" value="' . $cover->cost . '*' . $typeName->type_name . '">' . $typeName->type_name . '</option>';
	}
	if ( $cover->cost == '0.700' ) {
		$coveropt .= '<option data-img-label="Hard Cover" data-img-src="' . $plugins_url . '/pc/img/hardcover.png" value="' . $cover->cost . '*' . $typeName->type_name . '">' . $typeName->type_name . '</option>';
	}


	/*<option data - img - src = "img/01.png" data-img-class="first" data - img - alt = "Page 1" value = "1" > Page 1 </option >*/
}


$binding   = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 25" );
$coverbind = '';
foreach ( $binding as $bind ) {
	$typeName = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind->typeid" );
	$coverbind .= '<option value="' . $bind->cost . '">' . $typeName->type_name . '</option>';
}


$hardcover     = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 22" );
$hardcoverbind = '';
foreach ( $hardcover as $hardc ) {
	$typeName = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc->typeid" );
	$hardcoverbind .= '<option value="' . $hardc->cost . '">' . $typeName->type_name . '</option>';
}


$coverlam    = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 23" );
$coverlamopt = '';
foreach ( $coverlam as $coverla ) {
	$typeName = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla->typeid" );
	$coverlamopt .= '<option value="' . $coverla->cost . '">' . $typeName->type_name . '</option>';
}


$artwork    = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 21" );
$artworkopt = '';
foreach ( $artwork as $art ) {
	$typeName = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $art->typeid" );
	if( $typeName->id !='14') {
		$artworkopt .= '<option value="' . $art->cost . '">' . $typeName->type_name . '</option>';
	}
}


#################SOFT cover Option############################

$binding2   = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 25" );
$coverbind2 = '';
foreach ( $binding2 as $bind2 ) {
	$typeName2 = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind2->typeid" );
	if ( $typeName2->id != '25' ) {
		//$coverbind .= '<option value="' . $bind->cost . '">' . $typeName->type_name . '</option>';

		if ( $typeName2->id == '23' ) {
			$coverbind2 .= '<option data-img-label="' . $typeName2->type_name . '" data-img-src="' . $plugins_url . '/pc/img/saddle.png" value="' . $bind2->cost . '" selected="selected">' . $typeName2->type_name . '</option>';
		}
		if ( $typeName2->id == '24' ) {
			$coverbind2 .= '<option data-img-label="' . $typeName2->type_name . '" data-img-src="' . $plugins_url . '/pc/img/pur.png" value="' . $bind2->cost . '">' . $typeName2->type_name . '</option>';
		}


	}

}

$hardcover2     = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 22" );
$hardcoverbind2 = '';
foreach ( $hardcover2 as $hardc2 ) {
	$typeName2 = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc2->typeid" );
	if ( $typeName2->id == '9' ) {
		//$hardcoverbind .= '<option value="' . $hardc->cost . '">' . $typeName->type_name . '</option>';
		$hardcoverbind2 .= $hardc2->cost;
	}
}
$coverlam2    = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 23" );
$coverlamopt2 = '';
foreach ( $coverlam2 as $coverla2 ) {
	$typeName2 = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla2->typeid" );
	//echo $coverla2->typeid . ' ###';
	//$coverlamopt2 .= '<option value="' . $coverla2->cost . '">' . $typeName2->type_name . '</option>';

	if ( $typeName2->id == '17' ) {
		$coverlamopt2 .= '<div class="col-sm-6"><label class="control control--radio"><input type = "radio" name = "coverlam" id="coverlams1" value = "' . $coverla2->cost . '" checked="checked" > ' . $typeName2->type_name.'<div class="control__indicator"></div></label></div>';
	}

	if ( $typeName2->id == '18' ) {
		$coverlamopt2 .= '<div class="col-sm-6"><label class="control control--radio"><input type = "radio" name = "coverlam" id="coverlams2" value = "' . $coverla2->cost . '"  > ' . $typeName2->type_name.'<div class="control__indicator"></div></label></div>';
	}

}
#########################################################################################


####################HARD COVER OPTION####################################################


$binding3   = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 25" );
$coverbind3 = '';
foreach ( $binding3 as $bind3 ) {
	$typeName3 = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind3->typeid" );
	if ( $typeName3->id != '23' ) {
		//$coverbind3 .= '<option value="' . $bind3->cost . '">' . $typeName3->type_name . '</option>';
		if ( $typeName3->id == '24' ) {
			$coverbind3 .= '<option data-img-label="' . $typeName3->type_name . '" data-img-src="' . $plugins_url . '/pc/img/pur.png" value="' . $bind3->cost.'">' . $typeName3->type_name . '</option>';
		}
		if ( $typeName3->id == '25' ) {
			$coverbind3 .= '<option data-img-label="' . $typeName3->type_name . '" data-img-src="' . $plugins_url . '/pc/img/section.png" value="' . $bind3->cost.'">' . $typeName3->type_name . '</option>';
		}
	}

}

$hardcover3     = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 22" );
$hardcoverbind3 = '';
foreach ( $hardcover3 as $hardc3 ) {
	$typeName3 = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc3->typeid" );
	if ( $typeName3->id != '9' ) {
		//$hardcoverbind3 .= '<option value="' . $hardc3->cost . '">' . $typeName3->type_name . '</option>';
		if ( $typeName3->id == '15' ) {
			$hardcoverbind3 .= '<option data-img-label="' . $typeName3->type_name . '" data-img-src="' . $plugins_url . '/pc/img/printonbord.png" value="' . $hardc3->cost.'" selected="selected">' . $typeName3->type_name . '</option>';
		}
		if ( $typeName3->id == '16' ) {
			$hardcoverbind3 .= '<option data-img-label="' . $typeName3->type_name . '" data-img-src="' . $plugins_url . '/pc/img/matonbord.png" value="' . $hardc3->cost.'">' . $typeName3->type_name . '</option>';
		}
	}
}

$coverlam3    = $wpdb->get_results ( "SELECT * FROM $pcRel where catid = 23" );
$coverlamopt3 = '';
foreach ( $coverlam3 as $coverla3 ) {
	$typeName3 = $wpdb->get_row ( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla3->typeid" );
	if ( $typeName3->id != '18' ) {
		//$coverlamopt3 .= '<option value="' . $coverla3->cost . '">' . $typeName3->type_name . '</option>';
		$coverlamopt3 = $coverla3->cost;
	}
}



?>

<div> <!-- class="container" -->
<!--<div class="row">
	<h1 class="mainheading">Yearbook Cost Calculator</h1>
</div>

<div class="row">
	<div class="container-fluid">
		<div class="col-sm-12 toptile text-center">The price for your yearbooks will display instantly here after selecting the desired options and
		                                           entering your details.
		</div>
	</div>
</div>-->

<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.4/numeral.min.js"></script>
<div class="row">
<h1 class="mainheading-1"><span class="circle">1</span> Pages and Printing</h1>

<div class="container-fluid">
	<form id="pcfrontcalc" name="pcfrontcalc" method="post" action="#" enctype="multipart/form-data">
		<div class="col-sm-3">
			<div class="fombox-1">
				<div class="fmrow">
					<label>Quantity of Books</label>
					<input type="text" id="qty" name="qty" value="" onblur="chkqty()" oninput="renamebtn()"/>
					<lable class="error" id="error1" style="display:none">Please enter numaric value only</lable>
					<lable class="error" id="error2" style="display:none">Value must be 10 or more</lable>

				</div>


			</div>
			<!--fombox-1 end here-->


		</div>
		<!--col-sm-6 end here-->
		
		<div class="col-sm-3">
			<div class="fombox-1">
				<div class="fmrow">
					<label>Quantity of Pages</label>
					<input type="text" id="qty_pages" name="qty_pages" value="" onblur="chkqtypages()" oninput="renamebtn()"/>
					<lable class="error" id="error3" style="display:none">Value Must be divisible by 4</lable>
				</div>
			</div>	
		</div>


		<div class="col-sm-3">
			<div class="fombox-1">
				<div class="fmrow">
					<label>Print Quality</label>
					<select id="print_qlty" name="print_qlty" onchange="renamebtn()">
						<option value="">Please Select</option>
						<?php echo $cat; ?>
					</select>

					
					<div class="tooltip infospan">
					<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
					  <span class="tooltiptext">
					  We offer 3 levels of print quality to appeal to all budgets:
						<ul>
							<li>Good (Inkjet);</li>
							<li>Better (Toner) +25%  and</li>
							<li>Best (ElectroInk) +50%</li>
						</ul>
					  </span>
					  
					</div>
					
																	

					<lable class="error" id="error4" style="display:none">Please select Print Quality</lable>

				</div>


				

			</div>
			<!--fombox-1 end here-->


		</div>
		<!--col-sm-6 end here-->
		
		
		<div class="col-sm-3">
			<div class="fombox-1">
			<label>&nbsp;</label>
			<div class="fmrow malnd">
				<label class="control control--checkbox">
					<input id="fscpaper" name="fscpaper" type="checkbox" onclick="renamebtn()"/>
					<div class="control__indicator"></div> 
					FSC Paper Stock 
					
					
					<div class="tooltip infospan">
						<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
					  <span class="tooltiptext text-center">
					  Selecting FSC® Paper provides assurance that the paper stocks used are sourced from sustainable and ethical forestry companies and enables us to use the FSC® label. <br>+ 5%
					  </span>
					  
					</div>
					
						
				</label>
			</div>
			
			
				<!--<div class="fmrow">
					<label class="fscpaper"><input id="fscpaper" name="fscpaper" type="checkbox"/> FSC Paper Stock</label>
					<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top"
					                          title="Selecting FSC® Paper provides assurance that the paper stocks used are sourced from sustainable and ethical forestry companies and enables us to use the FSC® label. + 5%"></i></span>
				</div>-->
			</div>
		</div>


</div>


<h1 class="mainheading-1"><span class="circle">2</span> Cover Type</h1>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">

			<div class="row">
				<div class="col-sm-12">
					<div class="covertype">
						<select id="covertype" name="covertype" class="image-picker show-labels show-html" onchange="showBlock(this.value)"> <!--onchange="showfields(this.value)"-->
							<?php echo $coveropt; ?>
						</select>
					</div>
				</div>
				<!--col-sm-3 end here-->
			</div>
		</div>


	</div>


</div>


<h1 class="mainheading-1" id="softTitle"><span class="circle">3</span> Cover & Binding Options (Soft Cover)</h1>
<!--#####################SOFT COVER OPTION SELECTED ################################-->
<div class="container-fluid" id="softcover">
	<div class="row">
		<div class="col-sm-6">
			<h2 class="bndin text-left">Binding</h2>

			<div class="row">
				<div class="col-sm-12">
					<select id="binding" name="binding" class="image-picker show-labels show-html"
					        onchange="renamebtn()">
						<?php echo $coverbind2; ?>
					</select>
				</div>
				
				
				<div class="row">
						<div class="col-xs-6">
							<div class="text-center">
								<div>
									<span class="infospan smallinfo" id="saddledis" style="display:none">This type of binding is best for page count of 64 or less.</span>
									
									
									<div class="tooltip infospan">
										<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
									  <span class="tooltiptext text-center">
									 A cost effective binding solution for page counts of 64 pages or less where the book is stapled through the foldline.
									  </span>
									  
									</div>
									
									
									
									<!--<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top" title=""
				                          data-original-title="A cost effective binding solution for page counts of 64 pages or less where the book is stapled through the foldline."></i>
									</span>-->
								</div>
							</div>
						</div>
						
						
						<div class="col-xs-6">
							<div class="text-center">
								<div>
								
								
								<div class="tooltip infospan">
										<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
									  <span class="tooltiptext text-center">
									 Is a form of perfect binding where a durable, reactive glue is used to bind the pages and cover together at the spine . <br>5 times the cost of Saddle Stitch.
									  </span>
									  
								</div>
								
								
									<!--<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top" title=""
				                          data-original-title=" Is a form of perfect binding where a durable, reactive glue is used to bind the pages and cover together at the spine . + 500%"></i>
									</span>-->
								</div>
							</div>
						</div>
						
						
					</div>
				
				
				<!--col-sm-3 end here-->
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-6">
					<input type="text" id="hardmat" name="hardmat" value="<?php echo $hardcoverbind2; ?>">
				</div>
				<!--col-sm-3 end here-->
			</div>


			<div class="otiondiv" style="display:none;">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="bndin text-left">Cover Lamination</h2>
						<!--<select id="coverlam" name="coverlam" class="image-picker show-labels show-html" onchange="showfields(this.value)"> -->
						<?php echo $coverlamopt2; ?>
						<!--</select>-->
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
		</div>
	</div>
</div>


<!--#####################################################-->


<!--#####################Hard COVER OPTION SELECTED ################################-->
<h1 class="mainheading-1" id="hardTitle" style="display:none"><span class="circle">3</span> Cover & Binding Options (Hard Cover)</h1>
<div class="container-fluid" id="hardcover" style="display:none">
	<div class="row">
		<div class="col-sm-6">
			<h2 class="bndin text-left">Binding</h2>

			<div class="row">
				<div class="col-sm-12">
					<select id="bindingH" name="bindingH" class="image-picker show-labels show-html"
					        onchange="renamebtn()">
						<?php echo $coverbind3; ?>
					</select>
					
					
					<div class="row">
						<div class="col-xs-6">
							<div class="text-center">
								<div>
								
								<div class="tooltip infospan">
										<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
									  <span class="tooltiptext text-center">
									 Is a form of perfect binding where a durable, reactive glue is used to bind the pages and cover together at the spine . <br>5 times the cost of Saddle Stitch.
									  </span>
									  
								</div>
								
								
								
									<!--<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top" title=""
				                          data-original-title=" Is a form of perfect binding where a durable, reactive glue is used to bind the pages and cover together at the spine . + 500%"></i>
									</span>-->
								</div>
							</div>
						</div>
						
						
						<div class="col-xs-6">
							<div class="text-center">
								<div>
								
									<div class="tooltip infospan">
										<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
									  <span class="tooltiptext text-center">
									 Common for hard cover books where folded sections of pages are sewn together before being glued into the hard case cover. <br>40% more than PUR.
									  </span>
									  
									</div>
								
								
									<!--<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top" title=""
				                          data-original-title="Common for hard cover books where folded sections of pages are sewn together before being glued into the hard case cover. +700%"></i>
									</span>-->
								</div>
							</div>
						</div>
						
						
					</div>
					
					
					
					
					
					
					
					
				</div>
				<!--col-sm-3 end here-->
			</div>
		</div>
		<div class="col-sm-6">
			<h2 class="bndin text-left">Cover Material </h2>

			<div class="row">
				<div class="col-sm-12">
					<select id="hardmatH" name="hardmatH" style="width:100%" onchange="renamebtn()">
						<?php echo $hardcoverbind3; ?>
					</select>
				</div>
				<!--col-sm-3 end here-->
			</div>


			<div class="otiondiv">
				<div class="row">
					<div class="col-xs-6">
						<input type="hidden" id="coverlamH" name="coverlamH" value="<?php echo $coverlamopt3; ?>">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--#####################################################-->


<h1 class="mainheading-1"><span class="circle">4</span>Artwork & Fundraising</h1>

<div class="container-fluid">


	<div class="col-sm-6">
		<div class="fombox-1">
			
			<div class="fmrow osmlk">
				<label>How is artwork to to be prepared</label>

				<select id="artwork" name="artwork" onchange="renamebtn()" >
					<option value="">Please Select</option>
					<?php echo $artworkopt; ?>
				</select>
				<lable class="error" id="error5" style="display:none">Please select artwork to to be prepared by.</lable>

				
								<div class="tooltip infospan">
										<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
									  <span class="tooltiptext text-center">
									 You may elect to create your own artwork using your own software and supply us with a print ready PDF, or utilise our online software. Alternatively we can offer a full design service and prepare all the artwork for you.
									  </span>
									  
								</div>
				
				
				
								<!--<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top" title=""
				                          data-original-title="You may elect to create your own artwork using your own software and supply us with a print ready PDF, or utilise our online software. Alternatively we can offer a full design service and prepare all the artwork for you."></i></span>-->

			</div>


		</div>
		<!--fombox-1 end here-->


	</div>
	<!--col-sm-6 end here-->
	
	
	<div class="col-sm-6">
		<div class="fombox-1">
			<div class="fmrow osmlk">
				<label>Add Funraiser Amount per Book</label>

				<i class="fa fa-usd" aria-hidden="true"></i><input type="text" id="fundperbook" name="fundperbook" value="" placeholder="0.00" onblur="renamebtn()"/>

				
				
							<div class="tooltip infospan">
										<i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip"> </i>
									  <span class="tooltiptext text-center">
									 Why not round up the yearbook cost and raise some money at the same time? Eg If the cost is $17.90, add $2.10 and if you order 100 yearbooks you will raise $210!
									  </span>
									  
							</div>
				
				
										<!--<span class="infospan"><i class="fa fa-info-circle " aria-hidden="true" data-toggle="tooltip" data-placement="top" title=""
				                          data-original-title="Why not round up the yearbook cost and raise some money at the same time? Eg If the cost is $17.90, add $2.10 and if you order 100 yearbooks you will raise $210!"></i></span>-->

			</div>


		</div>
		<!--fombox-1 end here-->


	</div>
	<!--col-sm-6 end here-->
	
	
</div>
<!--container-fluid end here-->


<h1 class="mainheading-1"><span class="circle">5</span>Fancy Options</h1>

<div class="container-fluid" id="forsoftcover">
	<div class="col-sm-12 toptile text-left">Fancy options such as Embossing, Printed End Papers, Clear Spot Gloss lamination, Ribbons, extra
	                                         Stampings and more
	                                         are all available, but prices are dependent on artwork.
	</div>

	<div class="col-sm-12">
		<div class="fmrow">
			<!--<label class="fscpaper"><input type="checkbox" id="sendoption" name="sendoption"> Please send me details about Fancy Options</label>-->
			<label class="control control--checkbox">
				<input type="checkbox" id="sendoption" name="sendoption" >
				<div class="control__indicator"></div>
				Please send me details about Fancy Options
			</label>

		</div>
	</div>


</div>


<div class="container-fluid" id="forhardcover" style="display:none">
	<div class="col-sm-12 toptile text-left">

	</div>

	<div class="col-sm-6">
		<div class="fmrow fanyopton">
			<label>Ribbon</label>
			<select id="ribbon" name="ribbon" onchange="renamebtn()">
				<option value="">Please Select</option>
				<option value="1">Yes</option>
				<option value="0" selected="selected">No</option>
			</select>
			<lable class="error" id="error6" style="display:none">Please select Ribbon option.</lable>

		</div>
	</div>

	<div class="col-sm-6">
		<div class="fmrow fanyopton">
			<label>Head Bands</label>
			<select id="headbands" name="headbands" onchange="renamebtn()">
				<option value="">Please Select</option>
				<option value="1">Yes</option>
				<option value="0" selected="selected">No</option>
			</select>
			<lable class="error" id="error7" style="display:none">Please select Head Bands option.</lable>

		</div>
	</div>

	<div class="col-sm-12 toptile text-left">Fancy options such as Embossing, Printed End Papers, Clear Spot Gloss lamination, Ribbons, extra
	                                         Stampings and more
	                                         are all available, but prices are dependent on artwork.
	</div>
	<div class="col-sm-12">
	
	
	
		<div class="fmrow">

			<label class="control control--checkbox">
				<input type="checkbox" id="sendoptionh" name="sendoptionh" >
				
				<div class="control__indicator nwson"></div>
				Please send me details about Fancy Options
			</label>


			<!--<label class="fscpaper">

				<input type="checkbox" id="sendoptionh" name="sendoptionh">
				<div class="control__indicator"></div>
				Please send me details about Fancy Options</label>-->



		</div>
	</div>


</div>


<!--container-fluid end here-->


<h1 class="mainheading-1"><span class="circle">6</span>Your Details</h1>

<div class="container-fluid">


	<div class="col-sm-5">
		<div class="fombox-1">
			<div class="fmrow">
				<label>Your Name</label>
				<input type="text" id="yname" name="yname" value="" />
				<lable class="error" id="error8" style="display:none">Please enter Your Name.</lable>

			</div>

			<div class="fmrow">
				<label>School Name</label>
				<input type="text" id="sname1" name="sname1" value=""/>
				<lable class="error" id="error12" style="display:none">Please enter School Name.</lable>

			</div>

			<div class="fmrow">
				<label>School Email</label>
				<input type="text" id="schoolName" name="schoolName" value=""  /><!--onblur="checkEmail()"-->
				<lable class="error" id="error9" style="display:none">Please enter valid School Email.</lable>
				<!--<lable class="error" id="error10" style="display:none"></lable>-->

			</div>


			<div class="fmrow">
				<label>Contact number
				       (optional)</label>
				<input type="text" id="cnumber" name="cnumber" value=""/>

			</div>


		</div>
		<!--fombox-1 end here-->
		
		
		<div class="fmrow">
			<!--<label class="fscpaper"><input type="checkbox" id="sendoption" name="sendoption"> Please send me details about Fancy Options</label>-->
			<label class="control control--checkbox">
				<input type="checkbox" id="sendcopy" name="sendcopy" checked="checked"/>
				<div class="control__indicator nwson"></div>
				Email me the quote (optional) 
			</label>

		</div>
		
			<!--<div class="qotoion">
				<h4 class="onsintn">
					<span class="emqu">
						<label class="control control--checkbox nwcon">
							<input type="checkbox" id="sendcopy" name="sendcopy" checked="checked"/>

							<div class="control__indicator"></div>
						</label>
					</span> Email me the quote (optional)</h4>
				


			</div>-->

		
		
		
		
			<div class="qotoion">
				<div class="g-recaptcha" data-sitekey="6LcqnRkUAAAAAG20COnOh5kFMcDBtqRirJABv4Hp"></div>
				<!--<div class="g-recaptcha" data-sitekey="6LeTqBgUAAAAADEPYxYnj0HZ91bOdSQRfiaO7YkB"></div>  amit code-->
				<lable class="error" id="reCaptcha" style="display:none">reCaptcha not verified</lable>
			</div>

		


	</div>
	<!--col-sm-6 end here

	<div class="col-sm-2">

	</div>-->


	<!--<div class="col-sm-4">
		<div class="fombox-1">
			<div class="qotoion text-center">
				<h4 class="text-center onsintn">Email me the quote (optional)</h4>
				<label class="control control--checkbox">
					<input type="checkbox" id="sendcopy" name="sendcopy" checked="checked"/>

					<div class="control__indicator"></div>
				</label>


			</div>

		</div>
		
	</div>fombox-1 end here-->

	<!--<div class="col-sm-2">

	</div>
	<div class="col-sm-4">
		<div class="fombox-1">
			<div class="qotoion text-center">
				<div class="g-recaptcha" data-sitekey="6LeTqBgUAAAAADEPYxYnj0HZ91bOdSQRfiaO7YkB"></div>
				<lable class="error" id="reCaptcha" style="display:none">reCaptcha not verified</lable>
			</div>

		</div>
		
	</div>fombox-1 end here-->
	<!--col-sm-6 end here-->


</div>
<!--container-fluid end here-->





<div class="container-fluid" id="issuein" style="display:none;">
	<div class="col-sm-12">
		<br>
	</div>
	<div class="col-sm-12">
		<br>
	</div>
	<div class="col-sm-12">

	</div>

	<div class="col-sm-12">
				<p>
					<lable>Ooops. It appears a selection has been missed above or there is an error with your entry - please check.</lable>
					<span id="noofissue"  style="font-weight: bold"></span>

				</p>
	</div>
</div>





<div class="container-fluid">


	<div class="col-sm-12">
		<div class="fombox-1 text-center">
			<!--<input type="button" id="buttond" name="buttond" class="disbuttond" value="Display Price"  disabled >-->
			<input type="button" id="button" name="button" class="disbutton" value="Display Price" onclick="calculatethis()" >
			<!--<button class="disbutton" onclick="calculatethis();">Display Price</button>-->
			<br>
			<p class="instr">If the above button is grey, you need to enter further data.</p>

		</div>
		<!--fombox-1 end here-->
	</div>
	<!--col-sm-6 end here-->


</div>
<!--container-fluid end here-->

<div class="container-fluid text-center" id="finalpriceis" style="display:none;">


	<div class="col-sm-12">
		<div class="fombox-1 text-center">
			<div class="col-sm-6">
				<p>
					<lable>Total Price per Book</lable>
					<span id="totalperbook" style="font-weight: bold"></span>
					<span>excl GST</span>
				</p>
			</div>

			<div class="col-sm-6">
				<p>
					<lable>Total Price</lable>
					<span id="totalprice" style="font-weight: bold"></span>
					<span>excl GST</span>
				</p>
			</div>

		</div>
		<!--fombox-1 end here-->
	</div>
	<!--col-sm-6 end here-->


</div>

<div class="container-fluid text-center" id="sendmaildiv" style="display:none;">
	<div class="col-sm-12">
		<br>
	</div>
	<div class="col-sm-12">
		<br>
	</div>
	<div class="col-sm-12">

	</div>

	<div id="sendmailresponse" class="col-sm-12">

	</div>
</div>


</div>
</form>
</div>



<?php require_once ("jscode.php" );?>

