// Quiz 2
// Put your javascript here in a document.ready function


alert("This page is about to load");

$(document).ready(function () {

  const defaultTitle = "ITWS 1100 - Quiz 2";

  document.title = defaultTitle;

  $("#goButton").click(function () {
    if (document.title === defaultTitle) {
      document.title = "Brianna Tieu – Quiz 2";
    } else {
      document.title = defaultTitle;
    }
  });

  $("#lastName").hover(
    function () {
      $(this).addClass("makeItPurple");
    },
    function () {
      $(this).removeClass("makeItPurple");
    }
  );
});