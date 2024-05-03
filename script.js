const formOpenBtn = document.querySelector("#form-open"),
  home = document.querySelector(".home"),
  formContainer = document.querySelector(".form_container"),
  formCloseBtn = document.querySelector(".form_close"),
  signupBtn = document.querySelector("#signup"),
  loginBtn = document.querySelector("#login"),
  pwShowHide = document.querySelectorAll(".pw_hide");

  formOpenBtn.addEventListener("click", () => home.classList.add("show"));
formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});

signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});
loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});
document.addEventListener("DOMContentLoaded", function() {
  const feedbackPopup = document.getElementById("feedback-popup");
  const closeFeedbackPopup = document.getElementById("close-feedback-popup");
  const openFeedbackPopupBtn = document.getElementById("open-feedback-popup");

  openFeedbackPopupBtn.addEventListener("click", function() {
    feedbackPopup.style.display = "block";
  });

  closeFeedbackPopup.addEventListener("click", function() {
    feedbackPopup.style.display = "none";
  });
});








