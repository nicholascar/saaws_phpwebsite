		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="prototype.js"></script>
		<script type="text/javascript">
			function initialize() 
			{
				var myLatlng = new google.maps.LatLng(-34.568995, 140.100356);
				
				var myOptions = {
							zoom: 8,
							center: myLatlng,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
					
				var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
				
				var global_aws_id;



				var aws_markerRMPW08 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.252778,140.483056),
										map: map,
										title: "Barmera",
										url: "/?aws_id=RMPW08"  
										});

				google.maps.event.addListener(aws_markerRMPW08, 'click', function(){
													var infocontentRMPW08 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Barmera</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>21.0 &deg;C</td><td>14.8 &deg;C</td><td>6.6 &deg;C</td><td>39.0 %</td><td>7.3 &deg;C</td></tr></table>';
													var infowindowRMPW08 = new google.maps.InfoWindow({
														content: infocontentRMPW08,
														minWidth: 200
													});													
													infowindowRMPW08.open(map, aws_markerRMPW08);
												});

				google.maps.event.addListener(aws_markerRMPW08, 'dblclick', function(){
													window.location.href = aws_markerRMPW08.url;
												});



				var aws_markerRMPW19 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.2669727,140.584817),
										map: map,
										title: "Berri",
										url: "/?aws_id=RMPW19"  
										});

				google.maps.event.addListener(aws_markerRMPW19, 'click', function(){
													var infocontentRMPW19 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Berri</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.3 &deg;C</td><td>14.7 &deg;C</td><td>7.8 &deg;C</td><td>44.5 %</td><td>6.5 &deg;C</td></tr></table>';
													var infowindowRMPW19 = new google.maps.InfoWindow({
														content: infocontentRMPW19,
														minWidth: 200
													});													
													infowindowRMPW19.open(map, aws_markerRMPW19);
												});

				google.maps.event.addListener(aws_markerRMPW19, 'dblclick', function(){
													window.location.href = aws_markerRMPW19.url;
												});



				var aws_markerRMPW23 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.334461,140.591399),
										map: map,
										title: "Bookpurnong",
										url: "/?aws_id=RMPW23"  
										});

				google.maps.event.addListener(aws_markerRMPW23, 'click', function(){
													var infocontentRMPW23 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Bookpurnong</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.8 &deg;C</td><td>14.5 &deg;C</td><td>6.8 &deg;C</td><td>40.2 %</td><td>7.1 &deg;C</td></tr></table>';
													var infowindowRMPW23 = new google.maps.InfoWindow({
														content: infocontentRMPW23,
														minWidth: 200
													});													
													infowindowRMPW23.open(map, aws_markerRMPW23);
												});

				google.maps.event.addListener(aws_markerRMPW23, 'dblclick', function(){
													window.location.href = aws_markerRMPW23.url;
												});



				var aws_markerRMPW03 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.1045288,140.7023897),
										map: map,
										title: "Chaffey",
										url: "/?aws_id=RMPW03"  
										});

				google.maps.event.addListener(aws_markerRMPW03, 'click', function(){
													var infocontentRMPW03 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Chaffey</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>21.0 &deg;C</td><td>15.3 &deg;C</td><td>7.6 &deg;C</td><td>41.9 %</td><td>7.0 &deg;C</td></tr></table>';
													var infowindowRMPW03 = new google.maps.InfoWindow({
														content: infocontentRMPW03,
														minWidth: 200
													});													
													infowindowRMPW03.open(map, aws_markerRMPW03);
												});

				google.maps.event.addListener(aws_markerRMPW03, 'dblclick', function(){
													window.location.href = aws_markerRMPW03.url;
												});



				var aws_markerRMPW12 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.070002,139.76756),
										map: map,
										title: "Cadell",
										url: "/?aws_id=RMPW12"  
										});

				google.maps.event.addListener(aws_markerRMPW12, 'click', function(){
													var infocontentRMPW12 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Cadell</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.2 &deg;C</td><td>14.8 &deg;C</td><td>6.7 &deg;C</td><td>41.4 %</td><td>6.8 &deg;C</td></tr></table>';
													var infowindowRMPW12 = new google.maps.InfoWindow({
														content: infocontentRMPW12,
														minWidth: 200
													});													
													infowindowRMPW12.open(map, aws_markerRMPW12);
												});

				google.maps.event.addListener(aws_markerRMPW12, 'dblclick', function(){
													window.location.href = aws_markerRMPW12.url;
												});



				var aws_markerRMPW06 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.439149,140.597987),
										map: map,
										title: "Loxton",
										url: "/?aws_id=RMPW06"  
										});

				google.maps.event.addListener(aws_markerRMPW06, 'click', function(){
													var infocontentRMPW06 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Loxton</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>19.8 &deg;C</td><td>13.8 &deg;C</td><td>8.0 &deg;C</td><td>46.6 %</td><td>6.2 &deg;C</td></tr></table>';
													var infowindowRMPW06 = new google.maps.InfoWindow({
														content: infocontentRMPW06,
														minWidth: 200
													});													
													infowindowRMPW06.open(map, aws_markerRMPW06);
												});

				google.maps.event.addListener(aws_markerRMPW06, 'dblclick', function(){
													window.location.href = aws_markerRMPW06.url;
												});



				var aws_markerRMPW05 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.2580088,140.6579806),
										map: map,
										title: "Lyrup Flats",
										url: "/?aws_id=RMPW05"  
										});

				google.maps.event.addListener(aws_markerRMPW05, 'click', function(){
													var infocontentRMPW05 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Lyrup Flats</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.6 &deg;C</td><td>15.4 &deg;C</td><td>7.4 &deg;C</td><td>42.6 %</td><td>6.8 &deg;C</td></tr></table>';
													var infowindowRMPW05 = new google.maps.InfoWindow({
														content: infocontentRMPW05,
														minWidth: 200
													});													
													infowindowRMPW05.open(map, aws_markerRMPW05);
												});

				google.maps.event.addListener(aws_markerRMPW05, 'dblclick', function(){
													window.location.href = aws_markerRMPW05.url;
												});



				var aws_markerRMPW09 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.260211,140.345578),
										map: map,
										title: "Moorook",
										url: "/?aws_id=RMPW09"  
										});

				google.maps.event.addListener(aws_markerRMPW09, 'click', function(){
													var infocontentRMPW09 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Moorook</span> at: 30/06, 07:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>10.7 &deg;C</td><td>6.8 &deg;C</td><td>8.8 &deg;C</td><td>87.7 %</td><td>1.0 &deg;C</td></tr></table>';
													var infowindowRMPW09 = new google.maps.InfoWindow({
														content: infocontentRMPW09,
														minWidth: 200
													});													
													infowindowRMPW09.open(map, aws_markerRMPW09);
												});

				google.maps.event.addListener(aws_markerRMPW09, 'dblclick', function(){
													window.location.href = aws_markerRMPW09.url;
												});



				var aws_markerRMPW01 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.042531,140.892428),
										map: map,
										title: "Murtho",
										url: "/?aws_id=RMPW01"  
										});

				google.maps.event.addListener(aws_markerRMPW01, 'click', function(){
													var infocontentRMPW01 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Murtho</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>19.3 &deg;C</td><td>12.8 &deg;C</td><td>5.4 &deg;C</td><td>40.2 %</td><td>6.8 &deg;C</td></tr></table>';
													var infowindowRMPW01 = new google.maps.InfoWindow({
														content: infocontentRMPW01,
														minWidth: 200
													});													
													infowindowRMPW01.open(map, aws_markerRMPW01);
												});

				google.maps.event.addListener(aws_markerRMPW01, 'dblclick', function(){
													window.location.href = aws_markerRMPW01.url;
												});



				var aws_markerRPWA05 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.3807967,140.397026),
										map: map,
										title: "New Residence",
										url: "/?aws_id=RPWA05"  
										});

				google.maps.event.addListener(aws_markerRPWA05, 'click', function(){
													var infocontentRPWA05 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;"></span> at: 01/01, 09:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowRPWA05 = new google.maps.InfoWindow({
														content: infocontentRPWA05,
														minWidth: 200
													});													
													infowindowRPWA05.open(map, aws_markerRPWA05);
												});

				google.maps.event.addListener(aws_markerRPWA05, 'dblclick', function(){
													window.location.href = aws_markerRPWA05.url;
												});



				var aws_markerRMPW02 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.162901,140.791659),
										map: map,
										title: "Paringa",
										url: "/?aws_id=RMPW02"  
										});

				google.maps.event.addListener(aws_markerRMPW02, 'click', function(){
													var infocontentRMPW02 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Paringa</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.1 &deg;C</td><td>13.9 &deg;C</td><td>7.0 &deg;C</td><td>42.7 %</td><td>6.7 &deg;C</td></tr></table>';
													var infowindowRMPW02 = new google.maps.InfoWindow({
														content: infocontentRMPW02,
														minWidth: 200
													});													
													infowindowRMPW02.open(map, aws_markerRMPW02);
												});

				google.maps.event.addListener(aws_markerRMPW02, 'dblclick', function(){
													window.location.href = aws_markerRMPW02.url;
												});



				var aws_markerRMPW07 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.425407,140.48106),
										map: map,
										title: "Pyap",
										url: "/?aws_id=RMPW07"  
										});

				google.maps.event.addListener(aws_markerRMPW07, 'click', function(){
													var infocontentRMPW07 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Pyap</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.4 &deg;C</td><td>14.4 &deg;C</td><td>7.2 &deg;C</td><td>42.3 %</td><td>6.8 &deg;C</td></tr></table>';
													var infowindowRMPW07 = new google.maps.InfoWindow({
														content: infocontentRMPW07,
														minWidth: 200
													});													
													infowindowRMPW07.open(map, aws_markerRMPW07);
												});

				google.maps.event.addListener(aws_markerRMPW07, 'dblclick', function(){
													window.location.href = aws_markerRMPW07.url;
												});



				var aws_markerRMPW11 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.1059817,139.8271639),
										map: map,
										title: "Qualco",
										url: "/?aws_id=RMPW11"  
										});

				google.maps.event.addListener(aws_markerRMPW11, 'click', function(){
													var infocontentRMPW11 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Qualco</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.8 &deg;C</td><td>15.7 &deg;C</td><td>7.1 &deg;C</td><td>41.1 %</td><td>7.0 &deg;C</td></tr></table>';
													var infowindowRMPW11 = new google.maps.InfoWindow({
														content: infocontentRMPW11,
														minWidth: 200
													});													
													infowindowRMPW11.open(map, aws_markerRMPW11);
												});

				google.maps.event.addListener(aws_markerRMPW11, 'dblclick', function(){
													window.location.href = aws_markerRMPW11.url;
												});



				var aws_markerRMPW22 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.1809597,140.7014488),
										map: map,
										title: "Renmark",
										url: "/?aws_id=RMPW22"  
										});

				google.maps.event.addListener(aws_markerRMPW22, 'click', function(){
													var infocontentRMPW22 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Renmark</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.3 &deg;C</td><td>14.8 &deg;C</td><td>7.8 &deg;C</td><td>44.4 %</td><td>6.5 &deg;C</td></tr></table>';
													var infowindowRMPW22 = new google.maps.InfoWindow({
														content: infocontentRMPW22,
														minWidth: 200
													});													
													infowindowRMPW22.open(map, aws_markerRMPW22);
												});

				google.maps.event.addListener(aws_markerRMPW22, 'dblclick', function(){
													window.location.href = aws_markerRMPW22.url;
												});



				var aws_markerRMPW10 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.1525086,139.9499849),
										map: map,
										title: "Taylorville",
										url: "/?aws_id=RMPW10"  
										});

				google.maps.event.addListener(aws_markerRMPW10, 'click', function(){
													var infocontentRMPW10 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Taylorville</span> at: 30/06, 13:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>19.1 &deg;C</td><td>12.4 &deg;C</td><td>7.3 &deg;C</td><td>46.2 %</td><td>6.1 &deg;C</td></tr></table>';
													var infowindowRMPW10 = new google.maps.InfoWindow({
														content: infocontentRMPW10,
														minWidth: 200
													});													
													infowindowRMPW10.open(map, aws_markerRMPW10);
												});

				google.maps.event.addListener(aws_markerRMPW10, 'dblclick', function(){
													window.location.href = aws_markerRMPW10.url;
												});



				var aws_markerRMPW20 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.189167,139.960833),
										map: map,
										title: "Waikerie",
										url: "/?aws_id=RMPW20"  
										});

				google.maps.event.addListener(aws_markerRMPW20, 'click', function(){
													var infocontentRMPW20 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Waikerie</span> at: 27/06, 01:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>8.2 &deg;C</td><td>4.3 &deg;C</td><td>7.8 &deg;C</td><td>97.1 %</td><td>0.2 &deg;C</td></tr></table>';
													var infowindowRMPW20 = new google.maps.InfoWindow({
														content: infocontentRMPW20,
														minWidth: 200
													});													
													infowindowRMPW20.open(map, aws_markerRMPW20);
												});

				google.maps.event.addListener(aws_markerRMPW20, 'dblclick', function(){
													window.location.href = aws_markerRMPW20.url;
												});



				var aws_markerRMPW24 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.293056,140.030833),
										map: map,
										title: "Waikerie-Dryland",
										url: "/?aws_id=RMPW24"  
										});

				google.maps.event.addListener(aws_markerRMPW24, 'click', function(){
													var infocontentRMPW24 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Waikerie-Dryland</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.3 &deg;C</td><td>13.1 &deg;C</td><td>5.9 &deg;C</td><td>39.0 %</td><td>7.1 &deg;C</td></tr></table>';
													var infowindowRMPW24 = new google.maps.InfoWindow({
														content: infocontentRMPW24,
														minWidth: 200
													});													
													infowindowRMPW24.open(map, aws_markerRMPW24);
												});

				google.maps.event.addListener(aws_markerRMPW24, 'dblclick', function(){
													window.location.href = aws_markerRMPW24.url;
												});



				var aws_markerRMPW21 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.183611,140.228889),
										map: map,
										title: "Woolpunda",
										url: "/?aws_id=RMPW21"  
										});

				google.maps.event.addListener(aws_markerRMPW21, 'click', function(){
													var infocontentRMPW21 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Woolpunda</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.0 &deg;C</td><td>14.2 &deg;C</td><td>7.3 &deg;C</td><td>43.9 %</td><td>6.5 &deg;C</td></tr></table>';
													var infowindowRMPW21 = new google.maps.InfoWindow({
														content: infocontentRMPW21,
														minWidth: 200
													});													
													infowindowRMPW21.open(map, aws_markerRMPW21);
												});

				google.maps.event.addListener(aws_markerRMPW21, 'dblclick', function(){
													window.location.href = aws_markerRMPW21.url;
												});



				var aws_markerRMPW04 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.2492118,140.8348018),
										map: map,
										title: "Yamba",
										url: "/?aws_id=RMPW04"  
										});

				google.maps.event.addListener(aws_markerRMPW04, 'click', function(){
													var infocontentRMPW04 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Yamba</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>20.0 &deg;C</td><td>14.6 &deg;C</td><td>5.8 &deg;C</td><td>39.4 %</td><td>7.0 &deg;C</td></tr></table>';
													var infowindowRMPW04 = new google.maps.InfoWindow({
														content: infocontentRMPW04,
														minWidth: 200
													});													
													infowindowRMPW04.open(map, aws_markerRMPW04);
												});

				google.maps.event.addListener(aws_markerRMPW04, 'dblclick', function(){
													window.location.href = aws_markerRMPW04.url;
												});



				var aws_markerRMPW14 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.8541699,139.580519),
										map: map,
										title: "Caurnamont",
										url: "/?aws_id=RMPW14"  
										});

				google.maps.event.addListener(aws_markerRMPW14, 'click', function(){
													var infocontentRMPW14 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Caurnamont</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>18.6 &deg;C</td><td>12.6 &deg;C</td><td>7.6 &deg;C</td><td>48.7 %</td><td>5.7 &deg;C</td></tr></table>';
													var infowindowRMPW14 = new google.maps.InfoWindow({
														content: infocontentRMPW14,
														minWidth: 200
													});													
													infowindowRMPW14.open(map, aws_markerRMPW14);
												});

				google.maps.event.addListener(aws_markerRMPW14, 'dblclick', function(){
													window.location.href = aws_markerRMPW14.url;
												});



				var aws_markerRMPW17 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.4445586,138.8141448),
										map: map,
										title: "Currency Crk",
										url: "/?aws_id=RMPW17"  
										});

				google.maps.event.addListener(aws_markerRMPW17, 'click', function(){
													var infocontentRMPW17 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Currency Crk</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>18.0 &deg;C</td><td>13.6 &deg;C</td><td>11.0 &deg;C</td><td>63.7 %</td><td>4.0 &deg;C</td></tr></table>';
													var infowindowRMPW17 = new google.maps.InfoWindow({
														content: infocontentRMPW17,
														minWidth: 200
													});													
													infowindowRMPW17.open(map, aws_markerRMPW17);
												});

				google.maps.event.addListener(aws_markerRMPW17, 'dblclick', function(){
													window.location.href = aws_markerRMPW17.url;
												});



				var aws_markerRMPW16 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.3165885,139.040893),
										map: map,
										title: "Langhorne Crk",
										url: "/?aws_id=RMPW16"  
										});

				google.maps.event.addListener(aws_markerRMPW16, 'click', function(){
													var infocontentRMPW16 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Langhorne Crk</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>16.3 &deg;C</td><td>10.1 &deg;C</td><td>9.7 &deg;C</td><td>64.9 %</td><td>3.6 &deg;C</td></tr></table>';
													var infowindowRMPW16 = new google.maps.InfoWindow({
														content: infocontentRMPW16,
														minWidth: 200
													});													
													infowindowRMPW16.open(map, aws_markerRMPW16);
												});

				google.maps.event.addListener(aws_markerRMPW16, 'dblclick', function(){
													window.location.href = aws_markerRMPW16.url;
												});



				var aws_markerRMPW15 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.0175798,139.333935),
										map: map,
										title: "Mypolonga",
										url: "/?aws_id=RMPW15"  
										});

				google.maps.event.addListener(aws_markerRMPW15, 'click', function(){
													var infocontentRMPW15 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Mypolonga</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>17.2 &deg;C</td><td>12.9 &deg;C</td><td>8.0 &deg;C</td><td>54.8 %</td><td>4.8 &deg;C</td></tr></table>';
													var infowindowRMPW15 = new google.maps.InfoWindow({
														content: infocontentRMPW15,
														minWidth: 200
													});													
													infowindowRMPW15.open(map, aws_markerRMPW15);
												});

				google.maps.event.addListener(aws_markerRMPW15, 'dblclick', function(){
													window.location.href = aws_markerRMPW15.url;
												});



				var aws_markerRMPW18 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.549585,139.224974),
										map: map,
										title: "Narrung",
										url: "/?aws_id=RMPW18"  
										});

				google.maps.event.addListener(aws_markerRMPW18, 'click', function(){
													var infocontentRMPW18 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Narrung</span> at: 30/06, 13:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>16.5 &deg;C</td><td>10.4 &deg;C</td><td>9.4 &deg;C</td><td>62.5 %</td><td>4.0 &deg;C</td></tr></table>';
													var infowindowRMPW18 = new google.maps.InfoWindow({
														content: infocontentRMPW18,
														minWidth: 200
													});													
													infowindowRMPW18.open(map, aws_markerRMPW18);
												});

				google.maps.event.addListener(aws_markerRMPW18, 'dblclick', function(){
													window.location.href = aws_markerRMPW18.url;
												});



				var aws_markerRMPW13 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.581686,139.636442),
										map: map,
										title: "Swan Reach",
										url: "/?aws_id=RMPW13"  
										});

				google.maps.event.addListener(aws_markerRMPW13, 'click', function(){
													var infocontentRMPW13 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Swan Reach</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>19.5 &deg;C</td><td>13.1 &deg;C</td><td>7.4 &deg;C</td><td>45.6 %</td><td>6.2 &deg;C</td></tr></table>';
													var infowindowRMPW13 = new google.maps.InfoWindow({
														content: infocontentRMPW13,
														minWidth: 200
													});													
													infowindowRMPW13.open(map, aws_markerRMPW13);
												});

				google.maps.event.addListener(aws_markerRMPW13, 'dblclick', function(){
													window.location.href = aws_markerRMPW13.url;
												});



				var aws_markerADLD02 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.917,138.905),
										map: map,
										title: "Charleston",
										url: "/?aws_id=ADLD02"  
										});

				google.maps.event.addListener(aws_markerADLD02, 'click', function(){
													var infocontentADLD02 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Charleston</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>13.7 &deg;C</td><td>8.0 &deg;C</td><td>9.4 &deg;C</td><td>75.6 %</td><td>2.3 &deg;C</td></tr></table>';
													var infowindowADLD02 = new google.maps.InfoWindow({
														content: infocontentADLD02,
														minWidth: 200
													});													
													infowindowADLD02.open(map, aws_markerADLD02);
												});

				google.maps.event.addListener(aws_markerADLD02, 'dblclick', function(){
													window.location.href = aws_markerADLD02.url;
												});



				var aws_markerADLD01 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.666,138.568),
										map: map,
										title: "Virginia",
										url: "/?aws_id=ADLD01"  
										});

				google.maps.event.addListener(aws_markerADLD01, 'click', function(){
													var infocontentADLD01 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Virginia</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>16.8 &deg;C</td><td>12.2 &deg;C</td><td>12.2 &deg;C</td><td>74.2 %</td><td>2.8 &deg;C</td></tr></table>';
													var infowindowADLD01 = new google.maps.InfoWindow({
														content: infocontentADLD01,
														minWidth: 200
													});													
													infowindowADLD01.open(map, aws_markerADLD01);
												});

				google.maps.event.addListener(aws_markerADLD01, 'dblclick', function(){
													window.location.href = aws_markerADLD01.url;
												});



				var aws_markerMPWA06 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.081944,140.095556),
										map: map,
										title: "Lowaldie",
										url: "/?aws_id=MPWA06"  
										});

				google.maps.event.addListener(aws_markerMPWA06, 'click', function(){
													var infocontentMPWA06 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Lowaldie</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>18.4 &deg;C</td><td>10.8 &deg;C</td><td>7.7 &deg;C</td><td>49.6 %</td><td>5.6 &deg;C</td></tr></table>';
													var infowindowMPWA06 = new google.maps.InfoWindow({
														content: infocontentMPWA06,
														minWidth: 200
													});													
													infowindowMPWA06.open(map, aws_markerMPWA06);
												});

				google.maps.event.addListener(aws_markerMPWA06, 'dblclick', function(){
													window.location.href = aws_markerMPWA06.url;
												});



				var aws_markerMPWA02 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.966201,140.884641),
										map: map,
										title: "Peebinga",
										url: "/?aws_id=MPWA02"  
										});

				google.maps.event.addListener(aws_markerMPWA02, 'click', function(){
													var infocontentMPWA02 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Peebinga</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>19.8 &deg;C</td><td>13.4 &deg;C</td><td>8.0 &deg;C</td><td>46.3 %</td><td>6.2 &deg;C</td></tr></table>';
													var infowindowMPWA02 = new google.maps.InfoWindow({
														content: infocontentMPWA02,
														minWidth: 200
													});													
													infowindowMPWA02.open(map, aws_markerMPWA02);
												});

				google.maps.event.addListener(aws_markerMPWA02, 'dblclick', function(){
													window.location.href = aws_markerMPWA02.url;
												});



				var aws_markerMPWA03 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.252362,140.946136),
										map: map,
										title: "Pinnaroo",
										url: "/?aws_id=MPWA03"  
										});

				google.maps.event.addListener(aws_markerMPWA03, 'click', function(){
													var infocontentMPWA03 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Pinnaroo</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>18.9 &deg;C</td><td>12.7 &deg;C</td><td>8.5 &deg;C</td><td>51.0 %</td><td>5.5 &deg;C</td></tr></table>';
													var infowindowMPWA03 = new google.maps.InfoWindow({
														content: infocontentMPWA03,
														minWidth: 200
													});													
													infowindowMPWA03.open(map, aws_markerMPWA03);
												});

				google.maps.event.addListener(aws_markerMPWA03, 'dblclick', function(){
													window.location.href = aws_markerMPWA03.url;
												});



				var aws_markerMPWA01 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.7711938,140.323888),
										map: map,
										title: "Wanbi",
										url: "/?aws_id=MPWA01"  
										});

				google.maps.event.addListener(aws_markerMPWA01, 'click', function(){
													var infocontentMPWA01 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Wanbi</span> at: 21/05, 13:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>23.7 &deg;C</td><td>19.5 &deg;C</td><td>2.9 &deg;C</td><td>25.7 %</td><td>10.8 &deg;C</td></tr></table>';
													var infowindowMPWA01 = new google.maps.InfoWindow({
														content: infocontentMPWA01,
														minWidth: 200
													});													
													infowindowMPWA01.open(map, aws_markerMPWA01);
												});

				google.maps.event.addListener(aws_markerMPWA01, 'dblclick', function(){
													window.location.href = aws_markerMPWA01.url;
												});



				var aws_markerMPWA04 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.4007467,140.35975),
										map: map,
										title: "Wilkawatt",
										url: "/?aws_id=MPWA04"  
										});

				google.maps.event.addListener(aws_markerMPWA04, 'click', function(){
													var infocontentMPWA04 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Wilkawatt</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>17.2 &deg;C</td><td>11.1 &deg;C</td><td>8.5 &deg;C</td><td>56.7 %</td><td>4.6 &deg;C</td></tr></table>';
													var infowindowMPWA04 = new google.maps.InfoWindow({
														content: infocontentMPWA04,
														minWidth: 200
													});													
													infowindowMPWA04.open(map, aws_markerMPWA04);
												});

				google.maps.event.addListener(aws_markerMPWA04, 'dblclick', function(){
													window.location.href = aws_markerMPWA04.url;
												});



				var aws_markerTBRG01 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.094436,140.8113839),
										map: map,
										title: "Murtho",
										url: "/?aws_id=TBRG01"  
										});

				google.maps.event.addListener(aws_markerTBRG01, 'click', function(){
													var infocontentTBRG01 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Murtho</span> at: 23/05, 10:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG01 = new google.maps.InfoWindow({
														content: infocontentTBRG01,
														minWidth: 200
													});													
													infowindowTBRG01.open(map, aws_markerTBRG01);
												});

				google.maps.event.addListener(aws_markerTBRG01, 'dblclick', function(){
													window.location.href = aws_markerTBRG01.url;
												});



				var aws_markerTBRG02 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.285997,140.753904),
										map: map,
										title: "Pike River",
										url: "/?aws_id=TBRG02"  
										});

				google.maps.event.addListener(aws_markerTBRG02, 'click', function(){
													var infocontentTBRG02 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Pike River</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG02 = new google.maps.InfoWindow({
														content: infocontentTBRG02,
														minWidth: 200
													});													
													infowindowTBRG02.open(map, aws_markerTBRG02);
												});

				google.maps.event.addListener(aws_markerTBRG02, 'dblclick', function(){
													window.location.href = aws_markerTBRG02.url;
												});



				var aws_markerTBRG06 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.0662739,139.9370818),
										map: map,
										title: "Taylorville Nth",
										url: "/?aws_id=TBRG06"  
										});

				google.maps.event.addListener(aws_markerTBRG06, 'click', function(){
													var infocontentTBRG06 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Taylorville Nth</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG06 = new google.maps.InfoWindow({
														content: infocontentTBRG06,
														minWidth: 200
													});													
													infowindowTBRG06.open(map, aws_markerTBRG06);
												});

				google.maps.event.addListener(aws_markerTBRG06, 'dblclick', function(){
													window.location.href = aws_markerTBRG06.url;
												});



				var aws_markerTBRG04 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.3204804,140.51413),
										map: map,
										title: "Winkie",
										url: "/?aws_id=TBRG04"  
										});

				google.maps.event.addListener(aws_markerTBRG04, 'click', function(){
													var infocontentTBRG04 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Winkie</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG04 = new google.maps.InfoWindow({
														content: infocontentTBRG04,
														minWidth: 200
													});													
													infowindowTBRG04.open(map, aws_markerTBRG04);
												});

				google.maps.event.addListener(aws_markerTBRG04, 'dblclick', function(){
													window.location.href = aws_markerTBRG04.url;
												});



				var aws_markerTBRG08 = new google.maps.Marker({
										position: new google.maps.LatLng(-34.7438,139.5648),
										map: map,
										title: "Forster",
										url: "/?aws_id=TBRG08"  
										});

				google.maps.event.addListener(aws_markerTBRG08, 'click', function(){
													var infocontentTBRG08 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Forster</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG08 = new google.maps.InfoWindow({
														content: infocontentTBRG08,
														minWidth: 200
													});													
													infowindowTBRG08.open(map, aws_markerTBRG08);
												});

				google.maps.event.addListener(aws_markerTBRG08, 'dblclick', function(){
													window.location.href = aws_markerTBRG08.url;
												});



				var aws_markerTBRG09 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.2147,139.383),
										map: map,
										title: "Woods Point",
										url: "/?aws_id=TBRG09"  
										});

				google.maps.event.addListener(aws_markerTBRG09, 'click', function(){
													var infocontentTBRG09 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Woods Point</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG09 = new google.maps.InfoWindow({
														content: infocontentTBRG09,
														minWidth: 200
													});													
													infowindowTBRG09.open(map, aws_markerTBRG09);
												});

				google.maps.event.addListener(aws_markerTBRG09, 'dblclick', function(){
													window.location.href = aws_markerTBRG09.url;
												});



				var aws_markerTBRG03 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.293265,139.408821),
										map: map,
										title: "Wellington",
										url: "/?aws_id=TBRG03"  
										});

				google.maps.event.addListener(aws_markerTBRG03, 'click', function(){
													var infocontentTBRG03 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Wellington</span> at: 30/06, 14:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td> &deg;C</td><td> &deg;C</td><td> &deg;C</td><td> %</td><td> &deg;C</td></tr></table>';
													var infowindowTBRG03 = new google.maps.InfoWindow({
														content: infocontentTBRG03,
														minWidth: 200
													});													
													infowindowTBRG03.open(map, aws_markerTBRG03);
												});

				google.maps.event.addListener(aws_markerTBRG03, 'dblclick', function(){
													window.location.href = aws_markerTBRG03.url;
												});

			}//initialize
			
										window.onload = initialize;
		</script>

