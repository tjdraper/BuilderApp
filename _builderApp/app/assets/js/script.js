$(function() {
	//setInterval(refreshiframe, 2000);
	$('.continuous').click(function() {
		var $this = $(this);
		if ($this.hasClass('on') === false) {
			refreshiframe();
			$this.addClass('on').html('Stop Generating&hellip;');
			refreshIntervalId = setInterval(refreshiframe, 5000);
		} else {
			$this.removeClass('on').html('Begin Generating');
			clearInterval(refreshIntervalId);
		}
	});
	$('.once').click(function() {
		refreshiframe();
		$(this).addClass('success');
		setTimeout(function() {
			$('.once').removeClass('success');
		}, 1000);
	});
});
function refreshiframe() {
	$('#generator').attr('src', '');
	setTimeout(function() {
		$('#generator').attr('src', 'build.php');
	}, 200);
}
