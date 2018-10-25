initMainSheet();

$('#Note-form').on('submit', function (e) { submitNote(e, this) });

function submitNote(subEvent, form) {
    try {
        subEvent.preventDefault();

        let note = {};
        $(form).find('input, textarea').serializeArray().forEach(field => { note[field.name] = field.value });

        validate(note)

        sendToQueue(note)

        popup('Note sent to queue')

        // printNoteToDom(note)

    } catch (error) {
        console.log(error)
        alert(error);
    }
}


// start polling notes
setTimeout(poll, 5000);