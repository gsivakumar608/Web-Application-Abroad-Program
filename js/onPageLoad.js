/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project #2 */
$(document).ready(function() {
	$('#menu > li').hover(function() {
		var $this = $(this);
		$('a', $this).stop(true, true).animate({
			'bottom' : '-15px'
		}, 300);
		$('i', $this).stop(true, true).animate({
			'top' : '-10px'
		}, 400);
	}, function() {
		var $this = $(this);
		$('a', $this).stop(true, true).animate({
			'bottom' : '-95px'
		}, 300);
		$('i', $this).stop(true, true).animate({
			'top' : '50px'
		}, 400);
	});

});
