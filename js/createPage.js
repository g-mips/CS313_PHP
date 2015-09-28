function start(page) {
	var numOfLinks = 9
	
	// DIV Tag
	var navBar = document.createElement("div");
	navBar.id = "NavBar";
	document.body.appendChild(navBar);
	
	// UL Tag
	var list = document.createElement("ul");
	navBar.appendChild(list);
	
	// LI Tags
	var listItems = [];
	
	// A Tags
	var links = [];
	var linkText = [null, "HOME", "VIDEOS", "FORUM", "CONTACT", null, null, null, null];
	var linkHrefs = ["php_index.html", "php_index.html", "videos.html", "forum.html", "contact.html",
					 "https://youtube.com/user/kacologo", "https://facebook.com/kacologo",
					 "https://twitter.com/kacologogames", "https://google.com/+kacologo92"];
	
	//IMG Tags
	var images = [];
	var imageLinks = ["images/controller-alone.png", null, null, null, null, "images/Youtube.png",
					  "images/Facebook.png", "images/Twitter.png", "images/Google-plus.png"];
	var imageTargets = [null, null, null, null, null, "_blank", "_blank", "_blank", "_blank"];
	
	// Create and add each tag in the appropriate order.
	for (i = 0; i < numOfLinks; i += 1) {
		listItems[i] = document.createElement("li");
		list.appendChild(listItems[i]);
		
		links[i] = document.createElement("a");
		links[i].href = linkHrefs[i];
		
		if (linkText[i] !== null) {
			links[i].innerHTML = linkText[i];
		}
		
		listItems[i].appendChild(links[i]);
		
		if (imageLinks[i] !== null) {
			images[i] = document.createElement("img");
			images[i].src = imageLinks[i];
			
			if (imageTargets !== null) {
				images[i].target = imageTargets[i];
			}
			
			if (i == 0) {
				images[i].id = "HeaderImage";
			}
			
			links[i].appendChild(images[i]);
		} else {
			images[i] = null;
		}
	}
	
	// Which page are we on.
	if (page == "HOME") {
		listItems[1].id = "CurrentPage";
	} else if (page == "VIDEOS") {
		listItems[2].id = "CurrentPage";
	} else if (page == "FORUM") {
		listItems[3].id = "CurrentPage";
	} else if (page == "CONTACT") {
		listItems[4].id = "CurrentPage";
	}
}

/* DESIRED RESULT:
<div id="NavBar">			
	<ul>
		<li>
			<a href="php_index.html">
				<img id="HeaderImage" src="images/controller-alone.png" />
			</a>
		</li>
		<li id="CurrentPage"><a href="php_index.html">HOME</a></li>
		<li><a href="videos.html">VIDEOS</a></li>
		<li><a href="forum.html">FORUM</a></li>
		<li><a href="contact.html">CONTACT</a></li>
		<li>
			<a href="https://youtube.com/user/kacologo" target="_blank">
				<img src="images/Youtube.png" />
			</a>
		</li>
		<li>
			<a href="https://facebook.com/kacologo"target="_blank"> 
				<img src="images/Facebook.png" />
			</a>
		</li>
		<li>
			<a href="https://twitter.com/kacologogames" target="_blank">
				<img src="images/Twitter.png" />
			</a>
		</li>
		<li>
			<a href="https://google.com/+kacologo92" target="_blank">
				<img src="images/Google-plus.png" />
			</a>
		</li>
	</ul>
</div>
*/