# Brianna Tieu - Quiz 3 Guestbook

**GitHub ID:** btieu30  
**Repository Name:** itws1100-tieub  
[Quiz on Azure](https://tieubrpi.eastus.cloudapp.azure.com/iit/quiz3)  
[Azure homepage](https://tieubrpi.eastus.cloudapp.azure.com/iit/)  
**Discord Handle:** bribobs  

### Section 3 Summary
I built a Guestbook or Option A, where visitors can leave their name and message and all entries are displayed in order of newest first. The feature has all requirements:
1) SQL table - `guestbook` table with id, visitor_name, message, and posted_at
2) php reads and writes - `index.php` handles INSERT for form submission, SELECT to display the entries, and DELETE to remove entries
3) Prepared statements - all three operations including INSERT, DELETE, and SELECT use a prepared statement pattern
4) Client-side interactivity - script.js uses a character counter for the message field that warns users when they've hit the character limit by turning red and prevents submission of the form. Also, implemented a fadeIn animation for new entries
5) Azure deployment - live at the Quiz on Azure link
6) File organization - all the files in the quiz3 folder with separation, like css and js directories


