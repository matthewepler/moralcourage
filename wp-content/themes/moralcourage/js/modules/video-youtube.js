var MORAL = MORAL || {};
MORAL.Video = (function($) {
    return {
        player: null,
        playerDone: null,
        videoId: null,
        $playerInfo: null,
        init: function() {
            this.initEvents();
        },
        initEvents: function() {

            $('.fancybox').fancybox({
                maxWidth    : 800,
                maxHeight   : 600,
                fitToView   : true,
                width       : '95%',
                height      : '95%',
                autoSize    : false,
                closeClick  : false,
                openEffect  : 'none',
                padding     : 0,
                margin      : 10,
                closeEffect : 'none',
                afterShow   : function() {
                    this.videoId = $('#playerContainer').data('video-id');
                    this.$playerInfo = $('#playerInfo');
                    this._initYoutube();
                }.bind(this)
            });
            // $('body').on('click', '#playerInfo', function(event) {
            //     var $target = $(event.target);
            //     if(!$target.hasClass('social-btn') && !$target.parents('.social-btn').length) {
            //         $(this).addClass('disabled');
            //     }
            // });

        },

        _initYoutube: function() {

           this.playerDone = false;

            if(!this.player) {
               this._loadYoutubeScripts.call(this);
            } else {
                this._createYouTubePlayer.call(this);
            }
        },
        _createYouTubePlayer: function() {
            this.player = new YT.Player('player', {
                videoId: this.videoId,
                playerVars: { 'autoplay': 1, 'controls': 1 },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        },
        _loadYoutubeScripts: function() {
            var tag = document.createElement('script'),
                firstScriptTag;

            tag.src = "https://www.youtube.com/iframe_api";

            firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


            onYouTubeIframeAPIReady = function() {

                this._createYouTubePlayer.call(this)
            }.bind(this);

            onPlayerReady = function(event) {
                if(!$('html').hasClass('mobile')) {
                    event.target.playVideo();
                }
            }.bind(this);


            onPlayerStateChange = function(event) {

                if (event.data == YT.PlayerState.ENDED && !this.playerDone) {
                   stopVideo();
                   this.playerDone = true;
                }
            }.bind(this);

            stopVideo = function() {
                this.$playerInfo.removeClass('disabled');
                this.player.stopVideo();
            }.bind(this)
        }
    };
}(jQuery));
