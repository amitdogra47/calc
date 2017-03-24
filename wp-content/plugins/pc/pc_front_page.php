<?php

$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;

$plugins_url = plugins_url();

require_once( $root . "wp-config.php" );
global $wpdb;

$pc_cat_type = 'pc_cat_type';
$pc_cat      = 'pc_cat';
$pcRel       = 'pc_rel';


// form data
$catList = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 17" );
$cat     = '';
foreach ( $catList as $cList ) {
	$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $cList->typeid" );
	$cat .= '<option value="'. $cList->cost . '">' . $typeName->type_name . '</option>';
}


$catListcover = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 19" );
$coveropt     = '';
foreach ( $catListcover as $cover ) {
	$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $cover->typeid" );
	$coveropt .= '<option value="'. $cover->cost . '*'. $typeName->type_name.'">' . $typeName->type_name . '</option>';
}


$binding   = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 25" );
$coverbind = '';
foreach ( $binding as $bind ) {
	$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind->typeid" );
	$coverbind .= '<option value="'. $bind->cost . '">' . $typeName->type_name . '</option>';
}


$hardcover     = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 22" );
$hardcoverbind = '';
foreach ( $hardcover as $hardc ) {
	$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc->typeid" );
	$hardcoverbind .= '<option value="'. $hardc->cost . '">' . $typeName->type_name . '</option>';
}


$coverlam    = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 23" );
$coverlamopt = '';
foreach ( $coverlam as $coverla ) {
	$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla->typeid" );
	$coverlamopt .= '<option value="'. $coverla->cost . '">' . $typeName->type_name . '</option>';
}


$artwork    = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 21" );
$artworkopt = '';
foreach ( $artwork as $art ) {
	$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $art->typeid" );
	$artworkopt .= '<option value="'. $art->cost . '">' . $typeName->type_name . '</option>';
}

?>


<div class="container">
	<div class="row">
		<div class="col-md-9 col-sm-8">
			<h2>Print Cost Calculation - STUDENT YEARBOOKS</h2>

			<div class="print-calculation">

				<form id="pcfrontcalc" name="pcfrontcalc" method="post" action="#" enctype="multipart/form-data">
					<h3 class="form-heading"><span>1</span> Pages and Printing</h3>

					<p>
						<lable>Quantity</lable>
						<input type="text" id="qty" name="qty" value="" oninput="chkqty()"/>
					</p>
					<p>
						<lable>Quantity Pages</lable>
						<input type="text" id="qty_pages" name="qty_pages" value="" oninput="chkqtypages()"/>
					</p>

					<p>
						<lable>Print Quality</lable>
						<br/>
						<select id="print_qlty" name="print_qlty" style="width:100%" >
							<option value="">Please Select</option>
							<?php echo $cat; ?>
						</select>
					</p>

					<p>
						<lable>FSC Paper</lable>
						<br/>
						<select id="fscpaper" name="fscpaper" style="width:100%">
							<option value="">Please Select</option>
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</p>


					<h3 class="form-heading"><span>2</span> Cover Type</h3>

					<p>
						<lable>Cover Type</lable>
						<br/>
						<select id="covertype" name="covertype"
						        style="width:100%" onchange="showfields(this.value)">
							<option value="0">Please Select</option>
							<?php echo $coveropt; ?>
						</select>
					</p>


					<h3 class="form-heading"><span>3</span> Cover & Binding Options</h3>
					<div id="changethis">
						<p>
							<lable>Binding</lable>
							<br/>
							<select id="binding" name="binding" style="width:100%"
							        onchange="">
								<option value="">Please Select</option>
								<?php echo $coverbind; ?>
							</select>
						</p>

						<p>
							<lable>Hard Cover Material</lable>
							<br/>
							<select id="hardmat" name="hardmat" style="width:100%">
								<option value="">Please Select</option>
								<?php echo $hardcoverbind; ?>
							</select>
						</p>

						<p>
							<lable>Cover Lamination</lable>
							<br/>
							<select id="coverlam" name="coverlam"
							        style="width:100%">
								<option value="">Please Select</option>
								<?php echo $coverlamopt; ?>
							</select>
						</p>
					</div>


					<h3 class="form-heading"><span>4</span> Artwork and Fundraising</h3>

					<p>
						<lable>Artwork</lable>
						<br/>
						<select id="artwork" name="artwork" style="width:100%">
							<option value="">Please Select</option>
							<?php echo $artworkopt; ?>
						</select>
					</p>


					<p>
						<lable>Fundraising per book</lable>
						<br/>
						<input type="text" id="fundperbook" name="fundperbook" value=""/>
					</p>


					<h3 class="form-heading"><span>5</span> Fancy Options</h3>

					<h4 class="form-heading-sub">Hard Cover Options</h4>

					<p>
						<lable>Ribbon</lable>
						<br/>
						<select id="ribbon" name="ribbon" style="width:100%">
							<option value="">Please Select</option>
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</p>

					<p>
						<lable>Head Bands</lable>
						<br/>
						<select id="headbands" name="headbands"
						        style="width:100%">
							<option value="">Please Select</option>
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</p>

					<!--<p>
                        <lable>Extra Stamp 8 x 10</lable>
                        <select id="extrastamp" name="extrastamp">
                            <?php /*echo $coveropt; */ ?>
                        </select>
                    </p>

                    <p>
                        <lable>Extra Stamp Setup</lable>
                        <select id="extrastampsetup" name="extrastampsetup">
                            <?php /*echo $coveropt; */ ?>
                        </select>
                    </p>-->

					<div id="fillform">

					</div>

					<h3 class="form-heading"><span>5</span> Price</h3>

					<p>
						<lable>Total Price per Book</lable>
						<span id="totalperbook" style="font-weight: bold">$</span>
						<span>excl GST</span>
					</p>

					<p>
						<lable>Total Price</lable>
						<span id="totalprice" style="font-weight: bold">$</span>
						<span>excl GST</span>
					</p>

					<p>
						<input type="button" id="button" name="button" value="Calculate" onclick="fillform()">
						<!--<button id="submit" name="submit" onclick="calculate()" >Calculate</button>-->
					</p>

				</form>
			</div>

		</div>
	</div>


