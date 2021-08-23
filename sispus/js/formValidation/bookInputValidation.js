let input_field = [
    cover = {
        id: "cover",
        required: "Book's cover must be uploaded",
        format: "Book's cover must be formatted in png/jpg/jpeg"
    },
    isbn = {
        id: "isbn",
        required: "Book's ISBN must be filled",
        format: "Book's ISBN must be 10 or 13 digits"
    },
    title = {
        id: "title",
        required: "Book's title must be filled"
    },
    _status = {
        id: "status",
        required: "Book's status must be filled"
    },
    category = {
        id: "category",
        required: "Book's category must be filled"
    },
    writer = {
        id: "writer",
        required: "Book's writer must be filled",
    },
    publisher = {
        id: "publisher",
        required: "Book's publisher must be filled"
    },
    year = {
        id: "year",
        required: "Book's year must be filled",
        format: "Book's year must be formatted in year"
    }
];

function required(value) {
    return value.trim() !== "";
}

function addErrorMessage(id, message) {
    let small = document.getElementById(id + "-error");
    small.innerHTML = message + "<br>";
    let str = window.location.href;
    window.location.href = str.split("#")[0] + "#" + id;
}

function clearErrorMessage() {
    let allErrorMessage = document.querySelectorAll("small[style='color: red;']");
    for (let i = 0; i < allErrorMessage.length; i++) {
        allErrorMessage[i].innerText = "";
    }
}

function checkDigit(value) {
    if (value === 10) {
        return false;
    }
    else if (value === 13) {
        return false;
    }
    return true;
}

function yearDigit(value) {
    if (value.match(/^(181[2-9]|18[2-9]\d|19\d\d|2\d{3}|30[0-3]\d|304[0-8])$/)) {
        return false;
    }
    return true;
}

function ratingDigit(value) {
    if (value >= 0 && value <= 5) {
        return false;
    }
    return true;
}

function validasiForm() {

    clearErrorMessage();

    // CHECK COVER
    let cover_input = document.getElementById(cover.id);
    if (required(cover_input.value)) {
        // Cover error message when format are not png/jpg/jpeg
        if (cover_input.value.match(/jpg|png|jpeg/g) === null) {
            addErrorMessage(cover.id, cover.format);
            return false;
        }
    }
    else {
        // Cover error message not filled
        addErrorMessage(cover.id, cover.required);
        return false;
    }

    // CHECK ISBN
    let isbn_input = document.getElementById(isbn.id);
    if (required(isbn_input.value)) {
        // ISBN error message when format are not number
        if (isbn_input.value.match(/[0-9]/g) === null || checkDigit(isbn_input.value.length)) {
            addErrorMessage(isbn.id, isbn.format);
            return false;
        }
    }
    else {
        // ISBN error message not filled
        addErrorMessage(isbn.id, isbn.required);
        return false;
    }

    // CHECK title
    let title_input = document.getElementById(title.id);
    if (required(title_input.value) === false) {
        // title error message not filled
        addErrorMessage(title.id, title.required);
        return false;
    }

    // CHECK status
    let status_input = document.getElementById(_status.id);
    if (required(status_input.value) === false) {
        // status error message not filled
        addErrorMessage(_status.id, _status.required);
        return false;
    }

    // CHECK category
    let category_input = document.getElementById(category.id);
    if (required(category_input.value) === false) {
        // category error message not filled
        addErrorMessage(category.id, category.required);
        return false;
    }

    // CHECK writer
    let writer_input = document.getElementById(writer.id);
    if (required(writer_input.value) === false) {
        // writer error message not filled
        addErrorMessage(writer.id, writer.required);
        return false;
    }

    // CHECK publisher
    let publisher_input = document.getElementById(publisher.id);
    if (required(publisher_input.value) === false) {
        // publisher error message not filled
        addErrorMessage(publisher.id, publisher.required);
        return false;
    }

    // CHECK year
    let year_input = document.getElementById(year.id);
    if (required(year_input.value)) {
        // Year regex
        if (yearDigit(year_input.value)) {
            addErrorMessage(year.id, year.format);
            return false;
        }
    }
    else {
        // year error message not filled
        addErrorMessage(year.id, year.required);
        return false;
    }

    return true;

}