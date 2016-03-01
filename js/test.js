(function ($) {
	jQuery('.pw-gallery').each(function() {
		var instance = this;

		jQuery('input[type=button]', instance).click(function() {
			var gallerysc = '[gallery ids="' + jQuery('input[type=hidden]', instance).val() + '"]';
			wp.media.gallery.edit(gallerysc).on('update', function(g) {
				var id_array = [];
				jQuery.each(g.models, function(id, img) { id_array.push(img.id); });
				jQuery('input[type=hidden]', instance).val(id_array.join(","));
			});
		});
	});
}(jQuery));
