// init jquery fadein animation for each note that being added
function initMainSheet() {
    $('#mainSheet').on('click', 'div.pinned button', function (event) {
        let target = event.target;
        deleteFromDom(target.parentElement);
    });
}


// Notes
function printNoteToDom(note) {
    note.id = note.id || undefined;
    let domElem = $(noteTemplate(note));
    $('#mainSheet').append(domElem);
    domElem.addClass("fadeIn");
}

function deleteFromDom(targetNode) {
    targetNode.classList.add("fadeOut");
    setTimeout(function () {
        targetNode.remove();
    }, 1500);
}

function noteTemplate(data) {
    return `
    <div id="N${data.id}" class="pinned">
        <button></button>
        <p>${data.date}</p>
        <p>${data.time}</p>
        <p>${data.noteInput}</p>
    </div>`
}


// Popup
function popup(text) {
    let pop = $(popupTemplate(text))
    $('body').append(pop)
    setTimeout(() => {
        deleteFromDom(pop[0])
    }, 3000)
}

function popupTemplate(text) {
    return `<div  class="popup"><h3>${text}</h3></div>`
}
