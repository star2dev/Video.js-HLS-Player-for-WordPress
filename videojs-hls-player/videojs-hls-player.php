<?php
/*
Plugin Name: Video.js HLS Player
Version: 1.0.2
Plugin URI: http://www.socialite-media.com/videojs-hls-player-for-wordpress
Author: Bruce Galpin
Author URI: http://www.socialite-media.com/
Description: Easily embed responsive/fluid (or fixed width) HLS videos into WordPress posts and pages using this customized video.js player. Embedding externally hosted .m3u8 HLS video files couldn't be easier.
Text Domain: videojs-hls-player
Domain Path: /languages
*/

if (!defined('ABSPATH')) 
{
    exit;
}

if (!class_exists('VIDEOJS_HLS_PLAYER')) 
{
    class VIDEOJS_HLS_PLAYER 
	{
        var $plugin_version = '1.0.2';
		
        function __construct() 
		{
            define('VIDEOJS_HLS_PLAYER_VERSION', $this->plugin_version);
            $this->plugin_includes();
        }

        function plugin_includes() 
		{
            if (is_admin()) 
			{
                add_filter('plugin_action_links', array($this, 'plugin_action_links'), 10, 2);
            }
			
            add_action('plugins_loaded', array($this, 'plugins_loaded_handler'));
            add_action('wp_enqueue_scripts', 'videojs_hls_player_enqueue_scripts');
            add_action('admin_menu', array($this, 'add_options_menu'));
            add_action('wp_head', 'videojs_hls_player_header');
            
			add_shortcode('videojs_hls', 'videojs_hls_video_embed_handler');
			
            add_filter('widget_text', 'do_shortcode');
            add_filter('the_excerpt', 'do_shortcode', 11);
            add_filter('the_content', 'do_shortcode', 11);
        }

        function plugin_url() 
		{
            if ($this->plugin_url) return $this->plugin_url;
			else return $this->plugin_url = plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__));
        }

        function plugin_action_links($links, $file) 
		{
            if ($file == plugin_basename(dirname(__FILE__) . '/videojs-hls-player.php')) 
			{
                $links[] = '<a href="options-general.php?page=videojs-hls-player-settings">'.__('Settings', 'videojs-hls-player').'</a>';
            }
            return $links;
        }
        
        function plugins_loaded_handler()
        {
            load_plugin_textdomain('videojs-hls-player', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'); 
        }

        function add_options_menu() 
		{
            if (is_admin()) 
			{
                add_options_page(__('Video.js Settings', 'videojs-hls-player'), __('Video.js HLS Player', 'videojs-hls-player'), 'manage_options', 'videojs-hls-player-settings', array($this, 'options_page'));
            }
        }

        function options_page() 
		{
            $url = "http://www.socialite-media.com/videojs-hls-player-for-wordpress";
            $link_text = sprintf(wp_kses(__('For detailed documentation please visit the plugin homepage <a target="_blank" href="%s">here</a>.', 'videojs-hls-player'), array('a' => array('href' => array(), 'target' => array()))), esc_url($url));
            
			echo '<div class="wrap"><h2>Video.js HLS Player - v' . $this->plugin_version . '</h2>';
            echo '<div class="update-nag">' . $link_text . '</div>';
            echo '</div>';
        }

    }

    $GLOBALS['easy_video_player'] = new VIDEOJS_HLS_PLAYER();
}

