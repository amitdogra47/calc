	jQuery(document).ready(function($) {
		$(document).ready(function () {
			// Smart Wizard
			$('#wizard').smartWizard({transitionEffect: 'slideleft'});
		});
	});
	
	function updBtnLabel() {
		if (document.getElementsByName("chkEmailQuote")[0].checked) {
        document.getElementById('update').value = "Get a Quote and Email me";
				document.priceguideform.emailrequest.value = "yes";
    } else {
        document.getElementById('update').value = "Get a Quote";
				document.priceguideform.emailrequest.value = "no";
     }
   }
	 
	function setDiaryType() {
		if (document.getElementsByName("style")[0].checked) {
			document.getElementById("CustomPagesArea").style.display = 'block';
			document.getElementById("StandardPagesArea").style.display = 'none';
		}
		else {
			document.getElementById("CustomPagesArea").style.display = 'none';
			document.getElementById("StandardPagesArea").style.display = 'block';
		}
		checkCoverPrinting();
		checkQuantity();
	}

	function setAccessoriesType() {
		if (document.getElementsByName("cover_type")[0].checked) {
			document.getElementById("SpiralAccessoriesArea").style.display = 'block';
			document.getElementById("BookAccessoriesArea").style.display = 'none';

			if (!document.getElementsByName("cover_type")[0].checked) {
				document.getElementById("spiralCoverArea").style.display = 'block';
			}
			
		}
    else {
			document.getElementById("SpiralAccessoriesArea").style.display = 'none';
			document.getElementById("BookAccessoriesArea").style.display = 'block';
     }
     checkCoverPrinting();
   }

	function checkCoverPrinting() {
		if (document.getElementsByName("style")[0].checked) {
			document.getElementById("spiralCoverArea").style.display = 'none';
		} 
		else {
			document.getElementById("spiralCoverArea").style.display = 'block';
		}
	}

  function checkInfoPages() {
		if (document.getElementsByName("style")[0].checked) {
			document.getElementById("stdInfoPages").style.display = 'block';
		} 
		else {
			document.getElementById("stdInfoPages").style.display = 'none';
		}
	}

  function checkPageSize() {
		if (document.getElementsByName("style")[0].checked) {
			document.getElementById("CustomPageSize").style.display = 'block';
			document.getElementById("StandardPageSize").style.display = 'none';
		} 
		else {
			document.getElementById("CustomPageSize").style.display = 'none';
			document.getElementById("StandardPageSize").style.display = 'block';
		}
	}

  function checkQuantity() {
		if (document.getElementsByName("style")[0].checked) {
			document.getElementById("customQuantity").style.display = 'block';
			document.getElementById("standardQuantity").style.display = 'none';
		} 
		else {
			document.getElementById("customQuantity").style.display = 'none';
			document.getElementById("standardQuantity").style.display = 'block';
		}
	}