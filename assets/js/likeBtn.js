const likeBtn = document.querySelectorAll(
  "#post__footer__like-section__like-btn"
);

likeBtn.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.preventDefault();
    e.target.classList.add("liked");
  });
});
