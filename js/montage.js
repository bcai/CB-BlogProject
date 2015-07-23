

$(document).ready(function() {
	var $container 	= $('#secondary'),
					$imgs		= $container.find('img').hide(),
					totalImgs	= $imgs.length,
					cnt			= 0;
	
	$imgs.each(function(i) {
		var $img	= $(this);
		$('<img/>').load(function() {
			++cnt;
			if( cnt === totalImgs ) {
				$imgs.show();
				$container.montage({
					fixedHeight : 60
				});
				
			}
		}).attr('src',$img.attr('src'));
	});	
});
