<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
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
		<div class="container">
			<div class="row">
				<div class='col-sm-6 col-md-6 col-lg-5 col-lg-offset-1'>
					{{{representationViewer}}}
					
					<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_item, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4")); ?>

				</div><!-- end col -->
				<div class='col-sm-6 col-md-6 col-lg-5'>
					<H4>{{{^ca_occurrences.preferred_labels.name}}}</H4>
					<HR/>
					{{{<unit relativeTo="ca_entities" delimiter="<br/>">^ca_entities.preferred_labels.displayname (<unit relativeTo="ca_entities.address">^ca_entities.address.city, ^ca_entities.address.country</unit>)</unit>}}}
					
					{{{<ifdef code="ca_occurrences.place" min="2">^ca_occurrences.place</ifdef>}}}
<?php
					if($t_item->get("ca_occurrences.date")){
						print "<br/>".$t_item->get("ca_occurrences.date")."<br/>";
					}
?>
					{{{<unit relativeTo="ca_occurrences.event_category" delimiter="<br/>"><ifdef code="ca_occurrences.event_category.event_types">^ca_occurrences.event_category.event_types, </ifdef><ifdef code="ca_occurrences.event_category.event_types2">^ca_occurrences.event_category.event_types2</ifdef></unit>}}}
					
					<BR/>
					<BR/>
					<span style="color:#c0c0c0;">
					{{{<ifdef code="ca_occurrences.idno">^ca_occurrences.idno</ifdef>}}}
					</span>
					<HR/>
					
					{{{<ifcount code="ca_objects" restrictToTypes="artwork" min="1" max="1"><H6>Related artwork</H6></ifcount>}}}
					{{{<ifcount code="ca_objects" restrictToTypes="artwork" min="2"><H6>Related artworks</H6></ifcount>}}}
					{{{<unit relativeTo="ca_objects.related" restrictToTypes="artwork" delimiter="<br/>"><l>^ca_objects.preferred_labels</l> (^ca_objects.date), <unit relativeTo="ca_collections" restrictToTypes="object_category">^ca_collections.preferred_labels.name</unit></unit>}}}
					
					{{{<ifcount code="ca_occurrences.related" min="1" max="1"><H6>Related event</H6></ifcount>}}}
					{{{<ifcount code="ca_occurrences.related" min="2"><H6>Related events</H6></ifcount>}}}
					{{{<unit relativeTo="ca_occurrences" restrictToTypes="event" delimiter="<br/>"><ifdef code="ca_occurrences.related.preferred_labels"><l>^ca_occurrences.related.preferred_labels.name</l>, </ifdef><unit relativeTo="ca_entities">^ca_entities.preferred_labels.displayname, <unit relativeTo="ca_entities.address">^ca_entities.address.city (^ca_entities.address.country),</unit></unit> ^ca_occurrences.related.date</unit>}}}

					
					{{{<ifcount code="ca_objects" restrictToTypes="publication" min="1" max="1"><H6>Related publication</H6></ifcount>}}}
					{{{<ifcount code="ca_objects" restrictToTypes="publication" min="2"><H6>Related publications</H6></ifcount>}}}
					{{{<unit relativeTo="ca_objects" restrictToTypes="publication" delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="author" delimiter=", ">^ca_entities.preferred_labels.displayname</unit> "<l>^ca_objects.preferred_labels</l>", ^ca_objects.date <unit relativeTo="ca_collections" restrictToTypes="publication" delimiter="➔">(^ca_collections.hierarchy.preferred_labels.name)</unit></unit>}}}
					
					<HR/>
					
					{{{<unit relativeTo="ca_objects.reference"><if rule="^ca_objects.reference.reference_status =~ /approved/"><H6>Reference</H6>^ca_objects.reference.reference_text</if></unit>}}}
					
				</div><!-- end col -->
			</div><!-- end row -->
			<div class="row">			
				<div class='col-md-6 col-lg-6'>
					{{{<ifcount code="ca_objects" restrictToTypes="artwork" min="1" max="1"><H6>Related artwork</H6><unit relativeTo="ca_objects" delimiter=" " restrictToTypes="artwork"><l>^ca_object_representations.media.small</l><br/><l>^ca_objects.preferred_labels.name</l><br/></unit></ifcount>}}}
				</div><!-- end col -->
			</div><!-- end row -->
{{{<ifcount code="ca_objects" restrictToTypes="artwork" min="2">
			<div class="row">
				<H6>Related artworks</H6>
				<div id="browseResultsContainer">
					<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
				</div><!-- end browseResultsContainer -->
			</div><!-- end row -->
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Search', 'objects', array('search' => 'occurrence_id:^ca_occurrences.occurrence_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
						jQuery('#browseResultsContainer').jscroll({
							autoTrigger: true,
							loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
							padding: 20,
							nextSelector: 'a.jscroll-next'
						});
					});
					
					
				});
			</script>
</ifcount>}}}		</div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->