var MORAL = MORAL || {};
MORAL.Teaching = (function() {
    return {
        $tabNavigation: [],
        init: function() {
            this.initEvents();
            this.initActiveTab();
            this.initHeights();
        },
        initHeights: function() {
            this.$tabNavigation = $('.tab-navigation');
            this._setHeights();
        },
        _setHeights: function() {
            var tabContentHeight,
                tabNavigationHeight,
                maxHeight,
                heightBuffer = 130;

            if (!this.$tabNavigation.length) {
                return;
            }
            
            tabContentHeight    = $('.active .tab-content').height();
            tabNavigationHeight = this.$tabNavigation.find('.tabs').height();
            maxHeight = tabContentHeight > tabNavigationHeight ? tabContentHeight : tabNavigationHeight;
            maxHeight += heightBuffer;

            this.$tabNavigation.height(maxHeight);
        },
        initActiveTab: function() {
            var hash = this._getHash();

            if (hash) {
                $('#tab-' + hash + ' .tab-header').trigger('click');
            }

        },
        activeTab: [],
        initEvents: function() {
            var self = this;
            $('body')
                .on('click', '.tabs .tab .tab-header', function(event) {
                    var slug;
                    event.preventDefault();
                    
                    self.activeTab = $(this).parents('.tab');
                    slug           = self.activeTab.data('slug');

                    self.activeTab
                        .siblings('.tab')
                            .removeClass('active')
                            .end()
                        .addClass('active');

                    self.activateTab(slug);
                    
                    if ($(window).width() <= 480) {
                        $('body, html').scrollTop($(this).offset().top - 110);
                    }
                    
                });

        },
        _getHash: function() {
            return window.location.hash.replace(/\#/, '');
        },
        _setHash: function(slug) {
            window.location.hash = slug;
        },
        activateTab: function(slug) {
            this._setHash(slug);

            if (!this.activeTab.length ) {
                return;
            }

            $('.tab-content').html('');
            $targetTabContent = this.activeTab.find('.tab-content');
            if (!$targetTabContent.length) {
                return;
            }
            $el = $(pageData[slug]);

            $targetTabContent.html($el);
            this._setHeights();
            MORAL.VideoTabs.initElements($targetTabContent.find('.video-tabs'));
        }
    }
})(jQuery);
