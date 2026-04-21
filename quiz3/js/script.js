$(document).ready(function () {
    function updateCharCount() {
        const textarea = document.getElementById("message");
        const counter = document.getElementById("charCount");
        const count = textarea.value.length;

        counter.textContent = count + " / 500 characters";
        counter.style.color = count > 500 ? "red" : "black";
    }

    const textarea = document.getElementById("message");
    textarea.addEventListener("input", updateCharCount);
    updateCharCount();

    $(".form").on("submit", function (e) {
        const count = textarea.value.length;
        if (count > 500) {
            e.preventDefault();
            alert("Message cannot exceed 500 characters.");
        }
    });

    const submitted = document.body.dataset.submitted === "true";

    if (submitted) {
        $(".entry:first").hide().fadeIn(3000);
    }
});