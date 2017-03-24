<div class="wrap">
	<table class="form-table">
		<tr>
			<td>
				<strong>Form layout: </strong>The Price Wizard is built in a form. A single plugin file "form-layout/pw-form-layout.php" contains the layout details.
				<p>The plugin assumes that the wizard is enabled on a page template. To create the wizard, insert the function call "forminsert_wizard();" in the page.</p>
			</td>
		</tr>
		<tr>
			<td><strong>Smart Wizard: </strong>The main component of the plugin is <strong>Smart Wizard V2.0</strong>. This is a "flexible jQuery plug-in that gives wizard like interface". It is developed by Dipu <a href="http://techlaboratory.net/smartwizard" target="_blank">http://techlaboratory.net/smartwizard</a>. Smart Wizard consists of a jquery script, as well as css.
			</td>
		</tr>
		<tr>
			<td>
				<strong>prettyPhoto/prettyPhoto Media: </strong>The Price Wizard uses prettyphoto as a lightbox to demonstrate diary components. "prettyPhoto" is a very popular jQuery lightbox clone by Stéphane Caron from <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone" target="_blank">www.no-margin-for-errors.com</a>. Rather than create our own implementation of prettyPhoto, we used an existing plugin called prettyPhoto Media from <a href="http://binaryhideout.com/prettyphoto-media-wordpress-plugin/" target="_blank">http://binaryhideout.com</a>.We chose this plugin in 2013 - it was extremely popular and well rated but, as at May 2015, for reasons unknown, it doesn't appear on the WordPress Plugin Repository. I don't think this is a serious issue because the implementation of prettyPhoto is simple and uncomplicated.
				
				<p>prettyPhoto Media uses v3.1.4 of prettyPhoto. The main differences between this and the current version (v3.1.6) are 1) support for IE6 has been dropped and 2) more extensive social media options. Since neither of these is important to our use of prettyPhoto, it is OK for use to continue using "PrettyPhoto Media" even though it is no longer supported.</p>
			</td>
		</tr>
		<tr>
		 	<td><strong>Images: </strong>The form uses images in two ways:<br/>
				1 - display of images in the body of the form generally. These images are saved in folder = /uploads/pricewizard/<br/>
				2 - images used with prettyPhoto - these images are saved in folder = /uploads/prettyphoto/</p>

				<p>Note: As presently built, the plugin does not use the WordPress Media Library, but there's no reason why it could'.</p>
			</td>
		</tr>
		<tr>
		 	<td>
				<strong>Development and Support: </strong>The plugin code was developed by Ted with design by Andrew.
				<p>
				It was developed over several years and this about the third major version. The main feature of this version is the step by step form provided by SmartWizard.</p>
				<p> From 2015, the plugin is transferred to Andrew's development team and they will support it. But if there are any questions or queries about how the plugin works (or should work, etc), then feel free to contact Ted to discuss it.</p>
		 	</td>
		 </tr>
		</table>
 	</div>