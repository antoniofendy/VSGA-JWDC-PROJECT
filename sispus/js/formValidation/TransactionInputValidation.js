let input_field = [
    trans_id = {
        id: "trans_id",
        required: "Transaction ID must be filled"
    },
    isbn = {
        id: "book",
        required: "Book's ISBN must be filled",
        format: "Book's ISBN must be 10 or 13 digits",
        invalid: "Please verify book's ISBN"
    },
    member = {
        id: "member",
        required: "Member's ID must be filled",
        invalid: "Please verify member's id"
    },
    borrow = {
        id: "borrow",
        required: "Borrow date must be filled"
    },
    due = {
        id: "due",
        required: "Due date must be filled"
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

function validasiForm() {

    clearErrorMessage();

    // CHECK trans_id
    let trans_id_input = document.getElementById(trans_id.id);
    if (required(trans_id_input.value) === false) {
        // trans_id error message not filled
        addErrorMessage(trans_id.id, trans_id.required);
        return false;
    }

    // CHECK member
    let member_input = document.getElementById(member.id);
    let member_name = document.getElementById('member-name');
    if (required(member_input.value) === false) {
        // member error message not filled
        addErrorMessage(member.id, member.required);
        return false;
    }
    else if (member_name.value == "" || member_name.value == "Member not found") {
        addErrorMessage(member.id, member.invalid);
        return false;
    }

    // CHECK ISBN
    let isbn_input = document.getElementById(isbn.id);
    let book_name = document.getElementById('book-name');
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
    if (book_name.value == "" || book_name.value == "Book not found") {
        addErrorMessage(isbn.id, isbn.invalid);
        return false;
    }

    let borrow_input = document.getElementById(borrow.id);
    if (required(borrow_input.value) === false) {
        // borrow error message not filled
        addErrorMessage(borrow.id, borrow.required);
        return false;
    }

    let due_input = document.getElementById(due.id);
    if (required(due_input.value) === false) {
        // due error message not filled
        addErrorMessage(due.id, due.required);
        return false;
    }

    return true;

}