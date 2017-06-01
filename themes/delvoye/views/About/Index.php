<?php
	MetaTagManager::setWindowTitle($this->request->config->get("app_display_name").": About");
?>
<H1><?php print _t("About"); ?></H1>
<div class="row aboutContent">
	<div class="col-sm-12 col-md-10">
		<p>
			Welcome to the frontend of the Wim Delvoye Database. This database is trying to give a complete overview to the oeuvre if the Belgian Artist Wim Delvoye (Wervik, Belgium, 1965).
			<br/>
		</p>
		<p>
			THREE BIG MODULES are inserted: artworks, publications and events.The artworks are considered the main subject. We relate them to the publications they appeared in (by image) and the events they were displayed.
		</p>
		<p>
			Every ARTWORK has a identifier (a unique number) that is related to a keyword (ex.: every artwork that starts with 19_ is an ‘Etui’). Because keywords can be overlapping you can also search for keywords. If you would be searching for ‘etui’ you would find all ‘etuis’, related publications and events. If you would type in ‘etui artwork’ you would get rid of all the publications and events. If you want information about one object knowing the identifier would be the easiest way to work. With ‘19_0011  artwork’ you find the artwork, with ‘19_0011’ you would find the artwork and all related publications and events. If you are more unfamiliar with the collection browsing would be the easiest way to look around. Artworks can be filtered by the collection they belong to, events they participated in and materials that where used.
		</p>
		<p>
			Every EVENT tries to list all items that have participated in a certain event. This can be an museum exhibition, gallery exhibition, art fair or something else. Easiest way to search the collection is to give the name of the exhibition, the date (year), the place (city or country) or the Institution (official name, ex. S.M.A.K. and not SMAK).Events can be filtered by date.
		</p>
		<p>
			Every PUBLICATION tries to list the artworks that have images with this publication. It also mentions related events (ex. all catalogs). Using a combination of words is the most efficient way to search (ex. If you would be looking if there is a catalogue from an exhibition in 1991, search for ‘catalogue 1991’).
		</p>
		<p>
			SEARCHES can be organized by identification number, name (ascending/descending) and date. When you browse in the collection you cannot do this.
			<br/>			
		</p>
		<p>
			The database is a work in progress and gets updated weekly. We try to be as correct as possible by using several (original and secondary) sources collecting our data but if you find information to be lacking or incorrect, or you have information that can enrich the database, feel free to contact us.Most images used on this website can be requested, in high resolution. Please contact us for more information.
		</p>
	</div>
</div>