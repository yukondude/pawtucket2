<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$qr_res = ca_places::find(['parent_id' => $t_item->get('ca_places.place_id'), 'access' => 1], ['returnAs' => 'searchResult']);
	$vs_default_placeholder = caGetThemeGraphic($this->request, 'placeholder.jpg');
	while($qr_res->nextHit()){
			$vn_ids[] = $qr_res->get('ca_places.place_id');
			
	}
	$vn_place_id = $t_item->get('ca_places.place_id');
	$vn_ids[] = $vn_place_id;
	$va_images = caGetDisplayImagesForAuthorityItems('ca_places', $vn_ids, array('version' => 'resultcrop', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'checkAccess' => $va_access_values));
	$va_detail_image = caGetDisplayImagesForAuthorityItems('ca_places', [$vn_place_id], array('version' => 'large', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'checkAccess' => $va_access_values));
?>
<div class="row">
	<div class='col-xs-12'>
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div>
</div><!-- end row -->
<div class="row">		
<div class='col-sm-8'>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 placeDetailImage">
			<?php print $va_detail_image[$t_item->get('ca_places.place_id')]; ?>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div id="browsePlaceResultsContainer">
<?php
		$vn_ids = [];
		while($qr_res->nextHit()){
			$vn_ids[] = $qr_res->get('ca_places.place_id');
		}
		$qr_res->seek(0);
		while($qr_res->nextHit()){
			$vn_id = $qr_res->get('ca_places.place_id');
			
			if($va_images[$vn_id]){
				$vs_rep_detail_link = caDetailLink($this->request, $va_images[$vn_id], '', 'ca_places', $vn_id);		
			} else {
				$vs_rep_detail_link = caDetailLink($this->request, $vs_default_placeholder, '', 'ca_places', $vn_id);
			}
			$vs_label_detail_link = caDetailLink($this->request, $qr_res->get('ca_places.preferred_labels'), '', 'ca_places', $vn_id);
			print "<div class='bResultItemCol col-xs-6 col-sm-4 col-md-4'>
				<div class='bResult'>
					{$vs_rep_detail_link}
					<div class='bResultText'>
						{$vs_label_detail_link}
					</div>
				</div>
			</div>";
		}
?>
		</div><!-- end browseResultsContainer -->
	</div>
</div><!-- end col -->
<div class='col-sm-4'>
	<div class="detailTitle">{{{^ca_places.preferred_labels}}}</div>
</div>
</div><!-- end row -->
