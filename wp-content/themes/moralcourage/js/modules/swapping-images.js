var MORAL = MORAL || {};
MORAL.SwappingImages = (function($) {
    function Swap($element) {
        this.count  = 0;

        this.$items = $element.find('.item');

        this.maxCount = this.$items.length;

        this.swap = function() {

            var $currentItem = this.$items.eq(this.count),
                $textTarget,
                text;
            this.$items.removeClass('active');
            $currentItem.addClass('active');
            $textTarget = $($currentItem.data('text-target'));
            if ($textTarget.length) {
                text = $currentItem.find('.item-text').html();
                $textTarget.html(text);
            }

            this.increaseCount();
        }
        this.increaseCount = function() {
            this.count++;
            if (this.count >= this.maxCount) {
                this.count = 0;
            }
        }
        this.swap();

        if (this.maxCount > 1) {
            setInterval(this.swap.bind(this), 5000);
        }

    }
    return {
        $swappingImages: [],
        init: function() {

            this.initEvents();
            this.initSwaps();
        },
        initSwaps: function() {
            this.$swappingImages = $('.swapping-images');
            this.$swappingImages.each(function() {
                var swap = new Swap($(this));
            })
        },
        initEvents: function() {
            if (this.$swappingImages.length) {
                this.$swappingImages.find('.item').first().addClass('active');
            }
        }
    }
}(jQuery));
