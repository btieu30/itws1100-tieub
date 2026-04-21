# Brianna Tieu - Quiz 3 Guestbook

## Vulnerability 1 - SQL Injection
### The Code
I took the INSERT prepared statement from `index.php` and rewrote it as string concatenation:

```
$name    = $_POST['visitor_name'];
$message = $_POST['message'];

$sql = "INSERT INTO guestbook (visitor_name, message) VALUES ('" . $name . "', '" . $message . "')";
$db->query($sql);
```

### The Input
In the Your Name field:

```
', ''); DROP TABLE guestbook; --
```

### What Happens
The final SQL is `INSERT INTO guestbook (visitor_name, message) VALUES ('', ''); DROP TABLE guestbook; --', '')`
Here, MySQL reads this as two statements, the first INSERT running normally with empty values and the second, `DROP TABLE guestbook` runs and deletes the entire table of data. The `--` comment out the rest of the query to prevent any error.

### Solution
```
$sql  = "INSERT INTO guestbook (visitor_name, message) VALUES (?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $name, $message);
$stmt->execute();
```
With the prepared statement, the SQL structure is sent to MySQL and compiled before user data is used. When the `bind_param()` runs, it sends the values as literal string data, meaning the single quotes, semicolons, and the `--` are not interepreted as valid syntax.


## Vulnerability 2 - XSS
### The Code
I removed the `htmlspecialchars()` calls from the read loop in `index.php`, which makes the code:
```
while ($row = $result->fetch_assoc()) {
    echo '<div class="entry">';
    echo '<h3>' . $row['visitor_name'] . '</h3>';
    echo '<p>' . $row['message'] . '</p>';
    echo '<div class="time">' . $row['posted_at'] . '</div>';
    echo '</div>';
}
```

### The Input
In the Your Name field:
```
<script>alert('hacked')</script>
```

### What Happens
Since the name value is in the HTML directly without any escaping, the browser gets a `<script>` tag embedded in the page's body and executes. Every user who goes to the guestbook page after this entry gets submiited and will see the alert in their browser. The script gets stored in the dataabase and will run for every user until the entry is deleted. 

### Solution
```
echo '<h3>' . htmlspecialchars($row['visitor_name']) . '</h3>';
echo '<p>' . htmlspecialchars($row['message']) . '</p>';
```
`htmlspecialchars()` converts any dangerious characters into their HTML equiivalents and then they are written to the page. The browser would render the attempted hacked script alert on the screen rather than executing it.