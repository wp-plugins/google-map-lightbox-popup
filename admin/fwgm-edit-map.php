<?phpfunction edit_details(){	$option=$_GET['edit'];		if($_GET["edit"]){			$option=$_GET['edit'];		 }		else{			$option='gfullmap_options';		}		if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated']=="true") {			echo "<div class='show-message-edit'>"; _e('Settings Have been Saved','gfullmap');			echo "</div>";		} ?>		<div class="postbox g_innerpage_container" id="gfullmap_admin" style="width:754px;">			<h3 class="hndle"><span><?php _e("Edit GoogleMap <span>($option)</span>",'gfullmap'); ?></span></h3>			<div class="inside" style="padding: 15px;margin: 0;">				<form method="post" name="map_details" id="#map_details" action="options.php">					   <?php wp_nonce_field('update-options'); 						$options = get_option($option);       						?>												<table style="width:694px;margin-left:20px;">                          							<tr>																<td> <?php _e('Check to show Image','gfullmap'); ?></td>								<td colspan="3"> <input <?php if(isset($options['g_image_chkbox'])) checked('1', $options['g_image_chkbox'],true);?> id="fwgm_chk" type="checkbox" name="<?php echo $option; ?>[g_image_chkbox]" value = "1"/> <span> <label style="font-size:10px;color:#4F5484;" for="fwgm_chk"> <?php _e('Check it, if you want to show image instead of default map.','gfullmap') ?></label> </span> </td> 							</tr> 							 <tr>																<td> <?php _e('Insert image path','gfullmap'); ?></td>								<td colspan="2"> <input class="gfull_upload_image" style="width:220px;" type="text" size="23" name="<?php echo $option; ?>[g_image_path]" value="<?php echo $options['g_image_path'] ?>" /><input class="button-primary gfull_upload_button" type="button" value="Upload Image" /></td>							</tr>							<tr>																<td> <?php _e('Address to Show in Map','gfullmap'); ?></td>								<td> <textarea id="fwgm_add" style="width:220px;" name="<?php echo $option; ?>[g_thumb_address]" ><?php echo $options['g_thumb_address'] ?></textarea></td>							</tr>																<tr>								<td><?php _e('LightBox Map Width','gfullmap') ?></td>								<td><input type="text" size="8" name="<?php echo $option; ?>[glightbox_width]" value="<?php echo $options['glightbox_width'] ?>"/> <span style="font-size:11px;font-weight:normal;"> <?php _e('in pixels','gfullmap') ?> </span> </td>								<td><?php _e('LightBox Map Height','gfullmap') ?></td>								<td><input type="text" size="8" name="<?php echo $option; ?>[glightbox_height]" value="<?php echo $options['glightbox_height'] ?>"/> <span style="font-size:11px;font-weight:normal;"> <?php _e('in pixels','gfullmap') ?> </span> </td>							</tr>							<tr>								<td><?php _e('Map Width','gfullmap') ?></td>								<td><input type="text" size="8" name="<?php echo $option; ?>[g_thumb_width]" value="<?php echo $options['g_thumb_width'] ?>"/> <span style="font-size:11px;font-weight:normal;"> <?php _e('in pixels','gfullmap') ?></span> </td>								<td><?php _e('Map Height','gfullmap') ?></td>								<td><input type="text" size="8" name="<?php echo $option; ?>[g_thumb_height]" value="<?php echo $options['g_thumb_height'] ?>"/> <span style="font-size:11px;font-weight:normal;"><?php _e('in pixels','gfullmap') ?></span> </td>							</tr> 													<tr class ="fwgm_row <?php if(isset($options['g_image_chkbox'])){ ?>hide<?php } ?>">								<td><?php _e("Map Type", 'gfullmap'); ?> </td>								<td>									<select style="width:77px;" name="<?php echo $option; ?>[g_map_type]">										<option <?php selected('roadmap', $options['g_map_type']); ?> value="roadmap"><?php _e('roadmap','gmapfull'); ?></option>										<option <?php selected('satellite', $options['g_map_type']); ?> value="satellite"><?php _e('Satellite','gmapfull'); ?></option>										<option <?php selected('terrain', $options['g_map_type']); ?> value="terrain"><?php _e('Terrain','gmapfull'); ?></option>										<option <?php selected('hybrid', $options['g_map_type']); ?> value="hybrid"><?php _e('Hybrid','gmapfull'); ?></option>									</select>								</td>                          							</tr>							<tr class ="fwgm_row <?php if(isset($options['g_image_chkbox'])){ ?>hide<?php } ?>" >															  <td><?php _e("Map Zoom Level", 'gfullmap'); ?> </td>								<td>									<select style="width:77px;" name="<?php echo $option; ?>[g_zoom_val]">																				<option <?php  selected('0', $options['g_zoom_val']); ?> value="0"><?php _e('0','gmapfull'); ?></option>											<option <?php  selected('5', $options['g_zoom_val']); ?> value="5"><?php _e('5','gmapfull'); ?></option>											<option <?php selected('10', $options['g_zoom_val']); ?> value="10"><?php _e('10','gmapfull'); ?></option>											<option <?php selected('15', $options['g_zoom_val']); ?> value="15"><?php _e('15','gmapfull'); ?></option>									 </select>								</td>							</tr>										<tr>								<td><?php _e("LightBox Map Type", 'gfullmap'); ?></td>								<td>									<select style="width:77px;" name="<?php echo $option; ?>[glightbox_map_type]">										<option <?php selected('m', $options['glightbox_map_type']); ?> value="m"><?php _e('roadmap','gmapfull'); ?></option>										<option <?php selected('k', $options['glightbox_map_type']); ?> value="k"><?php _e('Satellite','gmapfull'); ?></option>										<option <?php selected('p', $options['glightbox_map_type']); ?> value="p"><?php _e('Terrain','gmapfull'); ?></option>										<option <?php selected('h', $options['glightbox_map_type']); ?> value="h"><?php _e('Hybrid','gmapfull'); ?></option>									</select>								</td>																									</tr>												<tr>																<td><?php _e("Lightbox Zoom Level", 'gfullmap'); ?></td>								<td>								<select style="width:77px;"  name="<?php echo $option; ?>[glightbox_zoom_val]">										<option <?php selected('0', $options['glightbox_zoom_val']); ?> value="0"><?php _e('0','gmapfull'); ?></option>										<option <?php selected('5', $options['glightbox_zoom_val']); ?> value="5"><?php _e('5','gmapfull'); ?></option>										<option <?php selected('10', $options['glightbox_zoom_val']); ?> value="10"><?php _e('10','gmapfull'); ?></option>										<option <?php selected('15', $options['glightbox_zoom_val']); ?> value="15"><?php _e('15','gmapfull'); ?></option>								 </select>								</td>													</tr>							 <tr>								<td><?php _e('Show Address Bubble','gfullmap'); ?></td>								<td colspan="3"><input <?php   if(isset($options['glightbox_bubble'])) checked('1', $options['glightbox_bubble'],true); ?>  type="checkbox" id="<?php echo $option; ?>[glightbox_bubble]" name="<?php echo $option; ?>[glightbox_bubble]" value = "1"/> <label style="font-size:10px;margin-left:10px;color:#4F5484;" for="<?php echo $option; ?>[glightbox_bubble]"> <?php _e('Check it, if you want to show Address bubble in lightbox on Map','gfullmap') ?> </label> </td>							</tr>																												</table>						<input type="hidden" name="action" value="update" />						<input type="hidden" name="page_options" value="<?php echo $option; ?>" />											<p class="button-controls">							<input type="submit" value="<?php _e('Save Settings','gfullmap'); ?>" class="button-primary" id="gfullmap_update" onclick="return frmvalidation();" name="gfullmap_update">							</p>								</form> 			 </div>		</div><?php } ?>