document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Mensaje enviado. ¡Nos pondremos en contacto contigo pronto!');
  });
  // Get references to the form and its elements
const contactForm = document.getElementById("contact-form");
const nameInput = document.querySelector("input[type='text']");
const emailInput = document.querySelector("input[type='email']");
const messageTextarea = document.querySelector("textarea");
const submitButton = document.querySelector("button[type='submit']");

// Add event listener to the form for submission
contactForm.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent the form from submitting normally
  
  // Perform simple validation
  if (nameInput.value === "" || emailInput.value === "" || messageTextarea.value === "") {
    alert("Please fill in all the fields.");
    return;
  }
  
  // Display success message
  alert("Message sent successfully!");
  
  // Clear the form fields after submission
  nameInput.value = "";
  emailInput.value = "";
  messageTextarea.value = "";
});

// Enable submit button only when all fields are filled
contactForm.addEventListener("input", function () {
  if (nameInput.value !== "" && emailInput.value !== "" && messageTextarea.value !== "") {
    submitButton.removeAttribute("disabled");
  } else {
    submitButton.setAttribute("disabled", "true");
  }
});
