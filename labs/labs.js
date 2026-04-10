$(document).ready(function() {
    //loading JSON and building the menu
    $.getJSON("labs.json", function(data) {
        var items = data.menuItems;
        //clear the grid before adding new items
        $("#labGrid").empty();
        
        //for each item in the JSON, create a new card
        $.each(items, function(index, lab) {
            //creating the card elements
            var titleBlock = $("<h2>").text(lab.title + ": " + lab.subtitle);
            var description = $("<p>").text(lab.description);
            var link = $("<a>").attr("href", lab.link).addClass("labLink").text("View Lab");
            var card = $("<div>").addClass("labCard").attr("id", lab.id).append(titleBlock, description, link);
            $("#labGrid").append(card);
        });

        //formatting the date for the tooltips in jQueryUI
        $.each(items, function(index, lab) {
            var date = new Date(lab.date + "T00:00:00").toLocaleDateString("en-US", { year: "numeric", month: "long", day: "numeric" });
            $("#" + lab.id).attr("title", "Last updated: " + date);
        });

        //adding a tooltip to each card with the dates
        $(".labCard").tooltip({
            position: {my: "left top+10", at: "left bottom"}
        });

        //fade in the cards for a nicer effect
        $(".labCard").hide().each(function(index) {
            $(this).delay(index * 100).fadeIn(350);
        });

        //extra credit, building the RSS feed
        buildRSSFeed(data);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        $("#labGrid").html("<p class='errorMsg'>Failed to load labs data. (" + textStatus + ")</p>");
        console.error("Error loading labs.", errorThrown);
    });
});

//function to build the XML feed
function buildRSSFeed(data) {
 
  var items = data.menuItems;
  var baseUrl = data.siteLink;
 
  //start building the string for the RSS feed
  var xml = '<?xml version="1.0" encoding="UTF-8" ?>\n';
  xml += '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">\n';
  xml += '<channel>\n';
  xml += '  <title>' + data.rssTitle + '</title>\n';
  xml += '  <description>' + data.siteDescription + '</description>\n';
  xml += '  <link>' + baseUrl + '</link>\n';
  xml += '  <lastBuildDate>' + new Date().toUTCString() + '</lastBuildDate>\n';
  xml += '  <language>en-us</language>\n\n';
 
  //loop through each lab item and add it to the RSS feed
  $.each(items, function (i, lab) {
    var itemUrl = baseUrl + '/labs/' + lab.link;
    var pubDate = new Date(lab.date + "T00:00:00").toUTCString();
    xml += '  <item>\n';
    xml += '    <title>' + lab.title + ' (' + lab.subtitle + ')' + '</title>\n';
    xml += '    <description>' + lab.description + '</description>\n';
    xml += '    <link>' + itemUrl + '</link>\n';
    xml += '    <guid>' + itemUrl + '</guid>\n';
    xml += '    <pubDate>' + pubDate + '</pubDate>\n';
    xml += '  </item>\n\n';
  });
 
  xml += '</channel>\n';
  xml += '</rss>';
 
  //update the page to display the feed content for copying
  $("#rssDisplay code").text(xml);
}