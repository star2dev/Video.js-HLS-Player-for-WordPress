# [Video.js HLS Player] for WordPress
[Video.js HLS Player] is a user-friendly plugin that supports HLS video playback on desktop and mobile devices. It's super easy to embed externally hosted .m3u8 HLS video packages using Video.js library on WordPress.
Website: <a href="https://www.socialite-media.com/videojs-hls-player-for-wordpress">https://www.socialite-media.com/videojs-hls-player-for-wordpress</a>

<h3>Video.js HLS Player Features</h3>

<ul>
	<li>Embed HLS video package into a post/page or anywhere on your WordPress site</li>
	<li>Embed MP4 video files into a post/page or anywhere on your WordPress site</li>
	<li>Embed responsive videos for a better user experience while viewing from a mobile device</li>
	<li>Embed HTML5 videos which are compatible with all major browsers</li>
	<li>Embed videos with poster images</li>
	<li>Embed videos using videojs player</li>
	<li>Automatically play a video when the page is rendered</li>
	<li>Embed videos uploaded to your WordPress media library using direct links in the shortcode</li>
	<li>No setup required, simply install and start embedding videos</li>
	<li>Lightweight and compatible with the latest version of WordPress</li>
	<li>Clean and sleek player with no watermark</li>
	<li>Fallbacks for other HTML5-supported filetypes (MP4, WebM, Ogv)</li>
</ul>

<h3>Video.js HLS Player Plugin Usage</h3>

<p>In order to embed a video create a new post/page and use the following shortcode:</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot;]</pre>

<p>Here, &quot;url&quot; is the location of the HLS video package file.</p>

<h3>Video Shortcode Options</h3>

<p>The following options are supported in the shortcode.</p>

<h4>MP4</h4>

<p>You can specify an MP4 video file in addition to the source HLS video file. This parameter is optional.</p>

<pre>
[videojs_hls 
&nbsp; url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; 
  mp4=&quot;http://example.com/wp-content/uploads/videos/myvid.mp4&quot;
]</pre>

<h4>WebM</h4>

<p>You can specify a WebM video file in addition to the source HLS video file. This parameter is optional.</p>

<pre>
[videojs_hls 
  url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; 
  webm=&quot;http://example.com/wp-content/uploads/videos/myvid.webm&quot;
]</pre>

<h4>Ogv</h4>

<p>You can specify a Ogv video file in addition to the source HLS video file. This parameter is optional.</p>

<pre>
[videojs_hls 
  url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; 
  ogv=&quot;http://example.com/wp-content/uploads/videos/myvid.ogv&quot;
]</pre>

<h4>Width</h4>

<p>Defines the width of the video file (Height is automatically calculated). This option is not required unless you want to limit the maximum width of the video.</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; width=&quot;480&quot;]</pre>

<h4>Preload</h4>

<p>Specifies if and how the video should be loaded when the page loads. Defaults to &quot;auto&quot; (the video should be loaded entirely when the page loads). Other options:</p>

<ul>
	<li>&quot;metadata&quot; - only metadata should be loaded when the page loads</li>
	<li>&quot;none&quot; - the video should not be loaded when the page loads</li>
</ul>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; preload=&quot;metadata&quot;]</pre>

<h4>Controls</h4>

<p>Specifies if video controls should be displayed. Defaults to &quot;true&quot;. In order to hide controls set this parameter to &quot;false&quot;.</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; controls=&quot;false&quot;]</pre>

<p><em>When you disable controls users will not be able to interact with your videos. So It is recommended that you enable autoplay for a video with no controls.</em></p>

<h4>Autoplay</h4>

<p>Causes the video file to automatically play when the page loads.</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; autoplay=&quot;true&quot;]</pre>

<h4>Poster</h4>

<p>Defines image to show as placeholder before the video plays.</p>

<pre>
[videojs_hls 
  url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; 
  poster=&quot;http://example.com/wp-content/uploads/poster.jpg&quot;
]</pre>

<h4>Loop</h4>

<p>Loop to beginning when done and automatically start playing again.</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; loop=&quot;true&quot;]</pre>

<h4>Muted</h4>

<p>Mute the audio output of the video.</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; muted=&quot;true&quot;]</pre>

<h4>iOS Inline</h4>

<p>Force the video to play inline on iOS v10+</p>

<pre>
[videojs_hls url=&quot;https://player.vimeo.com/external/xxxxxxxxx.m3u8&quot; inline=&quot;true&quot;]</pre>

<h3>Installation</h3>

<ol>
	<li>Go to the Add New plugins screen in your WordPress Dashboard</li>
	<li>Click the upload tab</li>
	<li>Browse for the plugin file (videojs-hls-player.zip) on your computer</li>
	<li>Click &quot;Install Now&quot; and then hit the activate button</li>
</ol>