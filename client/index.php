<?php
    require_once "constants.php";
    require_once "env_vars.php";
    spl_autoload_register(function ($class) {
        if (file_exists(models . "/$class.php")) {
            require_once models . "/$class.php";
        }
    });
    try {
        // connect mysql
        Database::connect();
        // get all notes from database
        $dbNotes = mysqli_fetch_all(DBHandler::get_results_fromTable('notes'), MYSQLI_ASSOC);

        // check if this is a poll request (ajax) or this is the first time the page is loaded  
        $pollRequest = isset($_GET['ajax_poll']);
        
        // if its a poll request - respond to the ajax request with a json of dbnotes 
        if ($pollRequest) {
            echo json_encode($dbNotes);
            exit();
        }

    } catch (Exception $e) {
        Notifications::notify('Error: ' . $e->getMessage());
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>JS to PHP messaging</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <link href="client/css/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
        crossorigin="anonymous">
    <link href="client/css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Note board - JS to PHP messaging with activeMQ</h1>
    </header>
    <div id="mainSheet" class="container clearfix">
        <!-- Note form -->
        <form id="Note-form">

            <label>Enter Note date:</label>
            <input type="date" name="date" required>
            <br>

            <label>Enter Note time:</label>
            <input type="time" name="time" required>

            <textarea name="noteInput" rows="5" cols="100" placeholder="Type Note input..." required></textarea>

            <button type="submit">Send Note</button>

        </form>

        <!-- Notes -->
        <?php
            if (!$pollRequest && isset($dbNotes) && !empty($dbNotes)) {
                foreach ($dbNotes as $note) {
                    require root . "/templates/note.php";
                }
            }
        ?>
    </div>

    <footer>
        <!-- jquery-->
        <script src="client/libs/stomp.js"></script>
        <script src="client/libs/jquery.js"></script>

        <!-- my scripts -->
        <script src="client/scripts/env.js"></script>
        <script src="client/scripts/stomp-con.js"></script>
        <script src="client/scripts/Note.js"></script>
        <script src="client/scripts/validator.js"></script>
        <script src="client/scripts/noteHandler.js"></script>
        <script src="client/scripts/renderer.js"></script>
        <script src="client/scripts/script.js"></script>
    </footer>
</body>

</html>