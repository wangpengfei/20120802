var MsgNumUpdater = Class.create();

MsgNumUpdater.attributes = ["inbox", "sent", "draft", "trash", "spam"];

MsgNumUpdater.prototype = {
	initialize: function() {
	},

	ajaxUpdate: function(ajaxResponse) {
		this.setMsgNum( ajaxResponse.childNodes[0] );
	},

	setMsgNum: function(aMsgNum) {
		for ( var i = 0 ; i < MsgNumUpdater.attributes.length ; i++ ) {
			var attr = MsgNumUpdater.attributes[i];
			if (aMsgNum.getAttribute(attr) == 0)
				this.substitute( "span", attr, "" );
			else
				this.substitute( "span", attr, this.emphasizedHTML( aMsgNum.getAttribute(attr) ) );
		}
	},

	reset: function() {
		for ( var i = 0 ; i < MsgNumUpdater.attributes.length ; i++ ) {
			var attr = MsgNumUpdater.attributes[i];
			this.substitute( "span", attr, "" );
		}
	},

	substitute: function( tagName, tagClass, value ) {
		var elements = document.getElementsByTagAndClassName(tagName, tagClass);
		for ( var i = 0 ; i < elements.length ; i++ )
			elements[i].innerHTML = value;
	},

	emphasizedHTML: function(aValue) {
		return "<b>(" + aValue + ")</b>";
	}
};