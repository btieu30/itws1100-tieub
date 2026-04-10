# itws1100-tieub
Brianna Tieu, ITWS 1100

[Link to Personal Website](https://tieubrpi.eastus.cloudapp.azure.com/iit/index.html)

[Link to labs landing page](https://tieubrpi.eastus.cloudapp.azure.com/iit/labs/index.html)

[Github](https://github.com/btieu30/itws1100-tieub)

### Lab 8: JS, JSON & AJAX
This lab changes the lab landing page so lab cards are 
built directly from the JSON file using AJAX and jQuery.
It also includes the extra credit, which generates an RSS feed from the same JSON file.

### Summary
When `labs/index.html` loads, `labs.js` uses jQuery's `$.getJSON()` to get `labs.json` over AJAX. Then, it loops through all the entries in the JSON and creates a lab card for each entry, and puts them into the grid of labs. I included jQuery UI tooltips for a little flair, which shows the dates of the labs when they're hovered over. They also fade into the site. Whenever the lab page needs to be updated, all I need to do is add to the JSON file. 

### Extra Credit
I also built an `buildRSSFeed()` method, which also goes through the `labs.json` file and generates an RSS XML file. The output is displayed directly on the lab landing page for anyone to copy and paste. Adding any entry to the JSON updates BOTH the RSS and projects page. 