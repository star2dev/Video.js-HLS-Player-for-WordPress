
jQuery(document).ready(function() {
	// PAUSE OTHER VIDEOS WHEN PLAY
	jQuery('.videojs-hls-player-wrapper video').each(function (videoIndex) {
		var videoId = jQuery(this).attr('id');
		videojs(videoId).ready(function() {
			this.on('play', function(e) {
				jQuery('.video-js').each(function (index) {
					if (videoIndex !== index) {
						this.player.pause();
					}
				});
			});
		});
	});
});
