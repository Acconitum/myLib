/**
 * Needs jQuery !
 * 
 * @author Marc Mentha
 * 
 * ***************************************************************************
 * 
 * Example Markup
 * 
 * 	<div class="video-container">
 *		<div class="video" data-video-src="{{video url}}"></div>
 *		<div class="play-button hide"></div>
 *	</div>
 *
 * **************************************************************************
 * 
 * css for respnosive video iframe
 * 
 *	 .video-container {
 *			position:relative;
 *			padding-bottom:51%;
 *			padding-top: rem-calc(30px);
 *			height:0;
 *			overflow:hidden;
 *		}
 *		
 *		.video-container iframe,
 *		.video-container object,
 *		.video-container embed {
 *			position:absolute;
 *			top:0;
 *			left:0;
 *			width:100%;
 *			height:100%;
 *		}
 ** 
 */



/**
 *	get the id of a YouTube video
 * @param {String} url 
 * @return {Int} ID of the given url
 * @author Remo Blaser
 */
function getYoutubeId(url) {
	var ID = '';
	url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
	if (url[2] !== undefined) {
		ID = url[2].split(/[^0-9a-z_\-]/i);
		ID = ID[0];
	} else {
		ID = url;
	}
	return ID;
}

/**
 * Sets data-video-id attribute to given element
 * and its play-button
 * @param {jQuery Object} element 
 * @param {Int} id 
 * @author Marc Mentha
 */
function setPlayerIdAttribute(element, id) {
	element.attr('data-palyer-id', id);
	element.attr('id', 'player' + id);

	// add here other buttons like pause or stop button to assign the data-play-id attribute
	// if you prefer to handle other events aswell
	// for example pause button or stop button
	var playButton = element.parent().find('.play-button');
	if (playButton.length) {
		playButton.attr('data-player-id', id);
	}
}

/**
 * @return {Int} nearly unique id
 * @author Marc Mentha
 */
function createUniqueId() {
	return Math.random().toString(36).substr(2, 16);
}

/**
 * Assemble all YouTube videos on the page
 * and extracts the ID's 
 * @returns {Array} containing video objects
 * @author Marc Mentha
 */
function assembleVideos() {

	// Set a variable to hold the Id's
	videos = new Array();

	// Loop throught every element with the data-video-src attribute
	jQuery('[data-video-src]').each(function () {

		// Extract videoId 
		videoId = getYoutubeId(jQuery(this).attr('data-video-src'));

		// Create playerId allows us to handle same video appearing multiple times on same page
		playerId = createUniqueId();

		// Set data-player-id attribute to the element for unique Youtube player handling
		setPlayerIdAttribute(jQuery(this), playerId);

		video = {};
		video.id = videoId;
		video.playerId = playerId;



		videos.push(video);
	});
	return videos;
}

/**
 * loads Youtube API and adds a script tag to DOM
 * @author Marc Mentha
 */
function loadYouTubeAPI() {

	// This code loads the IFrame Player API code asynchronously.
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";

	// Append script tag to DOM
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

/**
 * Creates an <iframe> (and YouTube player)
 * after the API code downloads.
 * @param {Object} video
 * @return {Object} Youtubeplayer
 * @author Marc Mentha
 */
function createYouTubePlayer(video) {
	player = new window.YT.Player('player' + video.playerId, {
		width: "100%",
		height: "100%",
		videoId: video.id,
		playerVars: {
			rel: 0,
			controls: 0,
			showinfo: 0,
			modestbranding: 1
		}
	});
	return player;
}


/**
 * This function fires after API is loaded
 * initallize every player
 * @author Marc Mentha
 */
var players = {};
function youtubeAPIReady() {

	var videos = assembleVideos();

	for (var i = 0; i < videos.length; i++) {
		players[videos[i].playerId] = createYouTubePlayer(videos[i]);
	}

	jQuery('.play-button').removeClass('hide');
}


/**
 * Functions for calling player functions
 * Not sure why they're needed but won't work otherwise
 */
function playVideo(player) {
	player.playVideo();
}

function stopVideo(player) {
	player.stopVideo();
}

function pauseVideo(player) {
	player.pauseVideo();
}

// triggers on  when youtube api is loaded and ready
window.onYouTubeIframeAPIReady = youtubeAPIReady;


// Eventhandler

loadYouTubeAPI();
jQuery(document).ready(function () {
	jQuery('.play-button').on('click', function () {
		players[jQuery(this).attr('data-player-id')].playVideo();
	})
})


