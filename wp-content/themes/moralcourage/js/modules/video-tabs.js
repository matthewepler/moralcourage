var MORAL = MORAL || {};
MORAL.VideoTabs = (function($) {
    return {
        $videoThumbs: null,
        $videoMain: null,
        $videoTabs: null,
        $shadowDiv: null,
        init: function() {
            this.initElements();
            this.initEvents();
        },
        initElements: function($element) {
            this.$videoTabs = $element || $('.video-tabs');
            this.$videoThumbs = this.$videoTabs.find('.video-thumbs');

            this.$shadowDiv = this.$videoThumbs.parents('.shadow-div');

            this.$videoThumbs.find('.item').first().addClass('active');
            this.$videoMain = this.$videoTabs.find('.video-main');

            this.$videoMain.find('.item').first().addClass('active');
            this.initShadow();
        },
        initShadow: function() {
            var self = this,
                scrollHeight,
                height,
                scrolHandler;
            if (!this.$shadowDiv || !this.$shadowDiv.length) {
                return;
            }

            this.$videoThumbs.off('scroll');

            scrollHeight = this.$videoThumbs[0].scrollHeight;
            height = this.$videoThumbs.height();

            scrollHandler = function() {
                var $this,
                    scrollTop;

                $this = $(this) || [];

                if ($this.length) {
                    scrollTop = $this.scrollTop();
                } else {
                    scrollTop = 0;
                }

                self.$shadowDiv.removeClass('scroll-middle scroll-top scroll-bottom');

                if (scrollTop === 0) {
                    self.$shadowDiv.addClass('scroll-top');
                    return;
                }
                
                if (scrollTop < scrollHeight - height - 1) {
                    self.$shadowDiv.addClass('scroll-middle');
                    return;
                }
                self.$shadowDiv.addClass('scroll-bottom');
            };

            scrollHandler.call(this.$videoThumbs);

            this.$videoThumbs.on('scroll', scrollHandler);
        },
        initEvents: function() {
            var self = this;

            $('body')
                .on('click', '.load-more', function(event) {
                    event.preventDefault();
                    $(this).hide();
                    self.$shadowDiv.addClass('loaded-more');
                })
                .on('click', '.video-thumbs .item', function(event) {
                    var $this = $(this),
                        target = $this.data('target'),
                        $target = $('#' + target);

                    event.preventDefault();
                    $this
                        .siblings('.item')
                            .removeClass('active')
                            .end()
                        .addClass('active');

                    $target
                        .siblings('.item')
                            .removeClass('active')
                            .end()
                        .addClass('active');
                });
        }
    };
}(jQuery));
