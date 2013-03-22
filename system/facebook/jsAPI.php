<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '225463167580375', // App ID from the App Dashboard
      //channelUrl : '//mdeil-voip.dyndns.org/fb-login/sdk/channel.php', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });

    // Additional initialization code such as adding Event Listeners goes here
	
	FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
		// connected
		fbInfo();
		testAPI();
	  } else if (response.status === 'not_authorized') {
		// not_authorized
		FBlogin();
	  } else {
		// not_logged_in
		FBlogin();
	  }
	 });





  };
  

  // Load the SDK's source Asynchronously
  // Note that the debug version is being actively developed and might 
  // contain some type checks that are overly strict. 
  // Please report such bugs using the bugs tool.
  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/de_DE/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
  
 
function FBlogin() {
    FB.login(function(response) {
        if (response.authResponse) {
            // connected
        } else {
            // cancelled
			console.log("Login failed!");
        }
    }, {scope: 'email'});
}

function FBlogout(){
	console.log("Sending logout request...");
	FB.logout(function(response) {
	  console.log("User is now logged out...");
	});
}

function FBconnect(){
	FB.api('/me', function(response) {
		console.log(response.id);
		jQuery.ajax({
			type: "POST",
			url: "admin/yourAccount_fb_connect.php",
			data: {
				id: response.id
			},
			success: function(response2)
			{
				if(response2){
					console.log(response2);
					console.log("User now logged in...");
				} else {
					//$(this).html("<p class='error'>Invalid username and/or password.</p>");
					console.log("Fehler beim Ausführen der AJAX-Anfrage!");
					console.log(response2);
				}
			}
		});
	});
}

function FBdisconnect(){
	FB.api('/me', function(response) {
		jQuery.ajax({
			type: "POST",
			url: "admin/yourAccount_fb_disconnect.php",
			data: {
				id: response.id
			},
			success: function(response)
			{
				if(response){
					console.log(response);
				} else {
					//$(this).html("<p class='error'>Invalid username and/or password.</p>");
					console.log("Fehler beim Ausführen der AJAX-Anfrage!");
				}
			}
		});
	});
}

function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('You are logged in as ' + response.name + '.');
    });
}

function test(){
	FB.ui(
	{
	method: 'feed',
	//display: "iframe",
	name: 'The Facebook SDK for Javascript',
	caption: 'Bringing Facebook to the desktop and mobile web',
	description: (
	'A small JavaScript library that allows you to harness ' +
	'the power of Facebook, bringing the user\'s identity, ' +
	'social graph and distribution power to your site.'
	),
	link: 'https://developers.facebook.com/docs/reference/javascript/',
	picture: 'http://www.fbrell.com/public/f8.jpg'
	},
	function(response) {
	if (response && response.post_id) {
	console.log('Post was published.');
	} else {
	console.log('Post was not published.');
	}
	}
	);
}

function fbInfo(){
	FB.api('/me', function(response) {
		console.log(response.id);
		$(".facebook-id").html(response.id);
		$(".facebook-name").html(response.name);
		$(".facebook-email").html(response.email);
	});
}
</script>