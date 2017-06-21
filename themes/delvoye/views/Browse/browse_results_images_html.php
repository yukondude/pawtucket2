<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_images_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
 	require_once(__CA_LIB_DIR__.'/core/Zend/Measure/Length.php');	
 
	$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
	$vn_start		 	= (int)$this->getVar('start');			// offset to seek to before outputting results
	
	$va_views			= $this->getVar('views');
	$vs_current_view	= $this->getVar('view');
	$va_view_icons		= $this->getVar('viewIcons');
	$vs_current_sort	= $this->getVar('sort');
	
	$t_instance			= $this->getVar('t_instance');
	$vs_table 			= $this->getVar('table');
	$vs_pk				= $this->getVar('primaryKey');
	$va_access_values = caGetUserAccessValues($this->request);
	$o_config = $this->getVar("config");	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

	$vb_ajax			= (bool)$this->request->isAjax();
	

	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";
		
//var_dump($va_facets);
		$vn_col_span = 3;
		$vn_col_span_sm = 4;
		$vb_refine = false;
		if(is_array($va_facets) && sizeof($va_facets)){
			$vb_refine = true;
			$vn_col_span = 3;
			$vn_col_span_sm = 6;
			$vn_col_span_xs = 6;
		}
		if ($vn_start < $qr_res->numHits()) {
			$vn_c = 0;
			$qr_res->seek($vn_start);
			if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get($vs_pk);
					$vn_c++;
				}
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'checkAccess' => $va_access_values));
			
				$vn_c = 0;	
				$qr_res->seek($vn_start);
			}
			
			$t_list_item = new ca_list_items();
			while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
				$vn_id 					= $qr_res->get("{$vs_table}.{$vs_pk}");
				$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
				$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels.name"), '', $vs_table, $vn_id);
				$vs_thumbnail = "";
				$vs_type_placeholder = "";
				$vs_typecode = "";
				if ($vs_table == 'ca_objects') {
					
					$type = $qr_res->get('ca_objects.type_id'); //23 - artworks, 24 - publications
					
					if(!($vs_thumbnail = $qr_res->get('ca_object_representations.media.medium', array("checkAccess" => $va_access_values)))){
						$t_list_item->load($qr_res->get("type_id"));
						$vs_typecode = $t_list_item->get("idno");
						if($vs_type_placeholder = caGetPlaceholder($vs_typecode, "placeholder_media_icon")){
							$vs_thumbnail = "<div class='bResultItemImgPlaceholder'>".$vs_type_placeholder."</div>";
						}else{
							$vs_thumbnail = $vs_default_placeholder_tag;
						}
					}
					$vs_info = null;
					if ($qr_res->get('ca_objects.date')) {
						$vs_date = $qr_res->get('ca_objects.date');
					}
					
					if ($type==23) {
						//Artworks - START
						//var_dump($qr_res);
						$vs_publication_purpose = "";
						$va_collections = $qr_res->get("ca_collections", array("returnWithStructure" => false, "restrictToTypes" => array("object_category"), "checkAccess" => $va_access_values, "sort" => "ca_collections.preferred_labels.name"));
						$vs_publication_purpose .=  "<br/>".$va_collections;
												
						//dimensions
						$vs_dimensions = "";
						$vs_dim = $qr_res->get('ca_objects.work_dimensions', array("returnWithStructure" => true, convertCodesToDisplayText=>true));
						foreach ($vs_dim as $d){
							foreach ($d as $e){
								if (stristr($e['dimensions_type'],'object')){
									if (!empty($e['dimensions_length'])) {
										$ps_value = caConvertFractionalNumberToDecimal(trim($e['dimensions_length']), $g_ui_locale);
										$length = caParseLengthDimension($ps_value);
										$vs_dimensions .= "L".$length->convertTo('METER', 2);
									}
									if (!empty($e['dimensions_width'])) {
										$ps_value = caConvertFractionalNumberToDecimal(trim($e['dimensions_width']), $g_ui_locale);
										$width = caParseLengthDimension($ps_value);
										$vs_dimensions .= " x W".$width->convertTo('METER', 2);
									}
									if (!empty($e['dimensions_height'])) {
										$ps_value = caConvertFractionalNumberToDecimal(trim($e['dimensions_height']), $g_ui_locale);
										$height = caParseLengthDimension($ps_value);
										$vs_dimensions .= " x H".$height->convertTo('METER', 2);
									}
								}
							}
						}
						//Artworks - END
					}
					if ($type==24) {
					//Publications - START
						$vs_author = "";
						$va_entities = $qr_res->get("ca_entities", array("returnWithStructure" => false, "restrictToRelationshipTypes" => array("author"), "checkAccess" => 
						$va_access_values, "sort" => "ca_entities.preferred_labels.name"));
						$vs_author .= $va_entities;
						
						$vs_publication_type = "";
						$va_collections = $qr_res->get("ca_collections", array("returnWithStructure" => false, "restrictToTypes" => array("publication"), "checkAccess" => 
						$va_access_values, "sort" => "ca_collections.preferred_labels.name"));
						$vs_publication_type .= $va_collections;

					//Publications - END
					}
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);				
				} elseif ($vs_table == 'ca_occurrences') {
					//events
					if ($qr_res->get('ca_occurrences.date')) {
						$vs_date = $qr_res->get('ca_occurrences.date');
					}
					
					$vs_institution = "";
					$va_entities = $qr_res->get("ca_entities", array("returnWithStructure" => false, "checkAccess" => 
					$va_access_values, "sort" => "ca_entities.preferred_labels.name"));
					$vs_institution .= $va_entities;
					
					if($va_images[$vn_id]){
						$vs_thumbnail = $va_images[$vn_id];
					}else{
						$vs_thumbnail = $vs_default_placeholder_tag;
					}
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);	
				} else
				{
					if($va_images[$vn_id]){
						$vs_thumbnail = $va_images[$vn_id];
					}else{
						$vs_thumbnail = $vs_default_placeholder_tag;
					}
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);			
				}
				$vs_add_to_set_link = "";
				if(is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
					$vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
				}
				$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);

				if ($vs_table == 'ca_objects') {
					if ($type==23) {
						//artworks
						print "
			<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
				<div class='bResultItem' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
					<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids' value='{$vn_id}'></div>
					<div class='bResultItemContent'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div>
						<div class='bResultItemText'>
						<small>{$vs_idno_detail_link}</small><br/>{$vs_label_detail_link}, {$vs_date}{$vs_publication_purpose}<br/>{$vs_dimensions}
						</div><!-- end bResultItemText -->
					</div><!-- end bResultItemContent -->
					<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
						<hr>
						{$vs_expanded_info}{$vs_add_to_set_link}
					</div><!-- bResultItemExpandedInfo -->
				</div><!-- end bResultItem -->
			</div><!-- end col -->";
					}
					if ($type==24) {
						//publications
						print "
			<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
				<div class='bResultItem' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
					<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids' value='{$vn_id}'></div>
					<div class='bResultItemContent'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div>
						<div class='bResultItemText'>
						\"{$vs_label_detail_link}\"<br/>{$vs_author}<br/>{$vs_date}<br/>({$vs_publication_type})
						</div><!-- end bResultItemText -->
					</div><!-- end bResultItemContent -->
					<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
						<hr>
						{$vs_expanded_info}{$vs_add_to_set_link}
					</div><!-- bResultItemExpandedInfo -->
				</div><!-- end bResultItem -->
			</div><!-- end col -->";
					}
				} elseif ($vs_table == 'ca_occurrences') {
					//events
					print "
					<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
						<div class='bResultItem' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
							<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids' value='{$vn_id}'></div>
							<div class='bResultItemContent'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div>
								<div class='bResultItemText'>
								\"{$vs_label_detail_link}\"<br/>{$vs_institution}<br/>{$vs_date}
								</div><!-- end bResultItemText -->
							</div><!-- end bResultItemContent -->
							<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
								<hr>
								{$vs_expanded_info}{$vs_add_to_set_link}
							</div><!-- bResultItemExpandedInfo -->
						</div><!-- end bResultItem -->
					</div><!-- end col -->";
				} else {
					
						print "
			<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
				<div class='bResultItem' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
					<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids' value='{$vn_id}'></div>
					<div class='bResultItemContent'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div>
						<div class='bResultItemText'>
						<small>{$vs_idno_detail_link}</small><br/>{$vs_label_detail_link}
						</div><!-- end bResultItemText -->
					</div><!-- end bResultItemContent -->
					<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
						<hr>
						{$vs_expanded_info}{$vs_add_to_set_link}
					</div><!-- bResultItemExpandedInfo -->
				</div><!-- end bResultItem -->
			</div><!-- end col -->";
				}
				
				$vn_c++;
			}
			
			print caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_hits_per_block, 'key' => $vs_browse_key, 'view' => $vs_current_view));
		}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		if($("#bSetsSelectMultipleButton").is(":visible")){
			$(".bSetsSelectMultiple").show();
		}
	});
</script>