<?php


$user = Auth::user();

echo '<pre>';
print_r($user);
echo '</pre>';

?>


<form>
	<div class="Modal-body">
		<div class="LogInButtons"></div>
		<div class="Form Form--centered">
			<div class="Form-group">
				<input class="FormControl" name="identification" type="text" placeholder="Username or Email" bidi="function a(e){return arguments.length&amp;&amp;e!==n.SKIP&amp;&amp;(t=e,o(a)&amp;&amp;(a._changing(),a._state=&quot;active&quot;,r.forEach((function(e,n){e(s[n](t))})))),t}">
			</div>
			<div class="Form-group">
				<input class="FormControl" name="password" type="password" placeholder="Password" bidi="function a(e){return arguments.length&amp;&amp;e!==n.SKIP&amp;&amp;(t=e,o(a)&amp;&amp;(a._changing(),a._state=&quot;active&quot;,r.forEach((function(e,n){e(s[n](t))})))),t}">
			</div>
			<div class="Form-group">
				<div>
					<label class="checkbox">
						<input type="checkbox" bidi="function a(e){return arguments.length&amp;&amp;e!==n.SKIP&amp;&amp;(t=e,o(a)&amp;&amp;(a._changing(),a._state=&quot;active&quot;,r.forEach((function(e,n){e(s[n](t))})))),t}">Remember Me
					</label>
				</div>
			</div>
			<div class="Form-group">
				<button class="Button Button--primary Button--block" type="submit" title="Log In">
					<span class="Button-label">Log In</span>
				</button>
			</div>
		</div>
	</div>
</form>