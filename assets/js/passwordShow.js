const showPasswordBtn = document.getElementById("showPassword-btn");
const passwordInput = document.getElementById("password");

showPasswordBtn.addEventListener("mousedown", () => {
  passwordInput.type = "text";
});

showPasswordBtn.addEventListener("mouseup", () => {
  passwordInput.type = "password";
});
