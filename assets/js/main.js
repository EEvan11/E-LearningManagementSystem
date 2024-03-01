document.addEventListener('DOMContentLoaded', function() {
    console.log('Main JS Loaded');
});

// Function to toggle visibility of an element (for dropdowns, modals, etc.)
function toggleVisibility(elementId) {
    var element = document.getElementById(elementId);
    if (element.style.display === "none" || element.style.display === "") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
}


// Form validation feedback
document.querySelector('form').addEventListener('submit', function(event) {
    let inputs = event.target.querySelectorAll('input');
    inputs.forEach(input => {
        if (!input.validity.valid) {
            alert('Please provide valid input for ' + input.name);
        }
    });
});

// AJAX for dynamic content loading
function fetchQuizQuestions() {
    fetch('/path/to/api/quiz_questions')
    .then(response => response.json())
    .then(data => {
        // Display the fetched quiz questions in the DOM
    });
}
