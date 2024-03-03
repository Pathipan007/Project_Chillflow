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

document.addEventListener('DOMContentLoaded', function() {
  console.log("DOMContentLoaded event fired Error");
  var detectErrorPopup = document.querySelector('.detect_error');
  var errorPopup = detectErrorPopup.querySelector('.error');

  if (errorPopup) {
    console.log("Error popup found");
    detectErrorPopup.classList.add('showerror');

    document.getElementById('back-to-login').addEventListener('click', function() {
      detectErrorPopup.classList.remove('showerror');
      document.querySelector('.btnLogin-popup').click();
    });
  }
});

document.addEventListener('DOMContentLoaded', function() {
  console.log("DOMContentLoaded event fired Success");
  var detectSuccessPopup = document.querySelector('.detect_success');
  var regSuccessPopup = detectSuccessPopup.querySelector('.reg_success');

  if (regSuccessPopup) {
      console.log("Success popup found");
      detectSuccessPopup.classList.add('show'); 

      document.getElementById('back-to-login').addEventListener('click', function() {
        detectSuccessPopup.classList.remove('show'); 
        document.querySelector('.btnLogin-popup').click();
      });
  }
});