<?php
$uploads = wp_upload_dir();
$uploadsurl = $uploads['baseurl'];
$emaildom=""; $youremaildom="";
$emaildom = get_option('pw-settings');  
$emaildom = maybe_unserialize($emaildom);
$youremaildom = "your_".$emaildom['wizard_email_countryvalidation']."_email";
$youremaildom = $emaildom['wizard_email_countryvalidation'];
$dbtestdata = "";
$dbtestdata = get_option('pw-settings');
$dbtestdata = maybe_unserialize($dbtestdata);
$dbtestdata_output = "the database value of testdata setting is ".$dbtestdata["wizard_testdata"];
$dbtestdata_settings = '<a href="#" onclick="copydetails()">Copy dummy test details to form</a>';
$dbjs = PRICEWIZARD_URL."js/pw-form-test-data.js";
if($dbtestdata["wizard_testdata"] ==1 ){
?><script type="text/javascript" src="<?php echo $dbjs; ?>"></script> <?php
$dbtest = $dbtestdata_settings;
}
else
{$dbtest = "";}

?>
<div id="pw-wrapper">
<div id="pw-outer">
<div id="pw-inner">
<form id="mypriceguide" name="priceguideform" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  method="post">
	<table align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<div id="wizard" class="swMain">
					<ul>
						<li>
							<a href="#step-1">
								<span class="stepNumber">1</span>
								<span class="stepDesc">
									Style<br/>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-2">
								<span class="stepNumber">2</span>
								<span class="stepDesc">
									Binding<br/>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-3">
								<span class="stepNumber">3</span>
								<span class="stepDesc">
									Size<br/>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-4">
								<span class="stepNumber">4</span>
								<span class="stepDesc">
									Pages/<br/>Content
								</span>
							</a>
						</li>
						<li>
							<a href="#step-5">
								<span class="stepNumber">5</span>
								<span class="stepDesc">Accessories</span>
							</a>
						</li>
						<li>
							<a href="#step-6">
								<span class="stepNumber">$</span>
								<span class="stepDesc">
									Price
								</span>
							</a>
						</li>
					</ul>
					<div id="step-1">
						<h2 class="StepTitle">Step 1 - Choose a diary style</h2>
						<table>
							<tr valign="top">
								<td>
									<div id="CustomArea">
										<table>
											<tr>
												<td colspan="2" class="wizard_heading">
													<input id="CustomType" type="radio" name="style" value="custom" onclick="setDiaryType()"><span class="wizard_header">Custom</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="padding-right:15px;">
													<span class="wizard_text">Our full custom diaries are individually tailored to meet your needs and requirements. These diaries are best considered as a blank canvas you can design as you wish.<br></span>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<br>
													<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_custom.png" alt="">
												</td>
											</tr>
											<tr align="left">
												<td colspan="2">
													<a title="Example Custom Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom1.jpg" rel="prettyPhoto[gCustomLayouts]">
														<img src="<?php echo PRICEWIZARD_URL; ?>/images/search.jpg" alt="">
													view custom layouts
													</a>													
												</td>
											</tr>
										</table>
									</div>
								</td>
								<td>
									<div id="StandardArea">
										<table>
											<tr>
												<td colspan="2" class="wizard_heading">
													<input id="StandardType" type="radio" name="style" value="standard"  onclick="setDiaryType()" checked><span class="wizard_header">Standard</span>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<span class="wizard_text">Our standard diaries may be personalised with your own artwork. The only component which is standard is the main diary layout.<br></span>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<br>
													<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_standard.png" alt="">
												</td>
											</tr>
											<tr align="left">
												<td colspan="2">
													<a title="Visual Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_visual.jpg" rel="prettyPhoto[gStandardLayouts]">
														<img src="<?php echo PRICEWIZARD_URL; ?>/images/search.jpg" alt="">
													view standard layouts
													</a>													
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div id="step-2">
						<h2 class="StepTitle">Step 2 - Choose covers<span style="font-size:10px;"> (Note: Options vary according to choice of Diary Style)</span></h2>
						<table>
							<tr valign="top">
								<td>
									<div id="SpiralBoundArea">
										<table>
											<tr>
												<td colspan="2">		
													<input type="radio" name="cover_type" value="spiral" onclick="setAccessoriesType()"
														   checked><span class="wizard_header">Spiral Bound</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="padding-right:15px;">
												<p>Spiral Bound diaries feature a robust plastic spiral binding that stands up to the wear and tear of any student. Our plastic spiral is crush proof!</p>
												<p>Covers can be printed in full colour on laminated card stock or a durable PVC in a range of colours with your logo printed on it.</p>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_spiral.png" alt="" >
												</td>
											</tr>
											<tr>
												<td>
													<strong>Spiral Covers</strong>
												</td>
												<td>
													<select name="spiralcovertype">
														<option value="spiral_card" selected>300gsm Card</option>
														<option value="spiral_pvc">PVC</option>
													</select><br/>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div id="spiralCoverArea">
														<table>
															<tr>
																<td>
																	<input type="radio" name="spiralCustomFront" value="Custom_Front"
																		   checked>Custom Front
																</td>
																<td>
																	<input type="radio" name="spiralCustomFront" value="Custom_Front_and_Inside">Custom Front & Inside
																</td>
															</tr>
															<tr>
																<td>
																	<input type="radio" name="spiralCustomBack" value="Standard_Back" checked>Standard Back
																</td>
																<td>
																	<input type="radio" name="spiralCustomBack" value="Custom_Back">Custom
																	Back
																</td>
															</tr>
														</table>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</td>
								<td>
									<div id="BookBoundArea">
										<table>
											<tr>
												<td colspan="2">
													<input type="radio" name="cover_type" value="book"
														   onclick="setAccessoriesType()"><span class="wizard_header">Book Bound</span>
												</td>
											</tr>
											<tr>
												<td colspan="2">
												<p>Book bound diaries are stylishly elegant, yet sturdy. They have section-sewn pages, head/tail bands and a book-marking ribbon.</p>
												<p>The cover can be full-colour custom artwork. Or you can choose to have your logo stamped in gold or silver.</p>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_book.png" alt="" >
												</td>
											</tr>
											<tr>
												<td>
													<strong>Cover Style</strong>
												</td>
												<td>
													<select name="bookcovertype">
														<option value="book_vinyl" selected>Vinyl-Stamped</option>
														<option value="book_printed" >Printed</option>
													</select><br/>
												</td>
											</tr>
											<tr>
												<td>
													<b> Inside Front Cover</b>
												</td>
												<td>
													<input type="checkbox" name="book_custom_front_cover">
												</td>
											</tr>
											<tr>
												<td>
													<b>Inside Back Cover</b>
												</td>
												<td>
													<input type="checkbox" name="book_custom_back_cover">
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div id="step-3">
						<h2 class="StepTitle">Step 3 - Pick Sizes</h2>
						<div id="SizeArea">
							<table>
								<tr>
									<td valign="top">
										Generally diaries are available in 2 sizes:<br/>&emsp;<br/>

										&emsp; - A5 (141 x 210mm) - our most popular size <br>
										&emsp; - B5 (176 x 250mm)<br>&emsp;<br/>&emsp;<br/>
										A custom diary can be printed to almost any other size.<br/>&emsp;<br/>&emsp;<br/>
