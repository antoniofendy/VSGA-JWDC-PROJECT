let input_field = [
    username = {
        id: "username",
        required: "User's username must be filled",
        alreadyInDB: "This username already used by another user"
    },
    new_password = {
        id: "new_password"
    },
    retype_password = {
        id: "retype_password"
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

function validasiForm() {

    clearErrorMessage();

    // CHECK username
    let username_input = document.getElementById(username.id);
    if (required(username_input.value) === false) {
        // username error message not filled
        addErrorMessage(username.id, username.required);
        return false;
    }
    else {
        if (users.includes(username_input.value)) {
            // username error message already in db
            addErrorMessage(username.id, username.alreadyInDB);
            return false;
        }
    }

    // CHECK new and retype password
    let new_password_input = document.getElementById(new_password.id);
    let retype_password_input = document.getElementById(retype_password.id);

    if (new_password_input.value != '' || retype_password_input.value != '') {
        if (new_password_input.value !== retype_password_input.value) {
            addErrorMessage('password', 'New password and retype password are not equal');
            return false;
        }
    }

    return true;

}