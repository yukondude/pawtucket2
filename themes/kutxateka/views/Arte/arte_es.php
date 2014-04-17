<?php
	AssetLoadManager::register("carousel");
?>
                <div class="col1">
              
                	<h1>Arte</h1>
              
                	<article id="infoPagina" class="alignLeft">
                
                		<div class="carrusel" jcarousel-wrapper">
                    		<div class="mascara jcarousel">
                        
                				<ul class="articulos">
                            		<li class="slide" style="padding-top:30px;"><?php print caGetThemeGraphic($this->request, 'art/P-2588.jpg'); ?><p class="piefotoUnder"><i>El almuerzo</i>, 1977, Gaspar Montes Iturrioz</p></li>
                            		<li class="slide" style="padding-top:52px;"><?php print caGetThemeGraphic($this->request, 'art/P-635.jpg'); ?><p class="piefotoUnder"><i>Puente y gladiolos</i>, 1987, Adrián Ferreño Mora</p></li> 
                            		<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/E-2057.jpg'); ?><p class="piefotoUnder"><i>Figura apoyada en el suelo II</i>, 1991, José Zugasti Arizmendiarrieta</p></li>
                            		<li class="slide" style="padding-top:7px;"><?php print caGetThemeGraphic($this->request, 'art/FA-2039.jpg'); ?><p class="piefotoUnder"><i>Casa en el árbol</i>, 2008, Txuspo Poyo Mendia</p></li>
                					<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/P-2126.jpg'); ?><p class="piefotoUnder"><i>Paisaje veneciano con figura</i>, José Echenagusia Errazkin</p></li>
                					<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/P-2004.jpg'); ?><p class="piefotoUnder"><i>Naturaleza inerte. Vaso con agua y plato</i>, José Camps Gordon</p></li>
                					<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/P-2138.jpg'); ?><p class="piefotoUnder"><i>Paisaje de Hondarribia con dos marineros</i>, Daniel Vázquez Díaz</p></li>
                					<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/P-2174.jpg'); ?><p class="piefotoUnder"><i>Cacharrera Segoviana</i>, 1924, Ascensio Martiarena Lascurain</p></li>
									<li class="slide" style="padding-top:135px;"><?php print caGetThemeGraphic($this->request, 'art/P-16.jpg'); ?><p class="piefotoUnder"><i>La recogida de la manzana</i>, 1930, Jesús Olasagasti Irigoyen</p></li>
									<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/DG-2116.jpg'); ?><p class="piefotoUnder"><i>Nace una diosa</i>, 1933-1934, Nicolás Lecuona Nazabal</p></li> 
                					<li class="slide" style="padding-top:20px;"><?php print caGetThemeGraphic($this->request, 'art/P-2596.jpg'); ?><p class="piefotoUnder"><i>¿Está usted mejor?</i>, 1950, Elias Salaverria</p></li> 
                					<li class="slide" style="padding-top:38px;"><?php print caGetThemeGraphic($this->request, 'art/058.jpg'); ?><p class="piefotoUnder"><i>Sin título. Composición</i>, 1971, Carlos Sanz Ramírez</p></li>
                					<li class="slide" style="padding-top:35px;"><?php print caGetThemeGraphic($this->request, 'art/468.jpg'); ?><p class="piefotoUnder"><i>Arena III</i>, 1960, Rafael Ruiz Balerdi</p></li>
                					<li class="slide"><?php print caGetThemeGraphic($this->request, 'art/461.jpg'); ?><p class="piefotoUnder"><i>Tríptico</i>, 1977, Vicente Ameztoy Olasagasti</p></li>
                					<li class="slide" style="padding-top:16px;"><?php print caGetThemeGraphic($this->request, 'art/1112.jpg'); ?><p class="piefotoUnder"><i>Arena y agua</i>, 1977, José Gracenea Aguirregomezcorta</p></li>
                				</ul>
                    		</div>
                    		<a href="#" class="btnminLeft items" id="detailScrollButtonPrevious">left</a><a href="#" class="btnminRight items" id="detailScrollButtonNext">right</a>
							<p class="jcarousel-pagination"></p>
							
                
                		</div>
			 <script type='text/javascript'>
				jQuery(document).ready(function() {
					/*
					Carousel initialization
					*/
					$('.jcarousel')
						.jcarousel({
							// Options go here
						});
			
					/*
					 Prev control initialization
					 */
					$('#detailScrollButtonPrevious')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '-=1'
						});
			
					/*
					 Next control initialization
					 */
					$('#detailScrollButtonNext')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '+=1'
						});
					
					$('.jcarousel-pagination')
					.on('jcarouselpagination:active', 'a', function() {
						$(this).addClass('active');
					})
					.on('jcarouselpagination:inactive', 'a', function() {
						$(this).removeClass('active');
					})
					.jcarouselPagination();
				});
			</script>
                 
                		<header>
                			<h2 class="verdeclaro">PATRIMONIO ARTÍSTICO</h2>
                		</header>
						  <figure class="alignLeft"><?php print caGetThemeGraphic($this->request, 'art/1118.jpg'); ?><p><i>María</i>, 1918, Aurelio Arteta Errasti</p></figure>
						  <p>
							El Patrimonio Artístico de <span class="kf">Kutxa Fundazioa</span> conforma un fondo de gran riqueza con base en una colección de arte vasco moderno y contemporáneo. Centrado en el ámbito artístico guipuzcoano reúne obras realizadas con diversas técnicas artísticas: pintura, escultura, fotografía, instalaciones, etc. por creadores nacidos o vinculados a Gipuzkoa y, por extensión, al País Vasco.
						  </p>
						  <p>
							La colección de Patrimonio Artístico de <span class="kf">Kutxa Fundazioa</span> reúne actualmente más de 5.000 obras procedentes de las colecciones que poseían las Cajas de Ahorros que dieron origen a <span class="kutxa">kutxa</span> y las que ésta adquirió a partir de 1990.
						  </p>
						  <p>
							La referencia temporal de la colección discurre en paralelo a la historia de las propias Cajas, desde su creación en la segunda mitad del s. XIX hasta la actualidad.
						  </p>
						  <p>
							Siendo la pluralidad uno de los factores característicos de la colección, se encuentran representadas las tendencias artísticas más relevantes que se han sucedido desde fines del XIX hasta nuestros días con especial mención a:
						  </p>
						  <h3 class="ficha aireTop">Arte de principios del XX, con obra destacada de Aurelio Arteta, Narciso Balenciaga, Nicolas Lekuona, Ascensio Martiarena, Julián de Tellaeche o los hermanos Zubiaurre.</h3>
							<h3 class="ficha aireTop">Las nuevas vanguardias surgidas en el País Vasco a partir de los años 60 como el Grupo Gaur (1965), de cuya obra se exhibe una selecta representación en el vestíbulo de la sede central de <span class="kutxa">kutxa</span> en la calle Garibai de Donostia.</h3>
							<h3 class="ficha aireTop">Las nuevas expresiones artísticas que ha ido incorporando a la colección con trabajos de Esther Ferrer, Cristina Iglesias, José Ramón Amondarain, Elena Asins, Manu Muniategiandikoetxea, entre otros autores.</h3>
							<figure class="alignRight aireLeft"><?php print caGetThemeGraphic($this->request, 'art/E-2001.jpg'); ?><br/><p><i>Hilargia (Luna)</i>, 1958, Jorge Oteiza Embil</p></figure>
						  <p>Desde <span class="kutxa">kutxa</span> siempre se ha cultivado una relación de proximidad con los artistas, lo que se pone de manifiesto en la participación de algunos de ellos en el edificio de la sede principal de la Caja. En ella se pueden observar obras realizadas específicamente para este espacio por los artistas <span class="author">Rafael Ruiz Balerdi</span> (vidrieras), <span class="author">Remigio Mediburu</span> (soportal), <span class="author">José Luis Zumeta</span> (mural de cerámica) y <span class="author">Ricardo Ugarte</span> (escalera).
						  </p>
						  <p>
							Con la intención de divulgar esta Colección se lleva a cabo una importante labor de difusión participando en exposiciones, mediante la edición de publicaciones y a través de la exhibición de piezas de la colección en espacios públicos de <span class="kutxa">kutxa</span>. Ahora, para llegar a un mayor número de personas, Patrimonio Artístico de <span class="kf">Kutxa Fundazioa</span> se dispone a difundir un completo catálogo de su obra en Internet a través de este sito web.
						  </p>
					</article>
					<section class="alignRight aireBottom">
                  
						<article class="ficha">
                      
							<h3 class="verdeclaro">Virtual Visit</h3>
                      
							<a href="#" onclick="javascript:window.open('','_blank','status=yes,top=0,left=0,resizable');"><?php print caGetThemeGraphic($this->request, 'art/visita_virtual.jpg', "", array("title" => "Conoce las obras más representativas de la colección, en un entorno 3D.")); ?></a>
							<p>Conoce las obras más representativas de la colección, en un entorno 3D.</p>
                  
						</article>
                  
						<article class="ficha">
                      
							<h3 class="verdeclaro">Video</h3>
                      
							<iframe id="video" src="http://www.youtube.com/embed/l9Qu79gcIAo?rel=0&amp;wmode=transparent" frameborder="0" height="175" width="260"></iframe>
							  <p>
								Nuestra colección en la exposición "Ultramar" de la Sala Kubo-kutxa (2011).
							  </p>
                  
						</article>
                  
						<article class="ficha">
                      
							<h3 class="verdeclaro">Mapa</h3>
                      
							 <a href="<?php print $this->request->config->get("site_host").caGetThemeGraphicUrl($this->request, 'art/KU_Panel_1024x768_V.7.2_large.jpg'); ?>" target="_blank"><?php print caGetThemeGraphic($this->request, 'art/KU_Panel_1024x768_V.7.2.jpg'); ?></a>
		  					<p>El Patrimonio Artístico de <span class="kf">Kutxa Fundazioa</span> está presente en la red de oficinas <span class="kutxa">kutxa</span> y en estos otros emplazamientos.</p>

                  
						</article>
              
					</section>
            
				</div>