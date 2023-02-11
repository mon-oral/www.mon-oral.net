<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />	

		<title>Entraînement - Étape 2</title>

		<!-- Scripts -->
		<script src="{{ asset('js/DetectRTC.min.js') }}"></script>
			
		<!-- Recorder -->
		<script src="{{ asset('js/recorder.min.js') }}"></script>
		
	</head>
		
	<body>	

		<div class="p-2 mb-3 text-monospace text-center text-danger" style="color:#d9ae00;background-color:#f1c40f">
			<i class="fas fa-chevron-circle-right pr-2"></i></i>suivez les étapes<i class="fas fa-chevron-circle-left pl-2"></i>
		</div>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement - Étape 2</div>
					</div>
				</div>
			</nav>
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 mb-5">
						
						<!-- TEST SYSTEM -->
						<div id="test_system" style="display:none;">
							<p class="text-danger"><i class="fas fa-bomb" style="font-size:20px;"></i> <b>Votre système n'est pas prêt</b></p>
							<div id="configuration" class="text-muted small pb-2 pl-4 pr-3"></div>
							<p class="pt-2 pb-2 pl-4 pr-4 text-justify">
								<img src="{{ asset('img/logo-connexion.png') }}" alt="connexion" style="margin:0px 20px 0px 20px;float:left;width:120px;height:120px;">
								Vérifiez les branchements et la configuration votre microphone. Lisez la documentation qui correspond à votre environnement : <a href="https://support.google.com/chrome/answer/2693767" target="_blank">Chrome</a>, <a href="https://support.mozilla.org/fr/kb/gerer-permissions-camera-et-microphone" target="_blank">Firefox</a>, <a href="https://support.apple.com/fr-fr/guide/safari/ibrwe2159f50/mac" target="_blank">Safari</a>, <a href="https://support.apple.com/fr-fr/guide/mac-help/mchla1b1e1fe/mac" target="_blank">macOS</a>, <a href="https://support.apple.com/fr-fr/HT203792" target="_blank">iOS</a>. Si les problèmes persistent, fermez et rouvrez votre navigateur, faites des tests avec différents navigateurs, ordinateurs, téléphones ou redémarrez votre ordinateur.
							</p>							
							<form method="post" action="{{ url()->current() }}" class="text-center" role="form">
								@csrf
								<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-sync-alt align-middle pr-2"></i>réessayez</button>
							</form>							
						</div>
						<!-- /TEST SYSTEM -->
						
						<!-- TEST AUDIO -->
						<div class="row" id="test_audio" style="display:none;">
						
							<div class="col-md-8 offset-md-2">

								<p class="text-center font-weight-bold">TEST AUDIO</p>

								<p class="small text-center text-center text-muted" id="start_test">Cliquez sur le bouton ci-dessous pour lancer un test audio de quelques secondes.</p>
								
								<div class="text-center"><button type="button" class="btn btn-success btn-sm pt-2" id="start_button">
									<i class="material-icons">&#xe31d</i></button>
								</div>

								<div id="rec_test" style="display:none" class="text-center mt-3">
									<div class="text-centered pt-3 pb-1">
										<img src="{{ asset('img/record.gif') }}" width="42" style="opacity:0.9" />
										<p class="m-0 p-0 text-monospace text-danger">PARLEZ!</p>
									</div>
									<div id="countdown" style="color:black;font-weight:700">&nbsp;</div>
								</div>

								<div id="player" style="width:350px;margin:0px auto 0px auto;text-align:center;"></div>
								
								<div id="next" style="display:none" class="">
								
									<p class="text-center text-monospace m-0 text-danger">ÉCOUTEZ CE TEST</p>
									<p class="text-center small text-monospace text-danger">attendez quelques secondes que le lecteur se charge</span></p>
									
									<p>
										Si, à la lecture de ce test, vous entendez clairement votre voix, le test est positif.
									</p>
									

									<a href="/entrainement-etape3" role="button"class="btn btn-primary">je confirme avoir entendu ma voix lors de la lecture du test<i class='fas fa-arrow-right align-middle pl-2'></i></a>

									
									<p class="text-justify text-muted small mt-5">
										Si aucun lecteur audio ne s'affiche ou s'il n'y a pas de son, vérifiez les branchements de votre micro, de vos haut-parleurs ou écouteurs, vérifiez les paramètres son de votre ordinateur ou téléphone, fermez et rouvrez votre navigateur, essayez différents navigateurs, ordinateurs, téléphones ou redémarrez votre ordinateur.<br />
									</p>
									<form method="post" action="{{ url()->current() }}" class="text-center" role="form">
										@csrf
										<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-sync-alt align-middle pr-2"></i>réessayer</button>
									</form>
								</div>	
								
							</div>	
							
						</div>
						<!-- /TEST AUDIO -->					
						
					</div>
					
					<div class="col-md-6 text-muted">
						<b>Configurations recommandées</b>
						<ul>
							<li>Chrome / Firefox + Windows</li>
							<li>Chrome / Firefox / Safari + macOS</li>
							<li>Chromebook</li>
							<li>Chrome + Android</li>
							<li>Safari + iOS (le micro ne fonctionne pas avec d'autres navigateurs)</li>
						</ul>
						<b class="text-danger">CONSEILS IMPORTANTS</b><br />Utiliser un appareil relativement récent et à jour, vérifier la batterie avant de commencer, s'assurer que l'appareil ne se mettra pas en veille.
					</div>
					
				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->			
		
		
		<!-- dirty trick to bypass webrtc blockers -->
        <iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>

		@include('inc-bottom-js')	
		
		<script>
			
		// WebRTC
		function onDetectRTCLoaded() {
			test_system = 1;
			configuration = '';
			if (DetectRTC.hasMicrophone) {
				configuration += '<div style="color:#27ae60"><i class="material-icons align-text-top" style="font-size:16px;">done</i> Présence d\'un microphone</div>'
			} else {
				test_system = 0;
				configuration += '<div style="color:#d35400"><i class="material-icons align-text-top" style="font-size:16px;">clear</i> Absence de microphone</div>'
			}
			if (DetectRTC.isWebsiteHasMicrophonePermissions) {
				configuration += '<div style="color:#27ae60"><i class="material-icons align-text-top" style="font-size:16px;">done</i> Autorisation d\'utiliser le microphone</div>'
			} else {
				test_system = 0;
				configuration += '<div style="color:#d35400"><i class="material-icons align-text-top" style="font-size:16px;">clear</i> Absence d\'autorisation d\'utiliser le microphone</div>'				
				//configuration += '<div style="color:#d35400"><i class="material-icons align-text-top" style="font-size:16px;">clear</i> Autorisation d\'utiliser le //microphone</div><div style="padding-left:20px;padding-bottom:5px;">Vérifiez la configuration de votre microphone : <a //href="https://support.google.com/chrome/answer/2693767" target="_blank">Chrome</a> - <a //href="https://support.mozilla.org/fr/kb/gerer-permissions-camera-et-microphone" target="_blank">Firefox</a> - <a //href="https://support.apple.com/fr-fr/guide/safari/ibrwe2159f50/mac" target="_blank">Safari</a> - <a //href="https://support.apple.com/fr-fr/guide/mac-help/mchla1b1e1fe/mac" target="_blank">macOS</a> - <a href="https://support.apple.com/fr-fr/HT203792" //target="_blank">iOS</a></div>'	
			}

			//if (DetectRTC.hasSpeakers) {
			//	configuration += '<div style="color:#27ae60"><i class="material-icons align-text-top" style="font-size:16px;">done</i> Présence de haut-parleurs</div>'
			//} else {
			//	test_system = 0;
			//	configuration += '<div style="color:#d35400"><i class="material-icons align-text-top" style="font-size:16px;">clear</i> Présence de haut-parleurs</div>'
			//}
			
			document.getElementById('configuration').innerHTML = configuration;	
			
			if (test_system == 0) {
				$('#test_system').css('display', 'block');
				$('#test_audio').css('display', 'none');
			} else {
				$('#test_system').css('display', 'none');
				$('#test_audio').css('display', 'block');
			}
			
		}

		function reloadDetectRTC(callback) {
			DetectRTC.load(function() {
				onDetectRTCLoaded();

				if(callback && typeof callback == 'function') {
					callback();
				}
			});
		}
		
		DetectRTC.load(function() {
			reloadDetectRTC();

			try {
				if(DetectRTC.MediaDevices[0] && DetectRTC.MediaDevices[0].isCustomLabel) {
					navigator.mediaDevices.getUserMedia({audio: true, video: false}).then(function(stream) {
						var video;
						try {
							video = document.createElement('video');
							video.muted = true;
							video.volume = 0;
							video.src = URL.createObjectURL(stream);
							video.style.display = 'none';
							video.style.opacity = 0;
							(document.body || document.documentElement).appendChild(vide);
						}
						catch(e) {}

						reloadDetectRTC(function() {
							// release camera
							stream.getTracks().forEach(function(track) {
								track.stop();
							});

							if(video && video.parentNode) {
								video.parentNode.removeChild(video);
							}
						});
					}).catch(reloadDetectRTC);
					return;
				}
			}
			catch(e) {}

			onDetectRTCLoaded();
			
		});				

		
		// Recording
		function __log(e, data) {
			log.innerHTML += "\n" + e + " " + (data || '');
		}
		
		if (!Recorder.isRecordingSupported()) {
		
			__log('<span style="color:red;font-weight:bold">Recording features are not supported in your browser.</span>');
		
		} else {
		
			var recorder = new Recorder({
				monitorGain: parseInt(0, 10),
				numberOfChannels: parseInt(1, 10),
				encoderBitRate: parseInt(64000,10),
				encoderSampleRate: parseInt(48000,10),
				encoderPath: "encoderWorker.min.js"
			});

			start_button.addEventListener( "click", function(){ 
				recorder.start().catch(function(e){
					__log('Error encountered: ' + e.message );
				});
			});

			recorder.onstart = function(e){
				//__log('Recorder is started');
				//start_button.disabled = resume.disabled = true;
				//pause.disabled = stop_button.disabled = false;
				$('#start_label').css('display', 'none');
				$('#start_button').css('display', 'none');
				$('#stop_button').css('display', 'inline');
				$('#start_test').css('display', 'none');
				
				
				setTimeout(function(){ recorder.stop(); }, 4500);
				
				var timeleft = 4;
				var countdown = setInterval(function(){
					if(timeleft < 0){
						clearInterval(countdown);
						document.getElementById("countdown").innerHTML = "";
					} else {
						document.getElementById("countdown").innerHTML = timeleft;
					}
					timeleft -= 1;
				}, 1000);	

				$('#rec_test').css('display', 'block');				
				
			};

			recorder.onstop = function(e){
				//__log('Recorder is stopped');
			};
			
			recorder.ondataavailable = function( typedArray ){
				var dataBlob = new Blob( [typedArray], { type: 'audio/ogg' } );
				
				/* capsule filename */
				var date = new Date();
				var year = date.getFullYear()
				var month = ('0' + (date.getMonth()+1)).slice(-2)
				var day = ('0' + date.getDate()).slice(-2);
				var hours = ('0' + date.getHours()).slice(-2);
				var minutes = ('0' + date.getMinutes()).slice(-2);
				var seconds = ('0' + date.getSeconds()).slice(-2);
				var milliseconds = date.getMilliseconds();
				
				function randomletters(length) {
					var result           = '';
					var characters       = 'abcdefghijklmnopqrstuvwxyz';
					var charactersLength = characters.length;
					for ( var i = 0; i < length; i++ ) {
						result += characters.charAt(Math.floor(Math.random() * charactersLength));
					}
					return result;
				}				
				test_filename = 'entrainement-test_' + year + month + day + '-' + hours + minutes + seconds + milliseconds + '-' + randomletters(6);	

				/* move to server */
				var xhr=new XMLHttpRequest();
				xhr.onload=function(e) {
					
					if(this.readyState === 4) {
						console.log("Server returned: ",e.target.responseText);
						/* create player */
						$('#warning').css('display', 'none');
						var sound      = document.createElement('audio');
						sound.id       = 'audio-player';
						sound.controls = 'controls';
						sound.src      = '/test-lecteur/'+test_filename;
						sound.type     = 'audio/mpeg';
						document.getElementById('player').appendChild(sound);	
						
						$('#rec_test').css('display', 'none');
						$('#next').css('display', 'block');						
					}
				};
				var fd=new FormData();
				fd.append("test_data",dataBlob);
				fd.append("filename",test_filename);
				fd.append("_token","{{ csrf_token() }}");
				xhr.open("POST","/test-mp3",true);
				xhr.send(fd);				
			};			
		}

		</script>
				
			
		
	</body>
</html>