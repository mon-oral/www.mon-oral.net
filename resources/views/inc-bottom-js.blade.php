<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-4.4.1.min.js') }}"></script>

<script>
$(function () {
	$('[data-toggle="popover"]').popover()
})

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

$(function () {
	$('.popover-dismiss').popover({
	  trigger: 'focus'
	})
})
</script>


<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script src="{{ asset('js/mathjax.js') }}"></script>
<script>
MathJax = {
  tex: {
	inlineMath: [['$', '$'], ['\\(', '\\)']],
	processEscapes: true
  },
  svg: {
	fontCache: 'global'
  }
};
</script>

<!-- webinaire -->
<!--<div style="position:fixed;bottom:0;left:0"><a href="https://www.mon-oral.net/webinaire" class="p-4" style="color:#f8fafc;">x</a></div>-->
