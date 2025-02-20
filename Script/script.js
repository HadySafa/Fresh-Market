
// handling login
document.addEventListener("DOMContentLoaded", () => {

    const number = document.getElementById("PhoneNumber")
    const password = document.getElementById("Password")
    const form = document.getElementById("login-form")

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault()
            if (!isNaN(number.value) && number.value.length == 8 && password.value.length == 8) {
                form.submit()
            }
            else {
                form.reset()
            }
        })
    }

})

// handling signup
document.addEventListener("DOMContentLoaded", () => {

    const name = document.getElementById("FullName")
    const number = document.getElementById("PhoneNumber")
    const password = document.getElementById("Password")
    const email = document.getElementById("Email")
    const confirmedPassword = document.getElementById("ConfirmPassword")
    const form = document.getElementById("signup-form")

    if (form) {

        number.addEventListener("blur", () => {
            if (number.value.length > 0 && number.value.length != 8) {
                number.value = ""
                document.getElementById("numberError").textContent = "Must be an 8-digit number."
            }
            else {
                document.getElementById("numberError").textContent = ""
            }
        })

        email.addEventListener("blur", () => {
            const pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email.value.length > 0 && !pattern.test(email.value)) {
                email.value = ""
                document.getElementById("emailError").textContent = "Not a valid format"
            }
            else {
                document.getElementById("emailError").textContent = ""
            }
        })

        password.addEventListener("blur", () => {
            const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            if (password.value.length > 0 && !pattern.test(password.value)) {
                password.value = ""
                document.getElementById("passwordError").textContent = "Password must be at least 8 characters, containing a number, lowercase and uppercase characters."
            }
            else {
                document.getElementById("passwordError").textContent = ""
            }
        })

        confirmedPassword.addEventListener("blur", () => {
            if (confirmedPassword.value.length > 0 && confirmedPassword.value !== password.value) {
                confirmedPassword.value = ""
                document.getElementById("confirmPasswordError").textContent = "Passwords don't match"
            }
            else {
                document.getElementById("confirmPasswordError").textContent = ""
            }
        })

        form.addEventListener("submit", (e) => {
            e.preventDefault()

            if (name.value && number.value && password.value && email.value && confirmedPassword.value) {
                document.getElementById("general-error").textContent =
                    form.submit()
            }
            else {
                document.getElementById("general-error").textContent = "Fields can't be empty."
            }

        })
    }

})

// handling scroll in products page
document.addEventListener("DOMContentLoaded", () => {

    const sections = document.querySelectorAll(".products-categoriesContainer>button")
    const section1 = sections[0];
    const section2 = sections[1];
    const section3 = sections[2];

    function function1() {
        document.getElementById("Fruits&Vegetables").scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    function function2() {
        document.getElementById("Groceries").scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        
    }

    function function3() {
        document.getElementById("Snacks&Beverages").scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }


    if (sections.length > 0) {

        section1.addEventListener("click", function1)
        //section1.addEventListener("touchend", function1)

        section2.addEventListener("click", function2)
        //section2.addEventListener("touchend", function2)

        section3.addEventListener("click", function3)
        //section3.addEventListener("touchend", function3)
    }

})

// handling button functionality in product-details
document.addEventListener("DOMContentLoaded", () => {

    const quantity = document.querySelector(".row3>input")
    const minus = document.getElementById("minus")
    const plus = document.getElementById("plus")

    function decrease() {
        if (quantity.value > 1) {
            quantity.value = quantity.value - 1
        }
    }

    function increase() {
        let maxQuantity = parseInt(quantity.dataset.maxquantity);
        if (quantity.value < maxQuantity) {
            quantity.value = parseInt(quantity.value) + 1
        }
    }

    if (quantity && quantity.value > 0) {

        minus.addEventListener("click", decrease)

        plus.addEventListener("click", increase)

    }

})

// handle adding new item
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("new-item-form")
    const error = document.getElementById("error-message")

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault()

            let name = form.querySelector('input[name="Name"]').value;
            let description = form.querySelector('input[name="Description"]').value;
            let quantity = form.querySelector('input[name="Quantity"]').value;
            let price = form.querySelector('input[name="Price"]').value;
            let category = form.querySelector('select[name="Category"]').value;
            let image = form.querySelector('input[name="Image"]').files[0];

        
            if (name && description && quantity && price && image && category) {
                if (!isNaN(quantity) && !isNaN(price)) {
                    if (image.type === "image/jpeg" || image.type === "image/png" || image.type === "image/jpg") {
                        form.submit()
                    }
                    else {
                        error.textContent = "Invalid image type (must be png / jpeg / jpg)."
                    }
                }
                else {
                    error.textContent = "Quantity and price must be numbers."
                }
            }
            else {
                error.textContent = "Please fill all fields.";
            }



        })
    }

})

// handle edit item
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("edit-item-form")
    const error = document.getElementById("edit-item-error-message")

    if (form) {

        form.addEventListener("submit", (e) => {
            e.preventDefault()

            let name = form.querySelector('select[name="Id"]').value;
            let quantity = form.querySelector('input[name="Quantity"]').value;

            if (name && quantity) {
                if (!isNaN(quantity)) {
                    form.submit()
                }
                else {
                    error.textContent = "Quantity must be an integer."
                }
            }
            else {
                error.textContent = "Please fill all fields.";
            }



        })
    }

})

// handle delete item
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("delete-item-form")
    const error = document.getElementById("delete-item-error-message")

    if (form) {


        form.addEventListener("submit", (e) => {
            e.preventDefault()

            let name = form.querySelector('select[name="Id"]').value;

            if (name) {
                form.submit()
            }
            else {
                error.textContent = "Please fill all fields.";
            }

        })
    }

})

// checkout
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("checkout-form")
    const error = document.getElementById("checkout-error-message")

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault()
            let response = confirm("Confirm Order?")
            if (response) {
                let location = document.querySelector('input[type="text"]').value
                let paymentMethod = document.querySelector('.form select').value
                if (location && paymentMethod) {
                    form.submit()
                }
                else {
                    error.textContent = "All fields are required."
                }
            }
        })
    }

})

// toggling nav
document.addEventListener("DOMContentLoaded", () => {

    const nav = document.getElementById("nav")
    const icon = document.getElementById("icon")

    if(nav && icon){
        icon.addEventListener("click",(e) => {
            nav.classList.toggle("visibile")
        })
    }
}
)

// feedback submission
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("feedback-form")
    const error = document.getElementById("feedbackError")

    if (form) {


        form.addEventListener("submit", (e) => {
            e.preventDefault()

            let name = form.querySelector('input[name="Feedback"]').value;

            if (name) {
                form.submit()
            }
            else {
                error.textContent = "Please fill all fields.";
            }

        })
    }

})