<table>
<tr>
	<td>
		A5 (small)
	</td>
	<td style="padding-left:10px;">
		<input type="radio" name="diary_size" value="A5" checked />
	</td>
</tr>
<tr>
	<td>
		B5 (medium)
	</td>
	<td style="padding-left:10px;">
		<input type="radio" name="diary_size" value="B5" />
	</td>
</tr>
</table>										
									

									</td>
									<td valign="bottom">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_a5.png" alt="">
										<br/><strong>A5</strong>
									</td>
									<td valign="bottom">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_b5.png" alt="" >
										<br/><strong>B5</strong>
									</td>
									<td>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id="step-4">
						<h2 class="StepTitle">Step 4 - Pages/Content <span style="font-size:10px;"> (Note: Options vary according to choice of Diary Style)</span></h2>
						<div id="CustomPagesArea" style="display: none">
							<table>
								<tr>
									<td class="wizard_heading">
										<span class="wizard_header">INFORMATION PAGES</span>
									</td>
									<td align="right">
										<select  id="yourdiarystyle" name="cmbIPPagesCustom">
											<option value="96" selected>96</option>
											<option value="128">128</option>
										</select>
										<br/>
										<select  id="yourdiarypages" name="custompagecolours">
											<option value="one" selected>1 Colour</option>
											<option value="two">2 Colour</option>
											<option value="full">Full Colour</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										Custom diaries may have as many information pages as you desire and can be printed in any colour or
										on any stock providing you with endless options.<br><br>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_pages_custom.png" alt="">
									</td>
								</tr>
							</table>
						</div>
						<div id="StandardPagesArea">
							<table>
								<tr>
									<td class="wizard_heading">
										<span class="wizard_header">INFORMATION PAGES</span>
									</td>
									<td align="right">
										<div id="stdInfoPages">
											<select name="cmbIPPagesStandard">
												<option value="0">0</option>
												<option value="4" selected>4</option>
												<option value="8">8</option>
												<option value="16">16</option>
												<option value="32">32</option>
											</select>
										</div>
									</td>
									<td class="wizard_heading">
										<span class="wizard_header">DAILY DIARY PAGES</span>
									</td>
									<td align="right">
										<input type="checkbox" name="dateentries" value="yes">
									</td>
								</tr>
								<tr>
									<td colspan="2" style="padding-right:15px;">
										You may include as many pages of your own information as you like within our standard diaries, bind
										some at the front and others at the back - it's your choice!<br><br>
									</td>
									<td colspan="2">
										Standard diaries allow for the inclusion of timely reminders for students of upcoming events such as
										'Pupil Free Day' or 'Sports Carnival' within the daily diary layout.<br><br>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_pages_std.png" alt="" >
									</td>
									<td colspan="2">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_entries_std.png" alt="" >
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id="step-5">
						<h2 class="StepTitle">Step 5 - Accessories</h2>

						<div id="SpiralAccessoriesArea">
							<table cellspacing="5">
								<tr>
									<td COLSPAN="6">
										<b>SPIRAL BOUND ACCESSORIES</b>
									</td>
								</tr>
								<tr valign="top">
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_reference.jpg" alt="" >
									</td>
									
									<td style="width:170px">
										<span style="margin-left:5px;"><strong>Reference Pages</strong></span>
										<p style="margin-left:5px;">High School version has 32 pages and Primary has 16 pages.</p>
									</td><td>
										<input type="checkbox" name="spiral_refpages">
									</td>
									
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_sleevespiral.jpg" alt="">
									</td>
									<td style="width:170px">
										<strong>Plastic Sleeve</strong><br>
										A plastic sleeve is a great place to carry CD's or DVD's and important documents with safety.
									</td>
									<td>
										<input type="checkbox" name="spiral_plastic_sleeve">
									</td>
								</tr>
								<tr valign="top">
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_protector.jpg" alt="">
									</td>
									
									<td style="width:170px">
										<strong>Cover Protectors</strong><br>
										Translucent acetate sheets protect the diary covers both front and back and enhance durability.
									</td><td>
										<input type="checkbox" name="spiral_coverprotector">
									</td>
									
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_jacket.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Plastic Jacket</strong><br>
										To protect your diary from wear and tear you may decide to have a clear PVC Jacket which your diary
										is inserted into.
									</td>
									<td>
										<input type="checkbox" name="spiral_plastic_jacket">
									</td>
								</tr>
								<tr valign="top">
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_ruler.jpg" alt="" >
									</td>
									
									<td style="width:170px">
										<strong>Ruler</strong><br>
										The ruler can act as a 2 ring binder holder as well as a diary bookmark.
														<td>
										<input type="checkbox" name="spiral_ruler">
									</td>				</td>

									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_stickers.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Stickers</strong><br>
										A page of sticker to mark particular days and dates.
									</td>
									<td>
										<input type="checkbox" name="spiral_stickers">
									</td>
								</tr>
							</table>
						</div>
						<div id="BookAccessoriesArea" style="display: none">
							<table cellspacing="5">
								<tr>
									<td COLSPAN="6">
										<b>BOOK BOUND ACCESSORIES</b>
									</td>
								</tr>
								<tr valign="top">
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_reference.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Reference Pages</strong><br>
										We have two packages of handy reference pages you can choose to include in your diary. The high school version includes 32
										pages, whilst the primary version includes 16.
									</td>
									<td>
										<input type="checkbox" name="book_refpages">
									</td>
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_sleevebook.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Plastic Sleeve</strong><br>
										A plastic sleeve is a great place to carry CD's or DVD's and important documents with safety. 
									</td>
									<td>
										<input type="checkbox" name="book_plastic_sleeve">
									</td>
								</tr>
								<tr valign="top">
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_corners.jpg" alt="">
									</td>
									<td style="width:170px">
										<strong>Metal Corners</strong><br>
										Metal corners on the front cover enhance style and durability. Available in Silver or Gold
									</td>
									<td>
										<input type="checkbox" name="book_metal_corners">
									</td>
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_jacket.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Plastic Jacket</strong><br>
										To protect your diary from wear and tear you may decide to have a clear PVC Jacket which your diary
										is inserted into.
									</td>
									<td>
										<input type="checkbox" name="book_plastic_jacket">
									</td>
								</tr>
								<tr valign="top">
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_edges.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Glided Edges</strong><br>
										Give your diary distinction and sophistication with glided page edges. Available in Silver or Gold.
									</td>
									<td>
										<input type="checkbox" name="book_gilded_edges">
									</td>
									<td style="width:170px">
										<img style="border:0px solid black;" src="<?php echo $uploadsurl; ?>/pricewizard/wizard_acc_stickers.jpg" alt="" >
									</td>
									<td style="width:170px">
										<strong>Stickers</strong><br>
										A page of stickers can be included to mark particular days and dates. With a number of smiley faces
										included they can be fun for students to add to their diary.
									</td>
									<td>
										<input type="checkbox" name="book_stickers">
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id="step-6">
						<h2 class="StepTitle">Calculate Price</h2>
						<table>
							<tr>
								<th colspan="2">	
								</th>
							</tr>
							<tr>
								<td>
									<strong>School Name</strong>
								</td>
								<td>
									<input id="txtSchoolName" class="myschool" type="text" name="your_school" onchange="chkschoolname();">
								</td>
							</tr>
							<tr>
								<td>
									<strong>Your Name</strong>
								</td>
								<td>
									<input id="txtName" class="myname" type="text" name="your_name">
								</td>
							</tr>
							<tr>
								<td>
									<strong>School email address</strong>
								</td>
								<td>
									<input type="text" id="txtEmail" class="myemail" name="your_email" >
								</td>
							</tr>
							<tr>
								<td>
									Contact number (optional)
								</td>
								<td>
									<input id="txtPhone" class="myphone" type="text" name="your_phone" size="14">
								</td>
							</tr>
							<tr>
								<td>
									<strong>Quantity</strong>
								</td>
								<td>
									<?php //include('prices_select_qty_options.php'); ?>
									<div id="customQuantity" style="display: none">
										<select name="customQuantity">
											<option>250</option>
											<option selected>500</option>
											<option>750</option>
											<option>1000</option>
											<option>1250</option>
											<option>1500</option>
										</select>
									</div>
									<div id="standardQuantity">
										<select name="standardQuantity">
											<option>20</option>
											<option>50</option>
											<option>100</option>
											<option>150</option>
											<option>200</option>
											<option>250</option>
											<option>300</option>
											<option>400</option>
											<option selected>500</option>
											<option>600</option>
											<option>700</option>
											<option>800</option>
											<option>900</option>
											<option>1000</option>
											<option>1250</option>
											<option>1500</option>
											<option>2000</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									Email me the quote (optional)
								</td>
								<td>
									<input type="checkbox" id="emailchoice" name="chkEmailQuote" onchange="updBtnLabel();">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="rsvErrors1">
										<h4>Yikes! There's some info missing... <br/>Would you fix up the items on the list below, then click the 'Get a quote' button again.</h4>
										<ol></ol>
									</div>
								</td>
							</tr>
							<tr>
								<td><?php  echo $dbtest; ?></td>
								<td valign="middle"><div style="float:left;">
									<input type="hidden" id="yoursubmissiondate" name="submissiondate" value="<?php date_default_timezone_set('Australia/Sydney');echo date("Y-m-d H:i:s"); ?>"/>
									<input type="hidden" id="yourvisitorip" name="visitorip" value="<?php getIp(); ?>"/>
									<input type="hidden" id="youraction" name="action" value="sd_priceguide_action"/>
									<input type="hidden" id="dbstatus" name="dbupdate" value="0"/>
									<input type="hidden" id="emaildomain" name="emaildomain" value="<?php echo $youremaildom; ?>"/>
									<input type="hidden" id="yourvalidform" name="validform" value=0 />
									<input type="hidden" id="submittedBy" name="submittedBy"/>
									<input type="hidden" id="emailrequeststatus" name="emailrequest" value="no" />
									<input type="submit" id="update" name="update" value="Get a Quote" />
									</div>
									<div>
										<img class="ajax-loader" style="visibility: hidden; padding-left:20px;padding-top:4px;" alt="Sending ..." src="<?php echo PRICEWIZARD_URL; ?>/images/gif-load.gif" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<div id="pwquoteoutput">
									<div id="quotesummary"></div>
									</div>
								</td>
							</tr>

						</table>
					</div>
				</div>
			</td>
		</tr>
	</table>
