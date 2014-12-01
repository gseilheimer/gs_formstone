;(function ($, Formstone, undefined) {

	"use strict";

	/**
	 * @method private
	 * @name construct
	 * @description Builds instance.
	 * @param data [object] "Instance Data"
	 * @param callback [object] "Function to call"
	 */

	function construct(data, callback) {
		if (callback) {
			// Target child element, for event delegation

			data.$target     = this.find(data.target);
			data.$check      = data.target ? data.$target : this;
			data.callback    = callback;
			data.styles      = getStyles(data.$check);
			data.timer       = null;

			var duration = data.$check.css( Formstone.transitionProperty + "-duration" );

			if (Formstone.support.transition && duration && parseFloat(duration)) {
				// If transitions supported and active

				this.on(Events.transitionEnd, data, onTranistionEnd);
			} else {
				// Otherwise, watch for changes in properties

				data.timer = Functions.startTimer(data.timer, 50, function() {
					checkStyles(data);
				}, true);
			}
		}
	}

	/**
	 * @method private
	 * @name destruct
	 * @description Tears down instance.
	 * @param data [object] "Instance data"
	 */

	function destruct(data) {
		this.off(Events.namespace);
	}

	/**
	 * @method private
	 * @name onTransitionEnd
	 * @description Handles transition end events.
	 * @param e [object] "Event data"
	 */

	function onTranistionEnd(e) {
		e.stopPropagation();
		e.preventDefault();

		var data           = e.data,
			oe             = e.originalEvent,
			checkProp      = (!data.property || (oe && oe.propertyName === data.property)),
			checkTarget    = (!data.target || (oe && $(oe.target).is(data.$target))),
			checkEl        = (checkTarget || (!data.target && oe && $(oe.target).is(data.$el)));

		// Check property and target

		if ( checkProp && checkTarget && checkEl ) {
			resolve(data);
		}
	}

	/**
	 * @method private
	 * @name resolve
	 * @description Resolves transition end events.
	 * @param e [object] "Event data"
	 */

	function resolve(data) {
		if (!data.always) {
			// Unbind events, clear timers, similiar to .one()

			Functions.clearTimer(data.timer, true);

			data.$el[Plugin.namespace]("destroy"); // clean up old data?
		}

		// fire callback

		data.callback.apply(data.$el);
	}

	/**
	 * @method private
	 * @name checkStyles
	 * @description Compares current CSS to previous styles.
	 * @param data [object] "Instance data"
	 */

	function checkStyles(data) {
		var styles = getStyles(data.$check);

		if (!isEqual(data.styles, styles)) {
			resolve(data);
		}

		data.styles = styles;
	}

	/**
	 * @method private
	 * @name getStyles
	 * @description Returns element's styles.
	 * @param el [DOM] "Element to check"
	 */

	function getStyles(el) {
		var computed,
			styles = {},
			prop,
			val;

		if (el instanceof $) {
			el = el[0];
		}

		if (Window.getComputedStyle) {
			// FireFox, Chrome, Safari

			computed = Window.getComputedStyle(el, null);

			for (var i = 0, count = computed.length; i < count; i++) {
				prop = computed[i];
				val = computed.getPropertyValue(prop);

				styles[prop] = val;
			}
		} else if (el.currentStyle) {
			// IE, Opera

			computed = el.currentStyle;

			for (prop in computed) {
				if (computed.hasOwnProperty(computed)) {
					styles[prop] = computed[prop];
				}
			}
		}

		return styles;
	}

	/**
	 * @method private
	 * @name isEqual
	 * @description Compares two obejcts.
	 * @param a [object] "Object to compare"
	 * @param b [object] "Object to compare"
	 */

	function isEqual(a, b) {
		if ($.type(a) !== $.type(b)) {
			return false;
		}

		for (var i in a) {
			if ( !(a.hasOwnProperty(i) && b.hasOwnProperty(i) && a[i] === b[i]) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @plugin
	 * @name Transition
	 * @description A jQuery plugin for CSS transition events.
	 * @type widget
	 */

	var Plugin = Formstone.Plugin("transition", {
			widget: true,

			/**
			 * @options
			 * @param always [boolean] <False> "Flag to always react to transition end (.on vs .one)"
			 * @param property [string] <null> "Property to react to"
			 * @param target [string] <null> "Target child selector"
			 */

			defaults: {
				always      : false,
				property    : null,
				target      : null
			},

			methods : {
				_construct    : construct,
				_destruct     : destruct,
				resolve       : resolve
			}
		}),

		// Localize References

		Events       = Plugin.events,
		Functions    = Plugin.functions,

		Window       = Formstone.window;

})(jQuery, Formstone);

/*
 * @use

### Basic

Transition provides a predicatable interface for moving to CSS based animations:

```
$(".target").transition(function() {
	...
}).addClass("visible");
```

### Resolve

Tranistions can manually resolved, which will immediately fire the associated callback:

```
if (shouldResolve) {
	$(".target").transition("resolve");
}
```

 */