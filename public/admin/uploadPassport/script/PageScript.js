import { validateForm } from "./FormSubmit.js";
document.addEventListener('DOMContentLoaded', function(){

    const form = document.getElementById("passport_form");
    const formpage = document.getElementById("formpage");
    const lastpage = document.getElementById("lastpage");
    const submit_btn = document.getElementById("submit_btn");
    const formButtons = document.getElementById("formButtons");
    const okayBtn = document.getElementById("okay_btn");

    // Hide last page initially
    lastpage.style.display = "none";

    function onLastPage() {
        lastpage.style.display = "block";
        formpage.style.display = "none";
        formButtons.classList.remove("justify-content-evenly");
        formButtons.classList.add("justify-content-center");
        submit_btn.style.display = "none";
        okayBtn.style.display = "block";
    }

    function onOkay() {
        window.location.href = `${window.location.origin}/dashboard/TourAndTravel/core2/public/admin/dashboard/index.php`;
    }

    async function onSubmit() {
        let result = await validateForm(form);
        if (result === true) {
            onLastPage();
        }
    }

    // Button events
    okayBtn.addEventListener("click", onOkay);

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        onSubmit();
    });

    submit_btn.addEventListener("click", function (event) {
        event.preventDefault();
        form.dispatchEvent(new Event("submit"));
    });

})