</form>
</div><!-- end of inner -->
</div><!-- end of outer -->
</div><!-- end of wrapper -->
<div id="result"><span class="list_style"></span></div>


<!-- prettyphoto overlays -->
	<div style="display: none;">
		<!-- gCustomLayouts -->
		<a title="Blackfriar's Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom2.jpg" rel="prettyPhoto[gCustomLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom2.jpg" alt="" />
		</a>
		<a title="Alsadiq's Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom3.jpg" rel="prettyPhoto[gCustomLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom3.jpg" alt=""/>
		</a>
		<a title="Morayfield's Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom4.jpg" rel="prettyPhoto[gCustomLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom4.jpg" alt=""/>
		</a>
		<a title="Maleny's Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom5.jpg" rel="prettyPhoto[gCustomLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom5.jpg" alt=""/>
		</a>
		<a title="Ormiston's Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom6.jpg" rel="prettyPhoto[gCustomLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_custom6.jpg" alt=""/>
		</a>
		<!-- gStandardLayouts -->
		<a title="Academic Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_academic.jpg" rel="prettyPhoto[gStandardLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_academic.jpg" alt="" />
		</a>
		<a title="Communication Layout" href="<?php echo $uploadsurl; ?>/prettyphoto/layout_communication.jpg" rel="prettyPhoto[gStandardLayouts]">
			<img style="border: 1px solid black;" src="<?php echo $uploadsurl; ?>/prettyphoto/layout_communication.jpg" alt="" />
		</a>
	</div>