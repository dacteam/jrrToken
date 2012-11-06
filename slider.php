<?php
	var_dump($_POST);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>JRR Token</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link href='style.css' rel='stylesheet'>
	</head>
	<body>
		<h1>J.R.R. Token</h1>
		<div class="console">
			<form id="tokenTime" method="post" action="slider.php">
			<div id="token">
				<input id="friend">
			</div>

			<button id="submit" type="submit">Submit</button>
			</form>
			<button id="clear">Clear</button>
		</div>
<script>

var jrrToken = {
	init : function ( config ){
		 jrrToken.tokenContainer = config.tokenContainer,
		jrrToken.submitBtn = config.submitBtn,
		jrrToken.inputID = config.inputID,
		jrrToken.formID = config.formID,
		jrrToken.clearBtn = config.clearBtn,
		jrrToken.$tokenContainer = $(jrrToken.tokenContainer);

			jrrToken.addEvents();

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
			(document.activeElement.id == 'friend' ) ? jrrToken.$tokenContainer.addClass('inputChange') : jrrToken.$tokenContainer.removeClass('inputChange');
		});

		jrrToken.submitBtn.on('click', function () {
			jrrToken.collectInputItems();
		});

		jrrToken.clearBtn.on('click', this.removeAll);
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
	},

	outputData : function ( array ) {
		 $('#ttText').val( array );
	}
}

jrrToken.init( {
	tokenContainer : '#token', // dont pass in an object
	submitBtn : $('#submit'),
	inputID : $('#friend'),
	clearBtn : $('#clear'),
	formID : $('#tokenTime')
});

</script>
	</body>
</html>

