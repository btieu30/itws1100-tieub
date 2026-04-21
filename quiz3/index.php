<?php
$dbOk = false;
$statusMessage = "";

@ $db = new mysqli('localhost', 'root', '', 'quiz');

if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
    $dbOk = true;
}

$statusMessage = "";

/* Handle POST submission & deletion */
if ($dbOk && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
            $deleteId = (int) $_POST['delete_id'];

        $sql = "DELETE FROM guestbook WHERE id = ?";
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $deleteId);

            if ($stmt->execute()) {
                $statusMessage = '<div class="messages success">Entry deleted.</div>';
            } else {
                $statusMessage = '<div class="messages">Could not delete entry.</div>';
            }

            $stmt->close();
        } else {
            $statusMessage = '<div class="messages">Delete query failed.</div>';
        }
    } else {
        $name = trim($_POST['visitor_name'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Check empty fields
        if ($name === '' || $message === '') {
            $statusMessage = '<div class="messages">Both name and message are required.</div>';
        } elseif (strlen($message) > 500) {
            $statusMessage = '<div class="messages">Message cannot exceed 500 characters.</div>';
        } else {

            $sql = "INSERT INTO guestbook (visitor_name, message) VALUES (?, ?)";
            $stmt = $db->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ss", $name, $message);

                if ($stmt->execute()) {
                    $statusMessage = '<div class="messages success">Guestbook entry added!</div>';
                } else {
                    $statusMessage = '<div class="messages">Could not save your message.</div>';
                }

                $stmt->close();
            } else {
                $statusMessage = '<div class="messages">Query preparation failed.</div>';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js" defer></script>
</head>

<body data-submitted="<?php echo ($statusMessage != "") ? 'true' : 'false'; ?>">

<div class="container">
    <h1>Guestbook</h1>

    <?php echo $statusMessage; ?>

    <form action="index.php" method="post">
        <label for="visitor_name">Your Name</label>
        <input type="text" id="visitor_name" name="visitor_name">

        <label for="message">Your Message</label>
        <textarea id="message" name="message"></textarea>
        <p id="charCount">0 / 500 characters</p>

        <button type="submit">Sign Guestbook</button>
    </form>

    <hr>

    <h2>Entries</h2>

    <?php
    if ($dbOk) {

        $sql = "SELECT id, visitor_name, message, posted_at
                FROM guestbook
                ORDER BY posted_at DESC";

        $result = $db->query($sql);

        if ($result) {

            while ($row = $result->fetch_assoc()) {

                echo '<div class="entry">';
                echo '<h3>' . htmlspecialchars($row['visitor_name']) . '</h3>';
                echo '<p>' . htmlspecialchars($row['message']) . '</p>';
                echo '<div class="time">' . htmlspecialchars($row['posted_at']) . '</div>';

                echo '<form action="index.php" method="post" class="deleteForm">';
                echo '<input type="hidden" name="delete_id" value="' . htmlspecialchars($row['id']) . '">';
                echo '<button type="submit">Delete</button>';
                echo '</form>';
                echo '</div>';
            }

            $result->free();

        } else {
            echo '<div class="messages">Could not retrieve guestbook entries.</div>';
        }
    }
    ?>
</div>

</body>
</html>