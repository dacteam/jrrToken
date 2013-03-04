var jrrToken = {
	init : function ( config ){
		(config == undefined) ? config = {} : config = config;
		jrrToken.tokenContainer =  (( typeof config.tokenContainer  == 'object') ?  config.tokenContainer.selector : config.tokenContainer) || $('[data-jrrToken]').selector,
		jrrToken.submitBtn = config.submitBtn || $('[data-jrrSubmit]'),
		jrrToken.inputID = config.inputID || $('[data-jrrInput]'),
		jrrToken.formID = config.formID || $('[data-jrrForm]'),
		jrrToken.clearBtn = config.clearBtn || $('[data-jrrClearBtn]'),
		jrrToken.$tokenContainer = $(jrrToken.tokenContainer);

		jrrToken.addEvents(jrrToken.tokenContainer);
		

		jrrToken.formID.append('<textarea name="finaldata" type="hidden" id="ttText" style="display: none;"></textarea>');
	},

	addEvents : function () {

		$(jrrToken.tokenContainer).on('click' , function () {
			jrrToken.inputID.focus();
		});

		jrrToken.inputID.on('keydown', function (event) {	
			jrrToken.directData( $(this),event  );
		});

		jrrToken.inputID.on('paste', function (event) {	
			setTimeout( function () {
				jrrToken.displayItem ( jrrToken.inputID , jrrToken.inputID.val().split(' ') );
			}, 1);
			
		});

		$(document).on('click', function () {
			(document.activeElement.id == 'theInput' ) ? jrrToken.$tokenContainer.addClass('inputChange') : jrrToken.$tokenContainer.removeClass('inputChange');
		});

		jrrToken.submitBtn.on('click', function (e) {
			jrrToken.collectInputItems();

			// for presentation on the demo site
			e.preventDefault();
			jrrToken.removeAll();
			jrrToken.inputID.val('');

		});

		if(jrrToken.clearBtn){
			jrrToken.clearBtn.on('click', this.removeAll);
		}
	},

	directData : function ( obj , event ) {

		if ( event.keyCode === 32 ) {		
			//create a local variable and store values
			var token = obj.val().replace(/\,/g,"").split(' ');

			//output the token to ui
			jrrToken.displayItem ( obj , token );
			// stop the keyup event
			event.preventDefault(); 

		} else if ( event.keyCode === 8 || event.keyCode === 46 ) { 

			if ( event.currentTarget.value === "") {
				
				// go get it remove the last one
				jrrToken.getItems().last().remove(); 

				// update final array
				jrrToken.collectDOMItems(); 
			}
		}
	},  

	displayItem : function ( obj, token ) {
		var self = jrrToken,
		tokenArray = [];

		for( var i = 0; i < token.length; i+=1 ) {
			if ( token[i] != "" ) {
				tokenArray.push(token[i]);
				var currentItem = tokenArray[tokenArray.length - 1 ];

				//create and insert html
				var html = $('<div data-val='  + currentItem  +'>' + currentItem  + '<span>&#10007;</span></div>');
				obj.before( html );

				//clean the input
				obj.val('');

				//add remove event
				html.on('click', function () {  $(this).remove(); });
			}
		}
	},

	getItems : function () {
		return $(jrrToken.tokenContainer).children('div');
	},

	removeAll : function () {
		var items = jrrToken.getItems(),
			max = items.length;
		for(var i = max; i > 0; i--) {
			$(items[i - 1]).remove();
		}
	},

	collectInputItems : function () {
		var input = $(jrrToken.inputID).val();

		(input != "") ? jrrToken.collectDOMItems( input.split(' ') ) : jrrToken.collectDOMItems();
	},

	collectDOMItems : function ( array ) {
		var items = jrrToken.getItems(),
			finalArray = [],
			max = items.length;

		for ( var i = 0; i < max; i+=1 ) {
			finalArray.push( $(items[i]).data('val') );
		}

		if (array != undefined){
			for (var j = 0; j < array.length; j++ ){
				finalArray.push(array[j]);
			}
		}
		//output final array to hidden textarea
		jrrToken.outputData( finalArray );

				// for presentation on the demo site

		$('#outputDiv').find('p').text(finalArray);
		$('#outputDiv').removeClass('hidden');
	},

	outputData : function ( array ) {
		 $('#ttText').val( array );
	}
}
