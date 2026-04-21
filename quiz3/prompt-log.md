# Brianna Tieu - Quiz 3 Guestbook

## Prompt 1
### Exact prompt:
I need to build a guestbook page for a class. It needs to store a visitor's name, their message, and the time they posted. Can you write a MySQL create table statement for this? Explain each column and data type choice.

### What it returned:
A CREATE table with the columns: id, visitor_name, message, and posted_at with a explanation of each column choice

### What I kept, changed or threw away:
I kept the overall structure and column choices. I made the database name `quiz` and wrapped the CREATE command with `CREATE DATABASE IF NOT EXISTS quiz;` and `USE quiz;` at the top, which the AI did not include, which is needed so the database could be setup in a single run of the script.

## Prompt 2
### Exact prompt:
Here is how I connect to MySQL in my existing Lab 9 code:
```
@ $db = new mysqli('localhost', 'root', '', 'iit');
  
  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true; 
  }
```
Write me a new index.php for a guestbook that follows the same pattern and same error handling style, same mysqli approach

### What it returned:
A full index.php with the mysqli connection using the same `@ $db = new mysqli(...)`. Also a connect_error checking, a prepared INSERT statement, and a loop with htmlspecialchars() on all output.

### What I kept, changed or threw away:
I kept the connection pattern and error handling because it matched my previous lab. I threw away the inline `<style>` block the AI included and moved all the CSS to an external `style.css` file.

## Prompt 3
### Exact prompt: 
I have moved the styling into a separate style.css file. Write the php to handle a POST form submission that inserts a name and message into the guestbook table. Use a prepared statement with bind_param. Check that neither field is empty before inserting

### What it returned:
Two files, `index.php` and a separate `style.css` with all the body, container, form, and entry styling. 

### What I kept, changed or threw away:
I kept the CSS as is since the styles were all readable. I added the `.deleteForm` and `.deleteForm button` rules myself when I added the delete functionality, since the AI had not added that feature yet.

## Prompt 4
### Exact prompt: 
Now write the php read path, which should SELECT all rows from guestbook ordered newest-first, loop through them and write each one as an HTML div with the name, message, and posted_at. Use htmlspecialchars() on every output value.

### What it returned:
A php block using `$db->query()` with the SELECT ordered by posted_at DESC, a while loop using fetch_assoc() and htmlspecialchars().

### What I kept, changed or threw away:
I kept the fetch_assoc() loop and htmlspecialchars(). I noticed that the AI did not include `id` in the SELECT, which I added.

## Prompt 5
### Exact prompt: 
Write the HTML form for the guestbook. It should have a text input for name, a textarea for message, and a submit button. The form action should post to index.php

### What it returned:
A clean HTML form with label/input pairs for visitor_name and message, and a submit button pointing to `index.php`.

### What I kept, changed or threw away:
I kept the structure as is, and added the `<p id="charCount">0 / 500 characters</p>` element below the textarea because the AI generated the form without a hook for the character counter.

## Prompt 6
### Exact prompt: 
Write a small JavaScript function that counts characters in the message textarea as the user types and displays character count / 500 characters below. If they go over 500, turn the counter text red.

### What it returned:
A JS function using `addEventListener` that updates the `charCount` paragraph element and makes the color red at 500 characters.

### What I kept, changed or threw away:
I kept the counter logic, but the AI did not connect the counter to form submission. It would show in red, but still let the user submit a message over 500 characters. I added the form submit listener myself in the js. The AI treated the counter simply as a UI feature, but I intended it to prevent submission.

## Prompt 7
### Exact prompt:
When the page reloads after a successful submission, I want the newest guestbook entry to fade in instead of just appearing. Here is how I did fade-in in a previous lab, Lab 6:
```
$("#hideText").click(function (e) {
      e.preventDefault();
      $("#showHideBlock p").hide(2000);
   });

   $("#showText").click(function (e) {
      e.preventDefault();
      $("#showHideBlock p").show(3300);
   }); 
```
Apply the same idea to the first .entry div on the page after a successful POST

### What it returned:
A jQuery snippet using the `fadeIn` function inside a `$(document).ready()` block with a php generated 

### What I kept, changed or threw away:
I kept the `hide` and `fadeIn`. I changed how the success flag was passed from php to JS and the AI also used an inline `<script>` tag with a php echo inside the tage to set a JS variable. I replaced it with a `data-submitted` attribute on the `<body>` tag and read it into `script.js`.

## Prompt 8
### Exact prompt:
How can I add a delete button next to each guestbook entry that removes it from the database using PHP and a prepared statement?

### What it returned:
A delete handler at the top of the `index.php` checking for a `delete_id` in the POST request and a prepared delete statement. 

### What I kept, changed or threw away:
I kept the prepared statement. But, the AI placed the delete handler inside the same `if` block as the POST submission, which caused a bug where if an entry was deleted, the status message was wrong. I fixed the POST block myself. 