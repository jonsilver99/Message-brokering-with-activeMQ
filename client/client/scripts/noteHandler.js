function sendToQueue(note) {
    let queue = "/queue/notes";
    note = JSON.stringify(note);
    client.send(queue, { priority: 4 }, note);
}

// for getting notes spa style via ajax polling
function poll() {
    console.log('check db for new notes');

    // first get all notes currently on dom and extract their id's 
    let currentlyOnDom = [...document.querySelectorAll('.pinned')].map(pinnedNote => pinnedNote.id);

    // poll every 5 seconds 
    return $.ajax({
        url: 'index.php?ajax_poll',
        method: "GET",
        dataType: "JSON"
    })
        .then(newNotes => {
            if (newNotes && newNotes.length) {
                newNotes = newNotes.filter(note => {
                    return !currentlyOnDom.includes(`N${note.id}`);
                })
                newNotes.forEach(note => printNoteToDom(note));
            }
            setTimeout(poll, 5000)
        })
        .catch(err => {
            console.log(err);
            alert('Error occured while ajax polling. Polling stopped - check console')
        })
}