</div>

<script>
	function chkqty() {
		var qty = document.getElementById('qty').value;
		if (isNaN(qty)) {
			alert("please enter numaric value only")
		} else {
			if (qty < 11) {
				alert("value must be grater than 10");
			}
		}

	}

	function chkqtypages() {
		var qtypg = document.getElementById('qty_pages').value;
		if (qtypg % 4 == 0) {

		} else {
			alert('Quantity Pages value Must be divisible by 4');
		}
	}


function fillform(){
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("fillform").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "<?php echo $plugins_url;  ?>/pc/fillform.php", true);
		xmlhttp.send();

}

	function sendemail(email){
		var email = email;
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("response").innerHTML = this.responseText;
			}
		};
		var name = document.getElementById("yname").value;
		xmlhttp.open("GET", "<?php echo $plugins_url;  ?>/pc/sendmail.php?data="+name+'*'+email, true);
		xmlhttp.send();
		//alert('We send email with OTP to verify your email. Please fill the same in OTP field');

	}


	function verifyemail(otp){
		//var otp = otp;
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("response2").innerHTML = this.responseText;
				if (this.responseText == 'Email Verified') {
					calculatethis();
				}
			}
		};
		var name = document.getElementById("schoolName").value;
		xmlhttp.open("GET", "<?php echo $plugins_url;  ?>/pc/verifymail.php?data=" + name + '*' + otp, true);
		xmlhttp.send();
		showcalc();

	}

	function showcalc(){
	}



	//calculatethis();

	function calculatethis() {
		var qty = document.getElementById('qty').value;
		var qtypg = document.getElementById('qty_pages').value;
		var print_qlty = document.getElementById("print_qlty").value;
		var fscpaper = document.getElementById("fscpaper").value;
		var covertype = document.getElementById("covertype").value;
		var binding = document.getElementById("binding").value;
		var hardmat = document.getElementById("hardmat").value;
		var coverlam = document.getElementById("coverlam").value;
		var artwork = document.getElementById("artwork").value;
		var fund = document.getElementById("fundperbook").value;
		var ribbon = document.getElementById("ribbon").value;
		var headbands = document.getElementById("headbands").value;


		// setting values for each variable to calculate finalprice per book.

		/* setup cost */

		var defSetCharge = 100; // per job
		var finalSetupCharge = defSetCharge/qty;


		/* Page Cost */

		var pgCost = qtypg * print_qlty; // per job

		/* Freight */


		var res = covertype.split("*");
		var freight = res[0];


		var res = covertype.split("*");
		//alert(res[1]);
	if(res[1] == 'Soft Cover'){
		var binding = binding;
		var softCover = hardmat;
		var coverLamination = coverlam
		var fArtwork = artwork / qty;
		var fundRasing = fund;


		var totalValperbook = Math.round((+finalSetupCharge + +pgCost + +freight + +binding + +softCover + +coverLamination + +fArtwork + +fundRasing)*100)/100;

		if(fscpaper == 1){
			var perval = (5 / 100) * totalValperbook;

			var finalVal = Math.round((+perval + +totalValperbook)*100)/100;

		}else{
			var finalVal = totalValperbook;
		}

		var totVal = qty * finalVal;

		document.getElementById('totalperbook').innerHTML = '$ '+finalVal;

		document.getElementById('totalprice').innerHTML = '$ '+totVal;
	}


		if(res[1] == 'Hard Cover'){
			var binding = binding;
			var hardCover = hardmat;
			var coverLamination = coverlam
			var fArtwork = artwork / qty;
			var fundRasing = fund;


			if(qty == 10){
				var hardCoverBinding = 48.00;
			}
			if (qty == 20) {
				var hardCoverBinding = 42.00;
			}
			if (qty == 30) {
				var hardCoverBinding = 36.00;
			}
			if (qty == 40) {
				var hardCoverBinding = 30.00;
			}
			if (qty == 50) {
				var hardCoverBinding = 24.00;
			}
			if (qty == 60) {
				var hardCoverBinding = 22.56;
			}
			if (qty == 70) {
				var hardCoverBinding = 21.12;
			}
			if (qty == 80) {
				var hardCoverBinding = 19.68;
			}
			if (qty == 90) {
				var hardCoverBinding = 18.24;
			}
			if (qty >= 100) {
				var hardCoverBinding = 16.80;
			}


			var totalValperbook = Math.round((+finalSetupCharge + +pgCost + +freight + +binding + +hardCover + +coverLamination + +fArtwork + +fundRasing + +hardCoverBinding) * 100) / 100;

			if (fscpaper == 1) {
				var perval = (5 / 100) * totalValperbook;

				var finalVal = Math.round((+perval + +totalValperbook) * 100) / 100;

			} else {
				var finalVal = totalValperbook;
			}

			var totVal = qty * finalVal;

			document.getElementById('totalperbook').innerHTML = '$ ' + finalVal;

			document.getElementById('totalprice').innerHTML = '$ ' + totVal;

		}

	}


	function showfields(str) {
		if (str == "") {
			document.getElementById("changethis").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("changethis").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "<?php echo $plugins_url;  ?>/pc/getdata.php?fld=" + str, true);
			xmlhttp.send();
		}
	}




</script>