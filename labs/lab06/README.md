# Lab 6

[Link to Personal Website](https://tieubrpi.eastus.cloudapp.azure.com/iit/index.html)
[Link to labs landing page](https://tieubrpi.eastus.cloudapp.azure.com/iit/labs/index.html)
[Github](https://github.com/btieu30/itws1100-tieub)

### Problem 5 explanation:
Initially, the newly added items to the list didn't respond to the
click events because the event handler was only attached to elements that existed when the page was loaded. It was because jQuery's .click() method doesn't automatically apply to the newly created elements. I fixed this by using `.on("click", "li")`, which is attached to the `<ul>` instead of <li>`, to allow all the list elements to respond.

### Reflection:
I thought this lab was interesting, as I haven't had much previous experience with jQuery. I had to do a lot of external research on jQuery to get it done and struggled specifically with the preventDefault() function, which prevent's the default behavior from occurring for an element. Even though this behavior isn't noticeable on the page since it is short, it can change animations or user experiences on longer pages.