<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />		

		<title>Entraînement - Étape 4</title>
			
		<!-- Recorder -->
		<script src="{{ asset('js/recorder.min.js') }}"></script>

	</head>
		
	<body>	
	
		<?php
		$entrainement =  App\Entrainement::find(session()->get('entrainement_id'));
		$sujet =  App\Sujet::find(session()->get('sujet_id'));
		?>

		<div class="p-2 mb-3 text-monospace text-center text-danger" style="color:#d9ae00;background-color:#f1c40f">
			<i class="fas fa-chevron-circle-right pr-2"></i>ne rechargez pas cette page - ne revenez pas en arrière<i class="fas fa-chevron-circle-left pl-2"></i>
		</div>	
		
		<div id="app">		
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement - Étape 4</div>
					</div>
				</div>
			</nav>		

			<div id="wait" class="text-center p-4"><div class="spinner-border text-warning" role="status"><span class="sr-only">...</span></div></div>
			
			<div id="container" class="container" style="display:none;">
			
				<div class="row mt-5">
													
					<div class="col-md-5 mb-5">
							
						<div class="text-center">
						
							<!-- PREPARATION -->
							<div id="etape1" style="margin-bottom:100px;">
								<p class="font-weight-bold m-0">PRÉPARATION</p>
								<p class="font-weight-bold text-secondary mb-3">{{ $entrainement['temps_prep'] }} minute(s)</p>
								<span id="chrono_etape1" class="chrono">00:00</span>
							</div>
							
							<!-- ORAL -->
							<div id="etape2" style="display:none;margin-bottom:100px;">
								<p class="font-weight-bold m-0">ORAL</p>
								<p class="font-weight-bold text-secondary mb-3">{{ $entrainement['temps_oral'] }} minute(s)</p>	
								<div id="warning_record_1" class="pt-2">
									<span class="blink text-danger font-weight-bold">Le chronomètre pour l'oral débute dans 10 secondes.</span>
								</div>	
								<div id="warning_record_2" class="pt-2" style="display:none">
									<span class="text-muted small text-monospace">Le chronomètre pour l'oral a démarré !</span>
								</div>									
								<div id="warning_record_3" class="pt-1 pb-2">
									<span class="blink text-danger font-weight-bold">Vous devrez alors cliquer sur <i class="material-icons align-middle">mic</i> pour commencer<br />votre enregistrement audio.</span>
								</div>
								<div id="warning_record_4" class="pt-3 pb-2" style="display:none">
									<span class="text-danger font-weight-bold">Cliquer sur <i class="material-icons align-middle">mic</i> pour commencer l'enregistrement audio.</span>
								</div>								
								
								<div id="start_rec" style="display:none;">
									<div class="p-2"><span id="chrono_etape2" class="chrono" style="display:none;">00:00</span></div>											
									<div class="p-2"><button type="button" class="btn btn-success pt-2 btn-lg blink" id="start_button"><i class="material-icons align-middle">&#xe31d</i></button></div>
								</div>
							
								<div id="enregistrement" style="display:none;">
									<button type="button" class="btn btn-dark btn-lg pt-2" id="stop_button" data-toggle="tooltip"  data-delay='{"show":400,"hide":0}' data-placement="left" title="arrêter définitivement l'enregistrement"><i class="material-icons align-middle">stop</i></button>	
									<div class="text-centered pt-3"><img src="{{ asset('img/record.gif') }}" width="42" style="opacity:0.9" /></div>
									<div class="text-centered pt-3 text-muted small text-monospace">enregistrement en cours</div>
								</div>

								<div id="warning" class="small text-monospace text-danger" style="display:none">
									<b>ATTENTION</b><br />La création du fichier audio peut être<br />plus ou moins longue (de quelques secondes à quelques minutes)<br />selon la longueur de l'enregistrement.
									<div class="text-center pt-2 pb-4">
										<div class="spinner-border text-danger spinner-border-sm" role="status"><span class="sr-only">...</span></div>
									</div>
								</div>
							
							</div>
							
						</div>
						
					</div>
					
					<div class="col-md-7">
						<div class="font-weight-bold pb-2">SUJET</div>
						<?php
						$sujet = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($sujet['sujet']));
						$sujet = \Illuminate\Mail\Markdown::parse($sujet);
						$sujet = str_replace('<a href=', '<a target="_blank" href=', $sujet);
						?>
						<div class="card"><div class="card-body"><?php echo $sujet ?></div></div>	
					</div>						
					
				</div>
				
			</div><!-- /container -->
		
		</div><!-- /app -->
		
		<!-- dirty trick to bypass webrtc blockers -->
        <iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
	
		<script>

		setTimeout(function() {
			$('#wait').css('display', 'none');
			$('#container').css('display', 'block');
			chrono_etape1();
		}, 4000);	
				
		function chrono_etape1() {
			let start1 = new Date();
			let intervalRef1 = null;

			intervalRef1 = setInterval(_ => {
				let current1 = new Date();
				let count1 = +current1 - +start1;

				let s1 = Math.floor((count1 /  1000)) % 60;
				let m1 = Math.floor((count1 / 60000)) % 60;

				if (s1 < 10) {
					s1_display = '0' + s1;
				} else {
					s1_display = s1;
				}
				if (m1 < 10) {
					m1_display = '0' + m1;
				} else {
					m1_display = m1;
				}
				
				duree_etape_1 = Number({{ $entrainement['temps_prep'] }});
				
				duree_etape_1_warn1 = Math.floor((duree_etape_1 * 65) / 100);
				duree_etape_1_warn2 = Math.floor((duree_etape_1 * 85) / 100);
				duree_etape_1_warn3 = Math.floor((duree_etape_1 * 95) / 100);
				
				if (m1 >= duree_etape_1_warn1) $('#chrono_etape1').css('background-color', '#f1c40f');
				if (m1 >= duree_etape_1_warn2) $('#chrono_etape1').css('background-color', '#e67e22');
				if (m1 >= duree_etape_1_warn2) $('#chrono_etape1').css('color', 'white');
				if (m1 >= duree_etape_1_warn3) $('#chrono_etape1').css('background-color', '#c0392b');
				if (m1 >= duree_etape_1_warn3) $('#chrono_etape1').css('color', 'white');
				
				if (m1 >= duree_etape_1) {
					clearInterval(intervalRef1);
					$('#etape1').css('display', 'none');
					$('#etape2').css('display', 'block');
					setTimeout(function() {
						$('#start_rec').css('display', 'block');
						$('#warning_record_1').css('display', 'none');
						$('#warning_record_3').css('display', 'none');
						$('#warning_record_2').css('display', 'block');
						$('#warning_record_4').css('display', 'block');
						chrono_etape2();
					}, 10000);
				}
				
				$('#chrono_etape1').text(m1_display + ":" + s1_display);
				
			}, 1000);
		}		
		
		function chrono_etape2() {
			let start2 = new Date();
			let intervalRef2 = null;
			
			intervalRef2 = setInterval(_ => {
				let current2 = new Date();
				let count2 = +current2 - +start2;

				let s2 = Math.floor((count2 /  1000)) % 60;
				let m2 = Math.floor((count2 / 60000)) % 60;

				if (s2 < 10) {
					s2_display = '0' + s2;
				} else {
					s2_display = s2;
				}
				if (m2 < 10) {
					m2_display = '0' + m2;
				} else {
					m2_display = m2;
				}
				
				duree_etape_2 = Number({{ $entrainement['temps_oral'] }});
				
				console.log("Durée oral : " + duree_etape_2);
				
				duree_etape_2_warn1 = Math.floor((duree_etape_1 * 65) / 100);
				duree_etape_2_warn2 = Math.floor((duree_etape_1 * 85) / 100);
				duree_etape_2_warn3 = Math.floor((duree_etape_1 * 95) / 100);				
				
				if (m2 >= duree_etape_2_warn1) $('#chrono_etape2').css('background-color', '#f1c40f');
				if (m2 >= duree_etape_2_warn2) $('#chrono_etape2').css('background-color', '#c0392b');
				if (m2 >= duree_etape_2_warn3) $('#chrono_etape2').css('color', 'white');					
				
				console.log("Nombre de minutes : " + m2);
				console.log("Nombre de millisecondes : " + count2);
				
				if (m2 > Number({{ $entrainement['temps_oral'] }})) {
					console.log("Temps dépassé");
					clearInterval(intervalRef2);
					recorder.stop();
				}
				
				$('#chrono_etape2').text(m2_display + ":" + s2_display);
			}, 1000);
		}
					
		if (Recorder.isRecordingSupported()) {
		
			var recorder = new Recorder({
				monitorGain: parseInt(0, 10),
				numberOfChannels: parseInt(1, 10),
				encoderBitRate: parseInt(64000,10),
				encoderSampleRate: parseInt(48000,10),
				encoderPath: "encoderWorker.min.js"
			});

			start_button.addEventListener( "click", function(){ 
				recorder.start();			
			});
			
			stop_button.addEventListener( "click", function(){
				recorder.stop();
			});
			
			recorder.onstart = function(e){
				$('#warning_record_2').css('display', 'none');
				$('#warning_record_4').css('display', 'none');				
				$('#start_button').css('display', 'none');
				$('#enregistrement').css('display', 'block');
				$('#chrono_etape2').css('display', 'inline');
			};

			recorder.onstop = function(e){
				$('#stop_button').css('display', 'none');
				$('#stop_button').tooltip('hide');
				$('#enregistrement').css('display', 'none');
				$('#chrono_etape2').css('display', 'none');
				$('#warning').css('display', 'block');
			};

			recorder.ondataavailable = function( typedArray ){
				var dataBlob = new Blob( [typedArray], { type: 'audio/ogg' } );
								
				/* move to server */
				var xhr=new XMLHttpRequest();
				xhr.onload=function(e) {
					if(this.readyState === 4) {
						$(location).attr('href', 'entrainement-etape5');					
					}					
				};
				var fd=new FormData();
				fd.append("entrainement_data",dataBlob);
				fd.append("_token","{{ csrf_token() }}");
				xhr.open("POST","entrainement-mp3",true);
				xhr.send(fd);
			};		

		}
		
		</script>
	
		@include('inc-bottom-js')
		
	</body>
</html>	