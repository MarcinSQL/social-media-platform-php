const headerUserInfoBtn = document.getElementById("header__user-info-btn");
const modal = document.getElementById("header__modal");
const main = document.getElementById("main");

headerUserInfoBtn.addEventListener("click", () => {
  console.log(modal.style.display);
  if (modal.style.display === "none" || modal.style.display === "") {
    modal.style.display = "block";
  } else {
    modal.style.display = "none";
  }
});

main.addEventListener("click", () => {
  if ((modal.style.display === "block")) {
    modal.style.display = "none";
  }
});
