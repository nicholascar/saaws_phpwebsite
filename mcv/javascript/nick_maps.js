			function initialize() 
			{
				var myLatlng = new google.maps.LatLng(-35.233356, 138.562144);
				
				var myOptions = {
							zoom: 11,
							center: myLatlng,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
					
				var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
				
				var global_aws_id;



				var aws_markerMVGWT07 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.2864,138.4725),
										map: map,
										title: "Aldinga",
										url: "?aws_id=MVGWT07"  
										});

				google.maps.event.addListener(aws_markerMVGWT07, 'click', function(){
													var infocontentMVGWT07 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Aldinga</span> at: 15/09, 21:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>8.0 &deg;C</td><td>4.3 &deg;C</td><td>4.4 &deg;C</td><td>78.1 %</td><td>1.7 &deg;C</td></tr></table>';
													var infowindowMVGWT07 = new google.maps.InfoWindow({
														content: infocontentMVGWT07,
														minWidth: 200
													});													
													infowindowMVGWT07.open(map, aws_markerMVGWT07);
												});

				google.maps.event.addListener(aws_markerMVGWT07, 'dblclick', function(){
													window.location.href = aws_markerMVGWT07.url;
												});



				var aws_markerMVGWT02 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.1435,138.6632),
										map: map,
										title: "Kangarilla",
										url: "?aws_id=MVGWT02"  
										});

				google.maps.event.addListener(aws_markerMVGWT02, 'click', function(){
													var infocontentMVGWT02 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Kangarilla</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>6.6 &deg;C</td><td>2.6 &deg;C</td><td>-10.6 &deg;C</td><td>27.9 %</td><td>4.2 &deg;C</td></tr></table>';
													var infowindowMVGWT02 = new google.maps.InfoWindow({
														content: infocontentMVGWT02,
														minWidth: 200
													});													
													infowindowMVGWT02.open(map, aws_markerMVGWT02);
												});

				google.maps.event.addListener(aws_markerMVGWT02, 'dblclick', function(){
													window.location.href = aws_markerMVGWT02.url;
												});



				var aws_markerMVGWT01 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.2643,138.6426),
										map: map,
										title: "Kuitpo",
										url: "?aws_id=MVGWT01"  
										});

				google.maps.event.addListener(aws_markerMVGWT01, 'click', function(){
													var infocontentMVGWT01 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Kuitpo</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>6.2 &deg;C</td><td>2.1 &deg;C</td><td>4.0 &deg;C</td><td>86.6 %</td><td>1.0 &deg;C</td></tr></table>';
													var infowindowMVGWT01 = new google.maps.InfoWindow({
														content: infocontentMVGWT01,
														minWidth: 200
													});													
													infowindowMVGWT01.open(map, aws_markerMVGWT01);
												});

				google.maps.event.addListener(aws_markerMVGWT01, 'dblclick', function(){
													window.location.href = aws_markerMVGWT01.url;
												});



				var aws_markerMVGWT08 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.207,138.6129),
										map: map,
										title: "McLaren Flat",
										url: "?aws_id=MVGWT08"  
										});

				google.maps.event.addListener(aws_markerMVGWT08, 'click', function(){
													var infocontentMVGWT08 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">McLaren Flat</span> at: 15/09, 19:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>10.9 &deg;C</td><td>7.2 &deg;C</td><td>6.0 &deg;C</td><td>71.7 %</td><td>2.4 &deg;C</td></tr></table>';
													var infowindowMVGWT08 = new google.maps.InfoWindow({
														content: infocontentMVGWT08,
														minWidth: 200
													});													
													infowindowMVGWT08.open(map, aws_markerMVGWT08);
												});

				google.maps.event.addListener(aws_markerMVGWT08, 'dblclick', function(){
													window.location.href = aws_markerMVGWT08.url;
												});



				var aws_markerMVGWT09 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.2349,138.5493),
										map: map,
										title: "McLaren Vale",
										url: "?aws_id=MVGWT09"  
										});

				google.maps.event.addListener(aws_markerMVGWT09, 'click', function(){
													var infocontentMVGWT09 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">McLaren Vale</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>5.9 &deg;C</td><td>2.1 &deg;C</td><td>3.7 &deg;C</td><td>85.8 %</td><td>1.0 &deg;C</td></tr></table>';
													var infowindowMVGWT09 = new google.maps.InfoWindow({
														content: infocontentMVGWT09,
														minWidth: 200
													});													
													infowindowMVGWT09.open(map, aws_markerMVGWT09);
												});

				google.maps.event.addListener(aws_markerMVGWT09, 'dblclick', function(){
													window.location.href = aws_markerMVGWT09.url;
												});



				var aws_markerMVGWT04 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.1885,138.5406),
										map: map,
										title: "Seaview",
										url: "?aws_id=MVGWT04"  
										});

				google.maps.event.addListener(aws_markerMVGWT04, 'click', function(){
													var infocontentMVGWT04 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Seaview</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>6.5 &deg;C</td><td>2.5 &deg;C</td><td>5.2 &deg;C</td><td>91.6 %</td><td>0.6 &deg;C</td></tr></table>';
													var infowindowMVGWT04 = new google.maps.InfoWindow({
														content: infocontentMVGWT04,
														minWidth: 200
													});													
													infowindowMVGWT04.open(map, aws_markerMVGWT04);
												});

				google.maps.event.addListener(aws_markerMVGWT04, 'dblclick', function(){
													window.location.href = aws_markerMVGWT04.url;
												});



				var aws_markerMVGWT03 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.2076,138.5253),
										map: map,
										title: "Visitor Centre",
										url: "?aws_id=MVGWT03"  
										});

				google.maps.event.addListener(aws_markerMVGWT03, 'click', function(){
													var infocontentMVGWT03 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Visitor Centre</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>4.9 &deg;C</td><td>1.0 &deg;C</td><td>2.9 &deg;C</td><td>87.4 %</td><td>0.9 &deg;C</td></tr></table>';
													var infowindowMVGWT03 = new google.maps.InfoWindow({
														content: infocontentMVGWT03,
														minWidth: 200
													});													
													infowindowMVGWT03.open(map, aws_markerMVGWT03);
												});

				google.maps.event.addListener(aws_markerMVGWT03, 'dblclick', function(){
													window.location.href = aws_markerMVGWT03.url;
												});



				var aws_markerMVGWT05 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.261,138.5532),
										map: map,
										title: "Willunga",
										url: "?aws_id=MVGWT05"  
										});

				google.maps.event.addListener(aws_markerMVGWT05, 'click', function(){
													var infocontentMVGWT05 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Willunga</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>11.1 &deg;C</td><td>6.7 &deg;C</td><td>6.4 &deg;C</td><td>73.2 %</td><td>2.3 &deg;C</td></tr></table>';
													var infowindowMVGWT05 = new google.maps.InfoWindow({
														content: infocontentMVGWT05,
														minWidth: 200
													});													
													infowindowMVGWT05.open(map, aws_markerMVGWT05);
												});

				google.maps.event.addListener(aws_markerMVGWT05, 'dblclick', function(){
													window.location.href = aws_markerMVGWT05.url;
												});



				var aws_markerMVGWT06 = new google.maps.Marker({
										position: new google.maps.LatLng(-35.307,138.4997),
										map: map,
										title: "Willunga Foothills",
										url: "?aws_id=MVGWT06"  
										});

				google.maps.event.addListener(aws_markerMVGWT06, 'click', function(){
													var infocontentMVGWT06 = '<table class="table_data" style="width:375px"><tr><th colspan="5">Latest reading for <span style="font-size:14px;">Willunga Foothills</span> at: 15/09, 22:00</th></tr><tr><td style="width:75px;">Air Temp</td><td style="width:75px;">App Tem</td><td style="width:75px;">Dew Pt</td><td style="width:75px;">RH</td><td style="width:75px;">Delta-T</td></tr><tr><td>10.2 &deg;C</td><td>5.2 &deg;C</td><td>5.2 &deg;C</td><td>71.6 %</td><td>2.4 &deg;C</td></tr></table>';
													var infowindowMVGWT06 = new google.maps.InfoWindow({
														content: infocontentMVGWT06,
														minWidth: 200
													});													
													infowindowMVGWT06.open(map, aws_markerMVGWT06);
												});

				google.maps.event.addListener(aws_markerMVGWT06, 'dblclick', function(){
													window.location.href = aws_markerMVGWT06.url;
												});

			}//initialize
			
			window.onload = initialize;