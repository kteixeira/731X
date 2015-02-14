$(function(){
	$('.slider').cycle({
		timeout: 4000,
		fx: 'fade',
		pager: $('.pager'),
		pagerAnchorBuilder: function(index, DOMelement) {
			return '<a></a>';
		}
	});
	
	 $('.parallax').each(function() {
        var $obj = $(this);
 
        $(window).scroll(function() {
            var offset = $obj.offset();
            var yPos = -($(window).scrollTop() - offset.top) / $obj.data('speed');
            var bgpos = '50% ' + yPos + 'px';
            $obj.css('background-position', bgpos);
        });
    });
});