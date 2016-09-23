<?php
session_start();
require_once '../login/dbconfig.php';

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>
	      
	      		


<h2>Utseende</h2>
	    
	     <div class="ui doubling one column grid">
			
				<div class="column">
						    
					<div class="ui segment" style="box-shadow: none;">
			     
						<div class="ui button green" style="float: right;" id="addScnt">Lägg till</div>
						
						<h3 style=" margin-bottom:20px;">Top bar</h3>
						
							<div class="ui divider"></div>
								<form class="ui form" id="topBarSettings" action="edit_topbar.php" method="post">
									<div class="ui form">
							
							<div id="result" class="ui error message"></div>
								<div id="success-settings" class="ui success message"></div>
				
					<div id="p_scents">			
			<?php
				$topBarItems = $user->getAllTopBarItems();
		
				
				if(is_array($topBarItems)) {
					foreach($topBarItems as $item) {
						$id = $item->menu_id;
						$value = $item->value;
						$link = $item->link;
						$location = $item->location;
						$published = $item->published;
						$place = $item->place;

							echo '<div class="three fields">
							<input type="hidden" name="id[]" value="'.$id.'" />

								<div class="field">
									<input type="text" name="values[]" value="'.$value.'" />
								</div>
								<div class="field">
									<input type="text" name="link[]" value="'.$link.'" placeholder="Länk (inkl. http://)" />
								</div>
								<div class="field">
									<input type="text" name="location[]" value="'.$location.'" placeholder="Placering" />
								</div>
								<div class="field">
									<select name="published[]">
										<option value="1" '.(($published=='1')?'selected="selected"':"").'>Publicerad</option>
										<option value="0" '.(($published=='0')?'selected="selected"':"").'>Ej publicerad</option>
									</select>
								</div>
								<div class="field">
									<select name="place[]">
										<option value="1" '.(($place=='1')?'selected="selected"':"").'>Vänster</option>
										<option value="2" '.(($place=='2')?'selected="selected"':"").'>Höger</option>
									</select>
								</div>
								<div class="field" style="width: 7%;">
									<a class="ui button compact icon" style="width: 100%;">
									<i class="trash icon"></i>
									</a>
								</div>
							</div>';
					}
				}
				
		?>


					</div>
							
							
							<div class="field">
								<input type="submit" value="Ändra" class="ui button" />
							</div>
							
							</div>
							
					</div>
				
				</div>
				
	     </div>
	     
	     	     <div class="ui doubling two column grid">

				<div class="column">
					
					<div class="ui segment" style="box-shadow: none;">
						
						
						<h3>Meny</h3>
						<div class="ui divider"></div>
						
						<div class="ui form">
						
						<div class="field">
							<div class="field">
								<label>Placering</label>
								<select>
									<option>Vänster</option>
									<option>Höger</option>
									<option>Under</option>
									<option>Ovanför</option>
								</select>
							</div>
						</div>
						
						<div class="field">
								<input type="submit" value="Ändra" class="ui button" />
							</div>
					
						</div>
					</div>
									
				</div>
			
			
			 		 <div class="column">
				 		 
				 		 <div class="ui segment" style="box-shadow: none;">
						
						
						<h3>Logotyp</h3>
						<div class="ui divider"></div>
						
						<div class="ui form">
						
						<div class="field">
							<div class="field">
								<label>Placering</label>
								<select>
									<option>Mitten</option>
									<option>Vänster</option>
									<option>Höger</option>
								</select>
							</div>
						</div>
						
						<div class="two fields">
							
						<div class="six wide field">
							
							<img width="100%" src="http://valfrimobil.se/img/logo.png"><br />
							<?php
								list($width, $height) = getimagesize('http://valfrimobil.se/img/logo.png');
								echo "<div class='ui message info'>Verklig storlek: ". $width."x".$height."</div>";
							?>
						</div>
							
						<div class="ten wide field">
							<div class="field">
								<label>Ändra bild</label>
								<input type="file" />
							</div>
						</div>
						
						</div>
						
						<div class="field">
								<input type="submit" value="Ändra" class="ui button" />
							</div>
					
						</div>
					</div>
								
			 		 </div>
			 		 
			 		 
	     </div>
	     
	     <!--<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>
	     -->
	     <script>
	     $(function() {
		        var scntDiv = $('#p_scents');
		        var i = $('#p_scents .three').size() + 1;
		        
		        $('#addScnt').click(function() {
		                  
		         $.ajax({
				      url: 'add_tob_bar_item.php',
				      type: 'post',
				      data: {'value': '', 'link': '', 'location': '', 'published': '', 'place': ''},
				      success: function(data) {
				        $('<div class="three fields"><input type="hidden" name="id[]" value="'+data+'" /><div class="field"> <input type="text" placeholder="Innehåll" name="values[]" value="" /></div><div class="field"> <input type="text" name="link[]" value="" placeholder="Länk (inkl. http://)" /></div><div class="field"> <input type="text" name="location[]" value="" placeholder="Placering" /></div><div class="field"> <select name="published[]"><option value="1">Publicerad</option><option value="0">Ej publicerad</option> </select></div><div class="field"> <select name="place[]"><option value="1">Vänster</option><option value="2">Höger</option> </select></div><div class="field" style="width: 7%;"> <a class="ui button compact icon" id="remScnt" style="width: 100%;" data-tab=""> <i class="trash icon"></i> </a></div></div>').appendTo(scntDiv);
    
				      },
				      error: function(xhr, desc, err) {
				        console.log(xhr);
				        console.log("Details: " + desc + "\nError:" + err);
				      }
				    });


		               
    
		                i++;
		                return false;
		        });
		        
		        $('#remScnt').click(function() { 
		                if( i > 2 ) {
		                        $(this).parents('p').remove();
		                        i--;
		                }
		                return false;
		        });
		});
				
		</script>
	     
	     		<script>
							jQuery(document).ready(function($) {
								$.validator.setDefaults({
									errorClass: 'errorField',
									errorElement: 'div',
									errorPlacement: function(error, element) {
										error.addClass("ui red pointing above ui label error").appendTo( element.closest('div.field') );
									}, 
									highlight: function(element, errorClass, validClass) {
										$(element).closest("div.field").addClass("error").removeClass("success");
									},
									unhighlight: function(element, errorClass, validClass){
										$(element).closest(".error").removeClass("error").addClass("success");
									}
									
								});		
									
								   $('#topBarSettings').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-settings").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
					