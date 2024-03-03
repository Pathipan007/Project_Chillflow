const wrapper = document.querySelector(".wrapper");
const loginLink = document.querySelector(".login-link");
const registerLink = document.querySelector(".register-link");
const btnPopup = document.querySelector(".btnLogin-popup");
const iconClose = document.querySelector(".icon-close");
const iconmusics = document.querySelector(".icon-music");
const music = document.querySelector(".music");
const iconstat = document.querySelector(".icon-stat");
const icontime = document.querySelector(".icon-time");
const iconhome = document.querySelector(".icon-home");
const iconbg = document.querySelector(".iconbg");
function toggleMusicActiveClass() {
    music.classList.toggle('active');
  }
function toggleStatActiveClass() {
    wrapper.classList.toggle('active-popup');
  }
function toggleTimeActiveClass() {
    wrapper.classList.toggle('active-popup');
  }
function toggleHomeActiveClass() {
    music.classList.remove('active');

  }
  function toggleBGActiveClass() {
    wrapper.classList.toggle('active-popup');
  }
registerLink.addEventListener("click", () => {
  wrapper.classList.add("active");
});
loginLink.addEventListener("click", () => {
  wrapper.classList.remove("active");
});
btnPopup.addEventListener("click", () => {
  wrapper.classList.add("active-popup");
});
iconClose.addEventListener("click", () => {
  wrapper.classList.remove("active-popup");
});
iconmusics.addEventListener('click', toggleMusicActiveClass);
iconstat.addEventListener('click', toggleStatActiveClass);
icontime.addEventListener('click', toggleTimeActiveClass);
iconhome.addEventListener('click', toggleHomeActiveClass);
iconbg.addEventListener('click', toggleBGActiveClass);


