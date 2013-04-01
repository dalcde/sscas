function AjaxLoader () {
    this._init();
}

AjaxLoader.prototype = {
    _init: function() {
	this.container = $("#content-area");

	// Delete any other loaders
//	this.remove(); 

	// Create the overlay 
	var overlay = $("<div></div>").css({
	    "background-color": "#000",
            "opacity": 0.3,
	    "width": this.container.width(),
	    "height": this.container.height(),
	    "position": "absolute",
	    "top": "0px",
	    "left": "0px",
	    "z-index": 99999
	}).addClass("ajax_overlay");

	// add an overiding class name to set new loader style 
	overlay.addClass('ajax-loader');

	// insert overlay and loader into DOM 
	this.container.append(
	    overlay.append(
		$("<div></div>").addClass("ajax-loader")
	    ).fadeIn(800)
	);
    },

    remove: function() {
	var overlay = this.container.children(".ajax_overlay");
	if (overlay.length) {
	    overlay.fadeOut('ajax-loader', function() {
		overlay.remove();
	    });
	    
	}

    }
}