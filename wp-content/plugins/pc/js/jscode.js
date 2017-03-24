var a = jQuery.noConflict();
a(document).ready(function () {
    a("#covertype").imagepicker({
        hide_select: true,
        show_label: true
    });

    a("#binding").imagepicker({
        hide_select: true,
        show_label: true
    });

    a("#hardmat").imagepicker({
        hide_select: true,
        show_label: true
    });
});


var aa = jQuery.noConflict();
a(document).ready(function () {
    aa("#covertypeH").imagepicker({
        hide_select: true,
        show_label: true
    });

    aa("#bindingH").imagepicker({
        hide_select: true,
        show_label: true
    });

    aa("#hardmatH").imagepicker({
        hide_select: true,
        show_label: true
    });
});

var aaa = jQuery.noConflict();
aaa(document).ready(function () {
    aaa('#button').attr('disabled', true);
    aaa("#button").attr('class', 'disbuttond');
    aaa('#schoolName').keyup(function () {
        if (aaa(this).val().length != 0) {
            aaa('#button').attr('disabled', false);
            aaa("#button").attr('class', 'disbutton');
        } else {
            aaa('#button').attr('disabled', true);
            aaa("#button").attr('class', 'disbuttond');
        }
    })
});

var aaaa = jQuery.noConflict();
aaaa(function () {
    aaaa(this).bind("contextmenu", function (e) {
        e.preventDefault();
    });
});









function renamebtn(){
    var htmlstring = document.getElementById('totalperbook').innerHTML;
    htmlstring = (htmlstring.trim) ? htmlstring.trim() : htmlstring.replace(/^\s+/, '');
    if (htmlstring != '') {
        document.getElementById('button').value = "Recalculate";
    }

}


function chkqty() {
    var qty = document.getElementById('qty').value;
    if (isNaN(qty)) {
        document.getElementById('error1').style.display = 'block';
        document.getElementById('qty').value = '';
    } else {
        if (qty <= 9 || qty.length <= 1) {
            document.getElementById('error2').style.display = 'block';
            document.getElementById('qty').value = '';
        }
    }
    console.log(qty);
    if (qty >= 10) {

        document.getElementById('error1').style.display = 'none';
        document.getElementById('error2').style.display = 'none';
    }

}

function chkqtypages() {
    var qtypg = document.getElementById('qty_pages').value;
    if (qtypg % 4 == 0) {
        document.getElementById('error3').style.display = 'none';
    } else {
        document.getElementById('error3').style.display = 'block';
        document.getElementById('qty_pages').value = '';
    }

    disableSaddle(qtypg);
}


function disableSaddle(qtypg) {
    var qtypges = qtypg;

    if (qtypges > 64) {
        //var myOpts = document.getElementById('binding').options[0].disabled = true;
        /*var myOpts = document.getElementById('binding').selectedIndex = 0;*/
        document.getElementById('saddledis').style.display = 'block';

        //console.log(myOpts + ' myOpts');

    } else {
        //var myOpts = document.getElementById('binding').options[0].disabled = false;
        //var myOpts = document.getElementById('binding').options[1].selected = false;
        document.getElementById('saddledis').style.display = 'none';
    }
}


/* show hide block for soft and hard cover */
function showBlock(optionis) {
    var optionis;
    var res = optionis.split("*");
    if (res[1] == 'Soft Cover') {
        document.getElementById('softcover').style.display = "block";
        document.getElementById('forsoftcover').style.display = "block";
        document.getElementById('softTitle').style.display = "block";
        document.getElementById('hardcover').style.display = "none";
        document.getElementById('forhardcover').style.display = "none";
        document.getElementById('hardTitle').style.display = "none";

        var htmlstring = document.getElementById('totalperbook').innerHTML;
        htmlstring = (htmlstring.trim) ? htmlstring.trim() : htmlstring.replace(/^\s+/, '');
        if(htmlstring != ''){
            document.getElementById('button').value = "Recalculate";
        }
    }

    if (res[1] == 'Hard Cover') {
        document.getElementById('softcover').style.display = "none";
        document.getElementById('forsoftcover').style.display = "none";
        document.getElementById('softTitle').style.display = "none";
        document.getElementById('hardcover').style.display = "block";
        document.getElementById('forhardcover').style.display = "block";
        document.getElementById('hardTitle').style.display = "block";

        var htmlstring = document.getElementById('totalperbook').innerHTML;
        htmlstring = (htmlstring.trim) ? htmlstring.trim() : htmlstring.replace(/^\s+/, '');
        if (htmlstring != '') {
            document.getElementById('button').value = "Recalculate";
        }
    }
}


function checkEmail() {

    var email = document.getElementById('schoolName');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        document.getElementById('error10').style.display = 'block';
        document.getElementById("schoolName").focus();
        return false;
    } else {
        document.getElementById('error10').style.display = 'none';
        document.getElementById("schoolName").focus();
        return true;
    }
}


