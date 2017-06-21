<?php
	$t_object = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$va_access_values = caGetUserAccessValues($this->request);
	$t_lists = new ca_lists();
?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container"><div class="row">
			<div class='col-sm-6 col-md-6 col-lg-5 col-lg-offset-1'>
				{{{representationViewer}}}
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4")); ?>

			</div><!-- end col -->
			
			<div class='col-sm-6 col-md-6 col-lg-5'>
				<H4>{{{^ca_objects.preferred_labels.name}}}</H4>
				<?php
				
				if($t_object->get("ca_objects.date")){
					print '<span class="77">'.$t_object->get("ca_objects.date")."<br/></span>";
				}
				
				$va_collections = $t_object->get("ca_collections", array("returnWithStructure" => true, "restrictToTypes" => array("object_category"), "checkAccess" => $va_access_values, "sort" => "ca_collections.preferred_labels.name"));
				if(sizeof($va_collections)){
					foreach($va_collections as $va_collection){
						print caDetailLink($this->request, ucfirst($va_collection["labels"][1]), "", "ca_collections", $va_collection["collection_id"])."<br/>";
					}
				}
				
				if($t_object->get("ca_objects.work_dimensions")){
					//dimensions
					$vs_dimensions = "";
					//print_r($t_object->get("ca_objects.work_dimensions", array("returnWithStructure" => true, convertCodesToDisplayText=>true)));
					$vs_dim = $t_object->get('ca_objects.work_dimensions', array("returnWithStructure" => true, convertCodesToDisplayText=>true));
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
					echo $vs_dimensions;
				}
				
				?>
				<BR/>
				<BR/>
				<span style="color:#c0c0c0;">
				{{{<ifdef code="ca_objects.idno">(^ca_objects.idno)</ifdef>}}}			
				</span>
				
				<H6>Collections</H6>
				{{{<unit relativeTo="ca_collections" restrictToTypes="artwork_category" delimiter=", "><l>^ca_collections.hierarchy.preferred_labels.name%delimiter=_➔_</l></unit>}}}
				<H6>Keywords</H6>
				{{{<unit relativeTo="ca_collections" restrictToTypes="keyword" delimiter=", "><l>^ca_collections.preferred_labels.name</l></unit>}}}

				
				
				{{{<ifcount code="ca_objects.related" restrictToTypes="artwork" min="1" max="1"><H6>Related artwork</H6></ifcount>}}}
				{{{<ifcount code="ca_objects.related" restrictToTypes="artwork" min="2"><H6>Related artworks</H6></ifcount>}}}
				{{{<unit relativeTo="ca_objects.related" restrictToTypes="artwork" delimiter="<br/>"><l>^ca_objects.preferred_labels</l> (^ca_objects.date), <unit relativeTo="ca_collections" restrictToTypes="object_category">^ca_collections.preferred_labels.name</unit></unit>}}}
				
				
				{{{<ifcount code="ca_occurrences" min="1" max="1"><H6>Related event</H6></ifcount>}}}
				{{{<ifcount code="ca_occurrences" min="2"><H6>Related events</H6></ifcount>}}}
				{{{<unit relativeTo="ca_occurrences" restrictToTypes="event" delimiter="<br/>"><ifdef code="ca_occurrences.preferred_labels"><l>^ca_occurrences.preferred_labels</l>, </ifdef><unit relativeTo="ca_entities">^ca_entities.preferred_labels.displayname, <unit relativeTo="ca_entities.address">^ca_entities.address.city (^ca_entities.address.country),</unit></unit> ^ca_occurrences.date</unit>}}}

				
				{{{<ifcount code="ca_objects.related" restrictToTypes="publication" min="1" max="1"><H6>Related publication</H6></ifcount>}}}
				{{{<ifcount code="ca_objects.related" restrictToTypes="publication" min="2"><H6>Related publications</H6></ifcount>}}}
				{{{<unit relativeTo="ca_objects.related" restrictToTypes="publication" delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="author" delimiter=", ">^ca_entities.preferred_labels.displayname, </unit>"<l>^ca_objects.preferred_labels</l>", ^ca_objects.date <unit relativeTo="ca_collections" restrictToTypes="publication" delimiter=" ➔ ">(^ca_collections.hierarchy.preferred_labels.name)</unit></unit>}}}
				
				
<?php							
				if($t_object->get("ca_objects.edition_c.edition_text")){
					print "<H6>Editions</H6>".$t_object->get("ca_objects.edition_c.edition_text")."<br/>";
				}
?>
			</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->



<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
	});
</script>