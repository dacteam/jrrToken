<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link href="style.css" rel="stylesheet">
		<script src="js/jrrTokenShow.js"></script>
	</head>
	<body>
	<header>
		<div class="sized">
			<h1>J.R.R. Token</h1>
			<span>Jquery tokenizer plugin</span>
		</div>
	</header>
	<article class="sized cf">
		<section class="unit size2of3">
			<div class="p-tb margin">
				<h1>J.R.R Token Demo</h1>
				<div class="console padding">
					<form data-jrrForm="" method="" action="">
					<div data-jrrToken="">
						<input data-jrrInput="" id="theInput" name="theInput" placeholder="type a sentence...">
					</div>

					<button data-jrrSubmit="" >Submit</button>
					</form>
					<button data-jrrClearBtn="">Clear</button>
					<p class="action"> Submit to see output data</p>
				</div>

			</div>
		</section>
		<aside class="unit size1of3">
			<div class="margin p-tb">
				<h1>What it is</h1>

				<p>jrrToken is a Jquery tokenizer plugin. Simple to use, jrrToken allows you to turn boring inputs into <b>seximified pleasure boxes.</b></p>
				<h2 class="p-rl">Features</h2>
				<ul>
					<li>Backspace/Delete : Removes last entry</li>
					<li>Accepts Copy and Paste scenario</li>
					<li>Outputs data as string</li>
					<li>Valid Html Markup</li>
				</ul>
			</div>
			<div>
				<a href="#"><h3>Download jrrToken</h3></a>
			</div>
		</aside>

		<div id="outputDiv" class="section-full m-rl hidden">
			<div class="padding">
				<h3>Output:</h3>
				<p></p>
			</div>
		
		</div>

		<section class="section-full">

			<div class="margin p-tb">
				<h1>How it works</h1>

				<div class="codeblock">
					<p id="step1"><b>You need to have some basic html setup</b>. You can either create your own or copy this block.</p>


<pre class="m-rl"> 
	<code>
	&lt;form data-jrrForm="" method="post" action="">
		&lt;div data-jrrToken="">
			&lt;input data-jrrInput="" name="theInput" placeholder="type a sentence...">
		&lt;/div>
		&lt;button data-jrrSubmit="" type="submit">Submit&lt;/button>
	&lt;/form>
	&lt;button data-jrrClearBtn="">Clear&lt;/button> &lt;!--  this is optional -->
	</code>
</pre>

				

					<p>It doesn't matter whether you use your classes or id's provided your elements have the same data attributes. I repeat, provided they have the same data attibutes. Actually that isn't true, you can manipulate the hooks that are used if you have a decent command of jquery. Read on.</p>
				</div>

			<div class="codeblock">
				<p id="step2"><b>You need to style it or use mine</b>. Feel free to copy my styles and work with them, or create your own game changing look. The css styles can be found in <a href="#">this</a> zipped file along with the js code. I've used attribute selectors for style hooks.  </p>
			</div>
			<div class="codeblock">
				<p id="step3"><b>Link the js file after linking the Jquery library</b>. Whether you prefer to do it in the head of your document or before the closing body tag, I don't give a squirt, neither does the script.</p>
			</div>
			<div class="codeblock">
				<p id="step4"><b>Initialize the plugin using the jrrToken.init() method</b>. Make sure its initialized after you've linked the script.</p>

<pre class="m-rl"> 
	<code>
	&lt;script>
		jrrToken.init();
	&lt;/script>
	</code>
</pre>
					<p> Alternatively you can pass in your own objects to get it going. There are 4 necessary objects that are at play in this plugin. The 5th is the clear button which is optional. You can also leave any of these out provided you have the same attribute selectors above.  But make sure you pass a Jquery object through. I'm not in the business of creating objects....yet.</p>

<pre class="m-rl"> 
	<code>
	&lt;script>
		jrrToken.init( {
			tokenContainer : $('selector'),
			submitBtn : $('selector'),
			inputID : $('selector'),
			formID : $('selector'),
			clearBtn : $('selector')
		});
	&lt;/script>
	</code>
</pre>

			</div>

			<div class="codeblock">
				<p id="step5"><b>Capture the data.</b> As of this moment, the only exported object is a string. A hidden textarea is appended before the closing tag of the form with an ID of '<b>finalData</b>'. You may optionally supply your own ID for this textarea through the config object when instantiated the object with the .init() method.</p>
			</div>
		</section>
	</div>
</article>
<footer class="sized">
	<small>Steven Dufresne, 2012</small>
</footer>
<script>jrrToken.init();</script>
	</body>
</html>


	