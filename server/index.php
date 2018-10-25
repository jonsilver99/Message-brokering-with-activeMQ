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
    Notifications::notify(Database::$connection_status);

    // get new notes
    $newNotes = QueueHandler::readNewMessages();

    if (empty($newNotes)) {
        Notifications::notify("No new messages on Notes queue");
    } else {
        // insert all new notes to db
        for ($i = 0; $i < count($newNotes); $i++) {
            DBHandler::insert_to_db($newNotes[$i], 'notes');
        }
        Notifications::notify("Following data inserted to db:");
        var_dump($newNotes);
    }

} catch (Exception $e) {
    Notifications::notify('Error: ' . $e->getMessage());
    exit();
}
