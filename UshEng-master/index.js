// Get the popup form and the buttons that trigger it
const popup = document.getElementById("divOne");
const btns = document.querySelectorAll("#open-form, #footer-btn, #hero-btn");

// When a button is clicked, show the popup form
btns.forEach(btn => {
  btn.addEventListener("click", function() {
    popup.style.display = "block";
  });
});

// When the user clicks anywhere outside of the popup form, close it
window.addEventListener("click", function(event) {
  if (event.target == popup) {
    popup.style.display = "none";
  }
});