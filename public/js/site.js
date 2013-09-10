App = {
	init : function() {
		this.audioPlayer();
	},

	audioPlayer : function() {

		/**
		 * Audio Player
		 *--------------------------------*
		 */

		$.fn.getPlayer = function(item) {
			var player = this.parent('.audio-player');
			if(item == null) {
				return player;
			}
			else {
				return player.find(item);
			}
		};

		$('audio').each(function (index, e) {

			audio = $(this);

			// Hide the audio element
			audio.hide();

			// Put Audio in a div class audio-player
			audio.wrap('<div id="audio-' + (index+1) + '" class="audio-player" />');

			// Audio player selector
			player = audio.getPlayer();

			playerWidth = player.width();

			// Add a play button
			player.append('<div class="time"></div><div class="loaded"></div><a href="#" class="play"><i class="icon-play"></i></a>');		
			
		});

		function playAudio(audioE) {
			player = $(audioE).getPlayer();
			if(audioE.paused) {			
				player.addClass('playing');
				player.find('i').removeClass('icon-play').addClass('icon-pause');
				audioE.play();
			}
			else {
				player.removeClass('playing');
				player.find('i').removeClass('icon-pause').addClass('icon-play');
				//button.getPlayer('.time').css("width", 0);
				audioE.pause();
			}
		}
		
		$('.audio-player').on('click', function(e) {
			audio = $(this).find('audio');
			audioE = audio.get(0);
			if($(this).is('.playing'))
			{
				clickX = e.pageX;
				playerWidth = $(this).width();
				playerX = $(this).offset().left;
				clickWidth = (clickX - playerX);
				audio = $(this).find('audio');
				audioE = audio.get(0);
				totalTime = audioE.duration;
				clickTime = (clickWidth / playerWidth) * totalTime;
				loadedTime = audioE.buffered.end(0);

				if(clickTime < loadedTime) {
					audioE.currentTime = clickTime;
				}

			}
			else
			{
				playAudio(audioE);
			}

		});


		$('.audio-player .play').on('click', function(e) {
			e.stopPropagation();
			
			// Prevent Event
			e.preventDefault();

			button = $(this);
			audioE = button.getPlayer('audio').get(0);	

			playAudio(audioE);
				
		});	

		


		$('audio').on("timeupdate", function () {
			currentTime = this.currentTime;
			totalTime = this.duration;
			timeWidth = (currentTime / totalTime) * playerWidth;

			$(this).getPlayer('.time').css("width", timeWidth);
			//$(this).parent('.audio-player').find('.time').html(timeWidth);
		});

		$('audio').on("progress", function() {
			audioE = this;
			loadedTime = audioE.buffered.end(0);
			totalTime = audioE.duration;
			playerWidth = $(this).getPlayer().width();
			loadedWidth = (loadedTime / totalTime) * playerWidth;

			$(this).getPlayer('.loaded').css("width", loadedWidth);
		});

	},

	searchForm : function() {
		current_page_item = $('.current_page_item');
		$('.search-button a').click(function(event) {	

			event.preventDefault();
			
			current_page_item.toggleClass('current_page_item');
			li = $(this).parent('li')
				
			if(li.hasClass('active') == false) {
				$('.search-form').show().animate({"width": "100%"}, 100);
			}
			else {
				$('.search-form').animate({"width": "0%"}, 100);
				setTimeout(function() {
					$('.search-form').hide();
					}, 100);
			}
			li.toggleClass('active');
		});
	}
};

App.init();