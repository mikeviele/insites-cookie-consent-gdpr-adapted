<script>
    //Geo locate users for conditional consent popup
    jQuery.get("https://freegeoip.net/json/", function (response) {
	    var country = response.country_code;
	    var euCountries = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'HR', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'GB'];
	    var inEU = euCountries.indexOf(country) !== -1;
        if(inEU){
    		// Show GDPR compliant opt-in, opt-out cookie consent for all countries within the EU.

    		window.addEventListener("load", function(){
    		/*
    		 * deleteCookies
    		 * delete all cookies except those listed in the array essential
    		 */
			 	window.cookieconsent.Popup.prototype.deleteCookies = function() {
	    			//List of essential cookies - set as an empty array to delete everything - i.e. var essential = [];
	    			var essential = ["cookieconsent_status", ""];

	    			//create array of cookies set
	    			var cookies = document.cookie.split(";");

	    			//loop through the cookies
	    			for (var i = 0; i < cookies.length; i++) {
	    				var cookie = cookies[i];

	    				//Get the cookie name
	    				var eqPos = cookie.indexOf("=");
	    				var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;

	    				//Delete all cookies except those listed in essential
	    				if (essential === undefined || essential.length == 0 || essential.indexOf(name) == -1){
	    					document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
	    				}
    				}
    			};

				window.cookieconsent.initialise({
	    		 	"palette": {
	    		    	"popup": {
							"background": "#efeeee",
							"text": "#333333"
						},
						"button": {
							"background": "#ef4136",
							"text": "#ffffff"
	    		    	}
	    		  	},
				  	"type": "opt-out",
				  	"content": {
	    				"message": 'This site uses cookies to provide you with the best possilbe browsing experience.',
	    				"link": 'Privacy Policy',
						"dismiss": "Allow",
						"allow": "Allow",
						"deny": "Deny",
						"href": "https://YOUR-PRIVACY-POLICY-URL",
	    		  	},

				  	revokable:true,
				  	animateRevokable:false,
	    			law: {
	    				regionalLaw: true,
	    			},
	    			location: true,
	    			onInitialise: function (status) {
	    				var type = this.options.type;
						var didConsent = this.hasConsented();

						if (type == 'opt-out' && didConsent) {
	    			    	//ADD YOUR TRACKING SCRIPTS OR GOOGLE TAG MANAGER CODE HERE!!!

	    			  	} else {
	    					this.deleteCookies();
							// window.location.reload();
	    			  	}
	    			},

	    			onStatusChange: function(status, chosenBefore) {
	    			  	var type = this.options.type;
					  	var didConsent = this.hasConsented();

					  	if (type == 'opt-out' && didConsent) {
					  		//ADD YOUR TRACKING SCRIPTS OR GOOGLE TAG MANAGER CODE HERE!!!

	    			  	} else {
	    					this.deleteCookies();
							// window.location.reload();
	    			  	}
	    			},
	    		})
    		});

    	} else {

    		// Show informational cookie consent if user is from all other countries not part of the EU.

        	window.addEventListener("load", function(){
	    		window.cookieconsent.initialise({
	    		 	"palette": {
	    		    	"popup": {
							"background": "#efeeee",
							"text": "#333333"
	    		    	},
						"button": {
							"background": "#ef4136",
							"text": "#ffffff"
	    		    	}
	    		  	},
				  	"content": {
	    				"message": 'This site uses cookies to provide you with the best possible browsing experience.',
	    				"link": 'Privacy Policy',
						"dismiss": "Cool!",
						"allow": "Cool!",
						"deny": "Deny",
						"href": "https://YOUR-PRIVACY-POLICY-URL",
	    		 	},
	    		})
    		});

    		//ADD YOUR TRACKING SCRIPTS OR GOOGLE TAG MANAGER CODE HERE!!!
    	}
    }, "jsonp");
</script>