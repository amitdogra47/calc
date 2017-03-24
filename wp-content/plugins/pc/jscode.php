<?php

$dirname = dirname ( __FILE__ );
$root    = false !== mb_strpos ( $dirname , 'wp-content' ) ? mb_substr (
	$dirname , 0 , mb_strpos ( $dirname , 'wp-content' )
) : $dirname;
?>

<script>


</script>


<!--  tool tip js-->
<script>
	var j = jQuery.noConflict();
	j(function () {
		j('[data-toggle="tooltip"]').tooltip()
	})

</script>
<!--  tool tip js  End-->





<script>

function sendemail(totVal, finalVal) {
	var perbook = finalVal;
	var totalval = totVal;
	var qty = document.getElementById('qty').value;
	var qty_pages = document.getElementById('qty_pages').value;
	var print_qlty = document.getElementById('print_qlty').options[document.getElementById('print_qlty').selectedIndex].text;
	if (document.getElementById('fscpaper').checked) {
		var fscpaper =  'Yes';
	} else {
		var fscpaper =  'No';
	}

	var covertype = document.getElementById('covertype').options[document.getElementById('covertype').selectedIndex].text;

	if(covertype == 'Hard Cover'){
		binding = document.getElementById('bindingH').options[document.getElementById('bindingH').selectedIndex].text;
		coverMat = document.getElementById('hardmatH').options[document.getElementById('hardmatH').selectedIndex].text;
	}
	if (covertype == 'Soft Cover') {
		var binding = document.getElementById('binding').options[document.getElementById('binding').selectedIndex].text;
		if (document.getElementById("coverlams1").checked) {
			var coverlam = 'Single Sided';
		}
		if (document.getElementById("coverlams2").checked) {
			var coverlam = 'Double Sided';
		}
	}

	var artwork = document.getElementById('artwork').options[document.getElementById('artwork').selectedIndex].text;
	var fundperbook = document.getElementById('fundperbook').value;

	if (fundperbook) {
		//do something
	}else{
		fundperbook = '0.00';
	}

	if (document.getElementById('sendoption').checked) {
		var sendoption =  'Yes';
	} else {
		var sendoption = 'No';
	}

	if (document.getElementById('sendoptionh').checked) {
		var sendoptionh = 'Yes';
	} else {
		var sendoptionh = 'No';
	}

	var ribbon = document.getElementById('ribbon').options[document.getElementById('ribbon').selectedIndex].text;
	var headbands = document.getElementById('headbands').options[document.getElementById('headbands').selectedIndex].text;
	var yname = document.getElementById('yname').value;
	var sname1 = document.getElementById("sname1").value;
	var schoolName = document.getElementById('schoolName').value;
	var cnumber = document.getElementById('cnumber').value;

	if (document.getElementById('sendcopy').checked) {
		var sendcopy = 'Yes';
	} else {
		var sendcopy = 'No';
	}

	var cnumber = document.getElementById('cnumber').value;



	/*console.log(qty + ' qty');
	console.log(qty_pages + ' qty_pages');
	console.log(print_qlty + ' print_qlty');
	console.log(fscpaper + ' fscpaper');
	console.log(covertype + ' covertype');
	console.log(binding + ' binding');
	console.log(coverlam + ' coverlam');
	console.log(bindingH + ' bindingH');
	console.log(hardmatH + ' hardmatH');
	console.log(artwork + ' artwork');
	console.log(fundperbook + ' fundperbook');
	console.log(sendoption + ' sendoption');
	console.log(ribbon + ' ribbon');
	console.log(headbands + ' headbands');
	console.log(yname + ' yname');
	console.log(schoolName + ' schoolName');
	console.log(cnumber + ' cnumber');
	console.log(sendcopy + ' sendcopy');*/
	var perbook = finalVal;
	var totalval = totVal;

	if (covertype == 'Hard Cover') {
		 var data = qty + '*' +qty_pages + '*' + print_qlty +'*' + fscpaper +'*' + covertype +'*' + binding +'*' + coverMat +'*' + artwork +'*' + fundperbook +'*' + ribbon +'*' + headbands +'*' + yname +'*' + schoolName +'*' + cnumber +'*' + sendcopy + '*' + perbook+
		'*' + totalval + '*' + sendoptionh+'*'+ sname1;
	}

	if (covertype == 'Soft Cover') {
		var data = qty + '*' + qty_pages + '*' + print_qlty + '*' + fscpaper + '*' + covertype + '*' + binding + '*' + coverlam + '*' + artwork + '*' + fundperbook + '*' + sendoption + '*'  + yname + '*' + schoolName + '*' + cnumber + '*' + sendcopy + '*' + perbook+
		'*' + totalval + '*' + sname1;
	}




	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("sendmailresponse").innerHTML = this.responseText;
			document.getElementById('sendmaildiv').style.display = "block";

		}
	};
	xmlhttp.open("GET", "<?php echo $plugins_url;  ?>/pc/sendmail.php?data=" + data, true);
	xmlhttp.send();


}


</script>