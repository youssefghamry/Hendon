(function ($) {
	"use strict";
	
	qodefCore.shortcodes.hendon_core_property_list = {};
	
	$(document).ready(function () {
		qodefProperyListAside.init();
	});
	
	var qodefProperyListAside = {
		init: function () {
			this.holder = $('.qodef-property-list.qodef-item-layout--info-aside');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefProperyListAside.initList( $thisHolder );
				});
			}
		},
		initList: function ($holder) {
			var $item = $holder.find('article.qodef-e');
			
			$item.first().addClass("active");
			
			$item.on('mouseenter', function () {
				$item.removeClass("active");
				$(this).addClass("active");
			});
		}
	};
	
	qodefCore.shortcodes.hendon_core_property_list.qodefProperyListAside  = qodefProperyListAside;
	
})(jQuery);