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
				
				{{{<unit relativeTo="ca_entities" restrictToRelationshipTypes="author">^ca_entities.preferred_labels.displayname</unit> <unit relativeTo="ca_objects_x_entities">(^relationship_typename)</unit>}}}
				<br/>
				<?php
				
				if($t_object->get("ca_objects.date")){
					print $t_object->get("ca_objects.date")."<br/>";
				}
				?>
				
				{{{<unit relativeTo="ca_collections" restrictToTypes="publication" delimiter=", "><l>^ca_collections.hierarchy.preferred_labels.name%delimiter=_➔_</l></unit>}}}
				
				<BR/>
				<span style="color:#c0c0c0;">
				{{{<ifdef code="ca_objects.idno">(^ca_objects.idno)</ifdef>}}}			
				</span>
				<HR/>
				
				{{{<unit relativeTo="ca_objects"><ifdef code="ca_objects.publication_issue"><H6>Issue</H6></ifdef><unit relativeTo="ca_objects.publication_issue"><ifdef code="ca_objects.publication_issue.issue_title">^ca_objects.publication_issue.issue_title, </ifdef><ifdef code="ca_objects.publication_issue.issue_month">^ca_objects.publication_issue.issue_month, </ifdef><ifdef code="ca_objects.publication_issue.issue_volume">^ca_objects.publication_issue.issue_volume, </ifdef><ifdef code="ca_objects.publication_issue.issue_number">^ca_objects.publication_issue.issue_number</ifdef></unit></unit>}}}
				
				{{{<unit relativeTo="ca_entities" restrictToRelationshipTypes="publisher"><ifdef code="ca_entities.type_id"><H6>Publisher</H6></ifdef>^ca_entities.preferred_labels.displayname <unit relativeTo="ca_objects_x_entities" restrictToRelationshipTypes="publisher">(^relationship_typename)</unit></unit>}}}
				
				{{{<unit relativeTo="ca_objects"><ifdef code="ca_objects.publication_number"><H6>ISBN / ISSN</H6></ifdef><unit relativeTo="ca_objects.publication_number">^ca_objects.publication_number.isbn<ifdef code="ca_objects.publication_number.issn">, ^ca_objects.publication_number.issn</ifdef><ifdef code="ca_objects.publication_number.other">, ^ca_objects.publication_number.other</ifdef></unit></unit>}}}
				<?php
				
				if($t_object->get("ca_objects.page")){
					print "<H6>Page</H6>".$t_object->get("ca_objects.page")."<br/>";
				}
				?>
				
				{{{<ifcount code="ca_objects.related" restrictToTypes="artwork" min="1" max="1"><H6>Related artwork</H6></ifcount>}}}
				{{{<ifcount code="ca_objects.related" restrictToTypes="artwork" min="2"><H6>Related artworks</H6></ifcount>}}}
				{{{<unit relativeTo="ca_objects.related" restrictToTypes="artwork" delimiter="<br/>"><l>^ca_objects.preferred_labels</l> (^ca_objects.date), <unit relativeTo="ca_collections" restrictToTypes="object_category">^ca_collections.preferred_labels.name</unit></unit>}}}
				
				
				{{{<ifcount code="ca_occurrences" min="1" max="1"><H6>Related event</H6></ifcount>}}}
				{{{<ifcount code="ca_occurrences" min="2"><H6>Related events</H6></ifcount>}}}
				{{{<unit relativeTo="ca_occurrences" restrictToTypes="event" delimiter="<br/>"><ifdef code="ca_occurrences.preferred_labels"><l>^ca_occurrences.preferred_labels</l>, </ifdef><unit relativeTo="ca_entities">^ca_entities.preferred_labels.displayname, <unit relativeTo="ca_entities.address">^ca_entities.address.city (^ca_entities.address.country),</unit></unit> ^ca_occurrences.date</unit>}}}

				
				{{{<ifcount code="ca_objects.related" restrictToTypes="publication" min="1" max="1"><H6>Related publication</H6></ifcount>}}}
				{{{<ifcount code="ca_objects.related" restrictToTypes="publication" min="2"><H6>Related publications</H6></ifcount>}}}
				{{{<unit relativeTo="ca_objects.related" restrictToTypes="publication" delimiter="<br/>"><unit relativeTo="ca_entities" restrictToRelationshipTypes="author" delimiter=", ">^ca_entities.preferred_labels.displayname</unit> "<l>^ca_objects.preferred_labels</l>", ^ca_objects.date <unit relativeTo="ca_collections" restrictToTypes="publication" delimiter="➔">(^ca_collections.hierarchy.preferred_labels.name)</unit></unit>}}}
				
				<HR/>
				
				{{{<unit relativeTo="ca_objects.reference"><if rule="^ca_objects.reference.reference_status =~ /approved/"><H6>Reference</H6>^ca_objects.reference.reference_text</if></unit>}}}
<?php							
			/*	if($t_object->get("ca_objects.reference")){
					print "<H6>Reference</H6>".$t_object->get("ca_objects.reference")."<br/>";
				}*/
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