function videojs_hls_player_enqueue_scripts() 
{
    if (!is_admin()) 
	{
		$plugin_url = plugins_url('', __FILE__);
        
		// LOAD ALL JAVASCRIPT
		wp_enqueue_script('jquery');
        
		wp_register_script(
			'videojs', 
			'//vjs.zencdn.net/5.9.2/video.js', 
			array('jquery'), 
			VIDEOJS_HLS_PLAYER_VERSION, 
			true
		);
        wp_enqueue_script('videojs');
        
		wp_register_script(
			'videojs-hls', 
			$plugin_url . '/videojs-contrib-hls/videojs-contrib-hls.min.js', 
			array('jquery'), 
			VIDEOJS_HLS_PLAYER_VERSION, 
			true
		);
        wp_enqueue_script('videojs-hls');
        
		wp_register_script(
			'videojs-ie8', 
			'//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js', 
			array('jquery'), 
			VIDEOJS_HLS_PLAYER_VERSION
		);
        wp_enqueue_script('videojs-ie8');
        
		wp_register_script(
			'videojs-airplay', 
			$plugin_url . '/videojs-airplay/videojs.airplay.js', 
			array('jquery'), 
			VIDEOJS_HLS_PLAYER_VERSION, 
			true
		);
        wp_enqueue_script('videojs-airplay');
        
		wp_register_script(
			'videojs-custom', 
			$plugin_url . '/videojs-hls-player.js', 
			array('jquery'), 
			VIDEOJS_HLS_PLAYER_VERSION, 
			true
		);
        wp_enqueue_script('videojs-custom');
        
		// LOAD ALL CSS
		wp_register_style(
			'videojs', 
			'//vjs.zencdn.net/5.9.2/video-js.css'
		);
        wp_enqueue_style('videojs');
        
		wp_register_style('videojs-style', $plugin_url . '/videojs-hls-player.css');
        wp_enqueue_style('videojs-style');
        
		wp_register_style('videojs-airplay', $plugin_url . '/videojs-airplay/videojs.airplay.css');
        wp_enqueue_style('videojs-airplay');
    }
}

function videojs_hls_player_header() 
{
    if (!is_admin()) 
	{
		$config = '
<!-- This site is embedding HLS video using Video.js HLS Plugin v' . VIDEOJS_HLS_PLAYER_VERSION . ' - https://www.socialite-media.com/videojs-hls-player-for-wordpress -->

';
        echo $config;
    }
}

function videojs_hls_video_embed_handler($atts) 
{
    extract(shortcode_atts(array(
        'url' => '',
        'mp4' => '',
        'webm' => '',
        'ogv' => '',
        'width' => '',
        'controls' => '',
        'preload' => 'auto',
        'autoplay' => 'false',
        'loop' => '',
        'muted' => '',
        'poster' => '',
        'class' => '',
		'inline' => 'false'
    ), $atts));
    
	if (empty($url))
	{
        return __('You need to specify the HLS src of the video file', 'videojs-hls-player');
    }
    
	// SRC Type = application/x-mpegURL
    $src = '
			<source src="' . $url . '" type="application/x-mpegURL" />
	';
    
	if (!empty($mp4)) 
	{
        $mp4 = '<source src="' . $mp4 . '" type="video/mp4" />
		';
        $src = $src . $mp4; 
    }
	
    if (!empty($webm)) 
	{
        $webm = '<source src="' . $webm . '" type="video/webm" />
		';
        $src = $src . $webm; 
    }
	
    if (!empty($ogv)) 
	{
        $ogv = '<source src="' . $ogv . '" type="video/ogg" />
		';
        $src = $src . $ogv; 
    }
	
    // Controls
    if ($controls == 'false') $controls = '';
    else $controls = ' controls';
	
    // Preload
    if ($preload == 'metadata') $preload = ' preload="metadata"';
    else if ($preload == 'none') $preload = ' preload="none"';
    else $preload = ' preload="auto"';
	
    // Autoplay
    if ($autoplay == 'true') $autoplay = ' autoplay';
    else $autoplay = '';
	
    // Loop
    if ($loop == 'true') $loop = ' loop';
    else $loop = '';
	
    // Muted
    if ($muted == 'true') $muted = ' muted';
    else $muted = '';
	
    // Poster
    if(!empty($poster)) $poster = ' poster="' . $poster . '"';
	
    // Controls
    if ($inline == 'false') $inline = '';
    else $inline = ' playsinline';
	
    $player = "videojs" . uniqid();
    
	// Custom Style
    $style = '';   
    if (!empty($width)){
        $style = '
	<style>
		.videojs-hls-player-wrapper.' . $player . ' {
			max-width: ' . $width . 'px;   
		}
	</style>
';
        
    }
    
	// Video.js Player
	$output = '
    <div class="videojs-hls-player-wrapper ' . $player . '">
		<video id="' . $player . '" class="video-js vjs-default-skin vjs-fluid vjs-16-9 vjs-big-play-centered"' . $controls . $preload . $autoplay . $loop . $muted . $poster . ' data-setup=\'{"fluid":true,"plugins":{"airplayButton":{}}}\'' . $inline . '>
			' . $src . '
			<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
		</video>
	</div>
    ' . $style . '
';
    
	return $output;
}
