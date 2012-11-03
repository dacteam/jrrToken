<?php
	var_dump($_POST);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<style>

		body {
			width: 40%;
			margin: 0 auto;
		   font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
		   font-weight: 300;
			background: url('nami.png') ;
			color: #fff;

		}

		h1 {
			font-family: 'Questrial', sans-serif;
			font-size: 80px;
			color: #999;
			text-shadow: 0 1px 3px #000;

		}
		#token {
			position: relative;
			width: 450px;
			min-height: 200px;
			margin: 0;
			padding: 2px 4px 4px;
			background: #fff;
			border-radius: 4px;
			cursor: text;
			background: url('nami-in.png') ;
			box-shadow: inset 0 1px 3px #000,
						inset 0 -1px 0 #333;
		
		}

		.inputChange {

			background: rgba(0,0,0, 0.5) !important;

		}

		#friend {
			background: transparent;
			color: #fff;
			font-size: 18px;
		}
		#token > div {
			display: inline-block;
			position: relative;
			padding: 8px 30px 8px 9px;
			margin: 1px 4px 1px 1px;
			font-size: 16px;
			background: #a90329;
			background: -moz-linear-gradient(top, #a90329 0%, #8f0222 44%, #6d0019 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a90329), color-stop(44%,#8f0222), color-stop(100%,#6d0019));
			background: -webkit-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%);
			background: -o-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%);
			background: -ms-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%);
			background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%);
			color: #fff;
			text-shadow: 1px 1px 1px #4F0112;
			border-radius: 4px;
			border: 1px solid #660016;
			box-shadow: inset 0 1px #FF053B;

			cursor: pointer;



		}
		span {
			position: absolute;
			right: 1px;
			top: 2px;

			padding: 1px 6px 3px;
			font-size: 10px;

			cursor: pointer;
			background: #660016;
			color: #fff;
			border-radius: 10px;
			box-shadow: inset 0 1px 10px rgba(0,0,0,0.4),
						-1px 0px 15px rgb(38,0,8),
						-1px 1px #B20326;
			
		}

		span:hover {
			background: #FF053B;

			-webkit-animation: glow 1400ms infinite;

		}
		input:focus {
			outline: none;
		}

		input {	
			margin: 0;
			margin-left: 2px;
			border: none;
			height: 46px;
			font-size: 16px;

		}

		button {
			display: inline-block;
			padding: 15px 20px;
			font-size: 18px;
			border: 1px solid #111;
			  background-color: #f7f7f7;
			  background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f7f7), to(#e7e7e7));
			  background-image: -webkit-linear-gradient(top, #f7f7f7, #e7e7e7); 
			  background-image: -moz-linear-gradient(top, #f7f7f7, #e7e7e7); 
			  background-image: -ms-linear-gradient(top, #f7f7f7, #e7e7e7); 
			  background-image: -o-linear-gradient(top, #f7f7f7, #e7e7e7); 
			color: #555;


		}
		.console {
			position: relative;
			width: 458px;

		}

		button {
			margin: 10px 0;
		}

		[type=submit] {
			border-radius: 6px 0 0 6px;
		}
		#clear {
			position: absolute;
			left:96px;
			bottom:0;
			border-radius: 0 6px 6px 0;
		}

		@-webkit-keyframes glow {
		 	0%   { background: #6d0019; }
		 	50%   { background: #A50326; }
		 	100% { background: #6d0019; }
		}
		</style>
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

	getItems : function (  ) {
		return $(jrrToken.tokenContainer).children('div');
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
	formID : $('#tokenTime')
});

</script>
	</body>
</html>