function thousandSep(val) {
    return String(val).split("").reverse().join("")
        .replace(/(\d{3}\B)/g, "$1,")
        .split("").reverse().join("");
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

    var artwork = document.getElementById("artwork").value;
    var fund = document.getElementById("fundperbook").value;
    var ribbon = document.getElementById("ribbon").value;
    var headbands = document.getElementById("headbands").value;

    var yname = document.getElementById("yname").value;
    var schoolName = document.getElementById("schoolName").value;
    var sname1 = document.getElementById("sname1").value;


    if (document.getElementById("coverlams1").checked) {
        var coverlam = document.getElementById("coverlams1").value;
    }
    if (document.getElementById("coverlams2").checked) {
        var coverlam = document.getElementById("coverlams2").value;
    }


    /* ***** Validation start here ****** */
    var flag = 0;
    var response = grecaptcha.getResponse();

    if (qty == '') {
        document.getElementById('error2').style.display = 'block';
        document.getElementById("qty").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error2').style.display = 'none';
        flag = parseInt(flag) + 0;
    }

    if (qtypg == '') {
        document.getElementById('error3').style.display = 'block';
        document.getElementById("qty_pages").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error3').style.display = 'none';
        flag = parseInt(flag) + 0;
    }


    if (print_qlty == '') {
        document.getElementById('error4').style.display = 'block';
        document.getElementById("print_qlty").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error4').style.display = 'none';
        flag = parseInt(flag) + 0;
    }

    if (artwork == '') {
        document.getElementById('error5').style.display = 'block';
        document.getElementById("artwork").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error5').style.display = 'none';
        flag = parseInt(flag) + 0;
    }

    if (ribbon == '') {
        document.getElementById('error6').style.display = 'block';
        document.getElementById("ribbon").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error6').style.display = 'none';
        flag = parseInt(flag) + 0;
    }
    if (headbands == '') {
        document.getElementById('error7').style.display = 'block';
        document.getElementById("headbands").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error7').style.display = 'none';
        flag = parseInt(flag) + 0;
    }

    if (yname == '') {
        document.getElementById('error8').style.display = 'block';
        document.getElementById("yname").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error8').style.display = 'none';
        flag = parseInt(flag) + 0;
    }


    if (sname1 == '') {
        document.getElementById('error12').style.display = 'block';
        document.getElementById("sname1").focus();
        flag = parseInt(flag) + 1;
    } else {
        document.getElementById('error12').style.display = 'none';
        flag = parseInt(flag) + 0;
    }

    if (schoolName == '') {
        document.getElementById('error9').style.display = 'block';
        document.getElementById("schoolName").focus();
        flag = parseInt(flag) + 1;
    } else {

        var atpos = schoolName.indexOf("@");
        var dotpos = schoolName.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= schoolName.length) {
            document.getElementById('error9').style.display = 'block';
            flag = parseInt(flag) + 1;
        } else {
            document.getElementById('error9').style.display = 'none';
            flag = parseInt(flag) + 0;
        }


    }


    if (response.length == 0) {
        document.getElementById('reCaptcha').style.display = 'block';
        flag = parseInt(flag) + 1;
    } else {
        flag = parseInt(flag) + 0;
    }
    console.log(flag + '  flag');

    if (flag > 0) {
        //document.getElementById('noofissue').innerHTML = "total number of issue in form "+flag;
        document.getElementById('issuein').style.display = 'block';
        document.getElementById('finalpriceis').style.display = 'none';
    } else {
        // setting values for each variable to calculate finalprice per book.

        /* setup cost */

        var defSetCharge = 100; // per job
        var finalSetupCharge = defSetCharge / qty;


        /* Page Cost */

        var pgCost = qtypg * print_qlty; // per job

        /* Freight */


        var res = covertype.split("*");
        var freight = res[0];


        var res = covertype.split("*");
        //alert(res[1]);
        if (res[1] == 'Soft Cover') {
            var binding = binding;
            var softCover = hardmat;
            var coverLamination = coverlam
            var fArtwork = artwork / qty;
            var fundRasing = fund;
            var extradiff = 0;
            var artworkHvus = document.getElementById('artwork').options[document.getElementById('artwork').selectedIndex].text;
            if (artworkHvus == 'Have us do it') {
                if (qtypg > 100) {
                    var qtydif = qtypg - 100;
                    extradiff = (qtydif * 10) / qty;
                    //alert(extradiff+'---');
                }
            }

            /*console.log(qty + 'qty');
             console.log(qtypg + 'qtypg');
             console.log(print_qlty + 'print_qlty');
             console.log(fscpaper + 'fscpaper');
             console.log(covertype + 'covertype');
             console.log(binding + 'binding');
             console.log(hardmat + 'hardmat');
             console.log(coverlam + 'coverlam');
             console.log(artwork + 'artwork');
             console.log(fund + 'fund');
             console.log(ribbon + 'ribbon');
             console.log(headbands + 'headbands');*/

            var totalValperbook = Math.round((+finalSetupCharge + +pgCost + +freight + +binding + +softCover + +coverLamination + +fArtwork + +fundRasing + +extradiff) * 100) / 100;


           /* console.log(finalSetupCharge + 'finalSetupCharge');
             console.log(pgCost + 'pgCost');
             console.log(freight + 'freight');
             console.log(binding + 'binding');
             console.log(softCover + 'softCover');
             console.log(coverLamination + 'coverLamination');
             console.log(fArtwork + 'fArtwork');
             console.log(fundRasing + 'fundRasing');
             console.log(extradiff + 'extradiff');*/


            if (document.getElementById('fscpaper').checked) {
                var perval = (5 / 100) * totalValperbook;

                var finalVal = Math.round((+perval + +totalValperbook) * 100) / 100;

            } else {
                var finalVal = totalValperbook;
            }

            var totVal = qty * finalVal;

            var formatedfinalVal = numeral(finalVal).format('0,0.00');
            var formatedTotalVal = numeral(totVal).format('0,0.00');

           // var formatedfinalVal = thousandSep(finalVal);

           // var formatedTotalVal = thousandSep(totVal);

            document.getElementById('totalperbook').innerHTML = '$' + formatedfinalVal;

            document.getElementById('totalprice').innerHTML = '$' + formatedTotalVal;
            ;
            document.getElementById('finalpriceis').style.display = "block";
            document.getElementById('issuein').style.display = "none";
            sendemail(formatedTotalVal, formatedfinalVal);
        }
        /* soft cover end*/


        if (res[1] == 'Hard Cover') {
            var binding = document.getElementById("bindingH").value;
            var hardCover = document.getElementById("hardmatH").value;
            var coverLamination = document.getElementById("coverlamH").value;

            var fArtwork = artwork / qty;
            var fundRasing = fund;
            var extradiff = 0;
            var hrdstampingoverbord = 0;
            if (document.getElementById("ribbon").value == 1) {
                var ribbon = 1.20;
            }
            if (document.getElementById("headbands").value == 1) {
                var headbands = 1.20;
            }


            var artworkHvus = document.getElementById('artwork').options[document.getElementById('artwork').selectedIndex].text;
            if (artworkHvus == 'Have us do it') {
                if (qtypg > 100) {
                    var qtydif = qtypg - 100;
                    extradiff = (qtydif * 10) / qty;
                    //alert(extradiff);
                }
            }


            var hardstamping = document.getElementById('hardmatH').options[document.getElementById('hardmatH').selectedIndex].text;
            if (hardstamping == 'Material with Stamping over Board') {
                hrdstampingoverbord = 168 / qty;
                coverLamination = 0;
            }

            if (qty == 10) {
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

            /*console.log(qty + 'qty');
             console.log(qtypg + 'qtypg');
             console.log(print_qlty + 'print_qlty');
             console.log(fscpaper + 'fscpaper');
             console.log(covertype + 'covertype');
             console.log(binding + 'binding');
             console.log(hardmat + 'hardmat');
             console.log(coverlam + 'coverlam');
             console.log(artwork + 'artwork');
             console.log(fund + 'fund');
             console.log(ribbon + 'ribbon');
             console.log(headbands + 'headbands');
             console.log('###############');*/

            var totalValperbook = Math.round((+finalSetupCharge + +pgCost + +freight + +binding + +coverLamination + +hardCover + +hrdstampingoverbord + +fArtwork + +fundRasing + +hardCoverBinding + +ribbon + +headbands + +extradiff) * 100) / 100;

           /* console.log(finalSetupCharge + ' finalSetupCharge');
            console.log(pgCost + ' pgCost');
            console.log(freight + ' freight');
            console.log(binding + ' binding');
            console.log(coverLamination + ' coverLamination');
            console.log(hardCover + ' hardCover');
            console.log(hrdstampingoverbord + ' hrdstampingoverbord');
            console.log(fArtwork + ' fArtwork');
            console.log(fundRasing + ' fundRasing');
            console.log(hardCoverBinding + ' hardCoverBinding');
            console.log(ribbon + ' ribbon');
            console.log(headbands + ' headbands');
            console.log(extradiff + ' extradiff');*/


            console.log(totalValperbook + '  total v p b');
            if (document.getElementById('fscpaper').checked) {
                var perval = (5 / 100) * totalValperbook;

                var finalVal = Math.round((+perval + +totalValperbook) * 100) / 100;

            } else {
                var finalVal = totalValperbook;
            }
            /*console.log(qty + ' qty');
             console.log(finalVal + ' finalVal');*/
            var totVal = qty * finalVal;


            var formatedfinalVal = numeral(finalVal).format('0,0.00');
            var formatedTotalVal = numeral(totVal).format('0,0.00');

            document.getElementById('totalperbook').innerHTML = '$ ' + formatedfinalVal;

            document.getElementById('totalprice').innerHTML = '$ ' + formatedTotalVal;
            document.getElementById('finalpriceis').style.display = "block";
            document.getElementById('issuein').style.display = "none";

            sendemail(formatedTotalVal, formatedfinalVal);

        }
        /* hard cover end*/

        var aa = jQuery.noConflict();
       /* aa('pcfrontcalc :input').change(function () {
            console.log('change btn')
            aa("#button").prop('value', 'Recalculate');
        });*/

        aa("#pcfrontcalc :input").change(function () {
            console.log(aa(this).attr('name'));
        });

    }
    /*flag end here*/
}

