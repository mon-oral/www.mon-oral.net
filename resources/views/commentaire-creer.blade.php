@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Commentaire Audio - Enregistrement</title>

		<!-- Scripts -->
		<script src="{{ asset('js/DetectRTC.min.js') }}"></script>

		<!-- Recorder -->
		<script src="{{ asset('js/recorder.min.js') }}"></script>

	</head>

	<body>

		<div id="app">

			<nav class="navbar navbar-expand-md navbar-light mt-2">
				<div class="container">
					<div>
						<div class="float-left"><a href="{{ url('/console/') }}"><img src="{{ asset('img/mon-oral.svg') }}" width="40" /></a></div>
						<div class="float-left text-monospace small pl-3" style="color:#c5c7c9;">Commentaire Audio<br />Enregistrement</div>
					</div>
				</div>
			</nav>

			<div class="container">

				<div class="row mt-5">

					<div class="col-md-8">

						<!-- TEST SYSTEM -->
						<div id="test_system" style="display:none;padding:0px 20px 20px 20px;">
							<p class="text-danger"><i class="fas fa-bomb" style="font-size:20px;"></i> <b>Votre système n'est pas prêt !</b></p>
							<div id="configuration" class="text-muted small pb-2 pl-4 pr-3"></div>
							<p class="pt-2 pb-2 pl-4 pr-4 text-justify">
								<img src="{{ asset('img/logo-connexion.png') }}" alt="connexion" style="margin:0px 20px 0px 20px;float:left;width:120px;height:120px;">
								Vérifiez les branchements et la configuration votre microphone. Lisez la documentation qui correspond à votre environnement : <a href="https://support.google.com/chrome/answer/2693767" target="_blank">Chrome</a>, <a href="https://support.mozilla.org/fr/kb/gerer-permissions-camera-et-microphone" target="_blank">Firefox</a>, <a href="https://support.apple.com/fr-fr/guide/safari/ibrwe2159f50/mac" target="_blank">Safari</a>, <a href="https://support.apple.com/fr-fr/guide/mac-help/mchla1b1e1fe/mac" target="_blank">macOS</a>, <a href="https://support.apple.com/fr-fr/HT203792" target="_blank">iOS</a>. Si les problèmes persistent, fermez et rouvrez votre navigateur, faites des tests avec différents navigateurs, ordinateurs, téléphones ou redémarrez votre ordinateur.
							</p>
							<div class="text-center"><a class="btn btn-danger btn-sm" href="{{ url()->current() }}" role="button"><i class="fas fa-sync-alt align-middle pr-2"></i>réessayer</a></div>
						</div>
						<!-- /TEST SYSTEM -->

						<!-- ENREGISTREMENT -->
						<div id="interface" class="text-center mb-4" style="display:none;">

							<div id="start_rec">
								<div class="p-2"><span id="chrono" class="chrono">00:00</span></div>
								<div class="pb-3 text-monospace text-danger small" id="max">20 minutes maximum</div>
								<button id="start_button" type="button" class="btn btn-success pt-2 mt-2 btn-lg"><i class="material-icons align-middle">keyboard_voice</i></button>
								<div id="start_label" class="small mt-4 text-muted text-monospace">Cliquez sur le bouton ci-dessus<br />pour lancer l'enregistrement audio.</div>
							</div>

							<div id="enregistrement" style="display:none;">
								<!-- PAUSE -->
								<button id="pause_button" type="button" class="btn btn-light btn-lg pt-2 mt-2" style="display:inline;" data-toggle="tooltip"  data-delay='{"show":400,"hide":0}' data-placement="left" title="pause"><i class="material-icons align-middle">pause</i></button>

								<!-- RESUME -->
								<button id="resume_button" style="display:none;" type="button" class="btn btn-light btn-lg pt-2 mt-2" data-toggle="tooltip"  data-delay='{"show":400,"hide":0}' data-placement="left" title="reprendre l'enregistrement"><i class="material-icons align-middle">keyboard_voice</i></button>

								<!-- STOP -->
								<button id="stop_button" type="button" class="btn btn-dark btn-lg pt-2 mt-2" data-toggle="tooltip"  data-delay='{"show":400,"hide":0}' data-placement="right" title="arrêter définitivement l'enregistrement"><i class="material-icons align-middle">stop</i></button>

								<div id="animation">
									<div class="text-centered pt-5"><img src="{{ asset('img/record.gif') }}" width="42" style="opacity:0.9" /></div>
									<div class="text-centered pt-3 text-muted small text-monospace">enregistrement en cours</div>
								</div>
								<div id="pause_label" style="display:none;">
									<div class="text-centered pt-3 text-muted small text-monospace">pause</div>
								</div>
							</div>

							<div id="warning" class="small text-monospace text-danger" style="display:none">
								<b>ATTENTION</b><br />La création du fichier audio peut être<br />plus ou moins longue (de quelques secondes à quelques minutes)<br />selon la longueur de l'enregistrement.
								<div class="text-center pt-2 pb-4">
									<div class="spinner-border text-danger spinner-border-sm" role="status"><span class="sr-only">...</span></div>
								</div>
							</div>

						</div>
						<!-- /ENREGISTREMENT -->

					</div>

					<div class="col-md-4 text-muted">

						<div class="card border-success mb-4">
							<div class="card-body text-success">
								<table class="small">
									<tr>
										<td class="text-center" style="font-size:200%;"><i class="far fa-lightbulb pr-3"></i></td>
										<td class="text-justify">Conseil : avant de faire un enregistrement de plusieurs minutes, faites un enregistrement de quelques secondes pour vérifier que votre microphone et vos haut-parleurs fonctionnent correctement.</td>
									</tr>
								</table>
							</div>
						</div>

						<div class="mb-4">
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

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		<!-- dirty trick to bypass webrtc blockers -->
        <iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>

		<script>

		var chrono = {
			totalSeconds: 0,

			start: function () {
				var self = this;

				this.interval = setInterval(function () {
					self.totalSeconds += 1;

					let m = Math.floor(self.totalSeconds / 60 % 60);
					let s = parseInt(self.totalSeconds % 60);

					if (s < 10) s = '0' + s;
					if (m < 10) m = '0' + m;

					duree_max = 21;

					if (m >= duree_max) {
						clearInterval(intervalRef);
						recorder.stop();
					}

					$('#chrono').text(m + ":" + s);

				}, 1000);
			},

			pause: function () {
				clearInterval(this.interval);
				delete this.interval;
			},

			resume: function () {
				if (!this.interval) this.start();
			}
		};

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
				$('#interface').css('display', 'none');
			} else {
				$('#test_system').css('display', 'none');
				$('#interface').css('display', 'block');
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

			//__log('<span style="color:red;font-weight:bold">Recording features are not supported in your browser.</span>');

		} else {

			var recorder = new Recorder({
				monitorGain: parseInt(0, 10),
				numberOfChannels: parseInt(1, 10),
				encoderBitRate: parseInt(64000,10),
				encoderSampleRate: parseInt(48000,10),
				encoderPath: "../encoderWorker.min.js"
			});

			stop_button.addEventListener( "click", function(){
				recorder.stop();
			});

			start_button.addEventListener( "click", function(){
				recorder.start();
			});

			pause_button.addEventListener( "click", function(){
				recorder.pause();
			});

			resume_button.addEventListener( "click", function(){
				recorder.resume();
			});

			// ON PAUSE
			recorder.onpause = function(e){
				chrono.pause();
				$('#pause_button').css('display', 'none');
				$('#pause_button').tooltip('hide');
				$('#resume_button').css('display', 'inline');
				$('#animation').css('display', 'none');
				$('#pause_label').css('display', 'block');
			};

			// ON RESUME
			recorder.onresume = function(e){
				chrono.resume();
				$('#pause_button').css('display', 'inline');
				$('#pause_button').tooltip('hide');
				$('#resume_button').css('display', 'none');
				$('#animation').css('display', 'block');
				$('#pause_label').css('display', 'none');
			};

			// ON START
			recorder.onstart = function(e){
				chrono.start();
				//start_button.disabled = resume.disabled = true;
				//pause.disabled = stop_button.disabled = false;
				$('#start_label').css('display', 'none');
				$('#start_button').css('display', 'none');
				$('#enregistrement').css('display', 'block');
				$('#stop_button').css('display', 'inline');
			};

			// ON STOP
			recorder.onstop = function(e){
				//start_button.disabled = false;
				//pause.disabled = resume.disabled = stop_button.disabled = true;
				$('#stop_button').css('display', 'none');
				$('#stop_button').tooltip('hide');
				$('#enregistrement').css('display', 'none');
				$('#chrono').css('display', 'none');
				$('#max').css('display', 'none');
				$('#warning').css('display', 'block');
			};

			// ON DATA AVAILABLE
			recorder.ondataavailable = function( typedArray ){

				var dataBlob = new Blob( [typedArray], { type: 'audio/ogg' } );

				/* move to server */
				var xhr = new XMLHttpRequest();
				xhr.onload=function(e) {
					if(this.readyState === 4) {
						//console.log(xhr.responseText);
						$(location).attr('href', 'commentaire-verifier');
					}
				};

				var fd = new FormData();
				fd.append("commentaire_data",dataBlob);
				fd.append("_token","{{ csrf_token() }}");
				xhr.open("POST","commentaire-mp3",true);
				xhr.send(fd);

			};

		}

		</script>

		@include('inc-bottom')
		@include('inc-bottom-js')

	</body>
</html>
