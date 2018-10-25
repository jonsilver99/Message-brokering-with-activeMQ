function validate(note) {

    for (let key in note) {
        if (note.hasOwnProperty(key)) checkInput(note[key])
    }

    function checkInput(input) {
        let ilegalChars = new RegExp(/[|*&;$^?%"'`=/\\\\<>(){}\\-\\+]/g)
        if (!input) throw 'missing input'
        if (ilegalChars.test(input)) throw 'illegal input'
    }
}