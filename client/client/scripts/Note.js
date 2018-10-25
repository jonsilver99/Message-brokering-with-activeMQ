class Note {
    constructor(date, time, noteInput) {
        this.id = undefined;
        this.date = (new Date(date)).toLocaleDateString();
        this.time = time;
        this.noteInput = noteInput;
    }
}