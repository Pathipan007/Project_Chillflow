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
const time = document.querySelector(".clock");
const back = document.querySelector(".background")
const iconbg = document.querySelector(".iconbg");
const bg1 = document.querySelector(".bg1");
const bg2 = document.querySelector(".bg2");
var html = document.querySelector('body');
function toggleMusicActiveClass() {
    music.classList.toggle('active');
    back.classList.remove('active');
    time.classList.remove('active');
  }
function toggleStatActiveClass() {
    
  }
function toggleTimeActiveClass() {
    time.classList.toggle('active');
    back.classList.remove('active');
    music.classList.remove('active');
  }
function toggleHomeActiveClass() {
    back.classList.remove('active');
    music.classList.remove('active');
    time.classList.remove('active');

  }
  function toggleBGActiveClass() {
    back.classList.toggle('active');
    time.classList.remove('active');
    music.classList.remove('active');

  }
  function backgrounds1(){
    html.style.backgroundImage = "url('images/bg.gif')";
  }
  function backgrounds2(){
    html.style.backgroundImage = "url('images/bg1.gif')";
  }

iconmusics.addEventListener('click', toggleMusicActiveClass);
iconstat.addEventListener('click', toggleStatActiveClass);
icontime.addEventListener('click', toggleTimeActiveClass);
iconhome.addEventListener('click', toggleHomeActiveClass);
iconbg.addEventListener('click', toggleBGActiveClass);
bg1.addEventListener('click', backgrounds1);
bg2.addEventListener('click', backgrounds2);

/*time*/
let hr = min = sec = ms = "0" + 0,
    startTimer;

let startBtn = document.getElementById('startBtn');
let stopBtn = document.getElementById('stopBtn');
let resetBtn = document.getElementById('resetBtn');

window.addEventListener('beforeunload', function (e) {
    if (startBtn.disabled) {
      reset();
      e.preventDefault();
      e.returnValue = '';
    }
});
  
function start() {
    startBtn.disabled = true;  
    stopBtn.disabled = false;  
    resetBtn.disabled = false; 
    startTimer = setInterval(() => {
        ms++
        ms = ms < 10 ? "0" + ms : ms;

        if (ms == 100) {
            sec++;
            sec = sec < 10 ? "0" + sec : sec;
            ms = "0" + 0;
        }
        if (sec == 60) {
            min++;
            min = min < 10 ? "0" + min : min;
            sec = "0" + 0;
        }
        if (min == 60) {
            hr++;
            hr = hr < 10 ? "0" + hr : hr;
            min = "0" + 0;
        }
        putValue();
    }, 10);
}

function stop() {
    startBtn.disabled = false;  
    stopBtn.disabled = false;  
    resetBtn.disabled = false; 
    clearInterval(startTimer);
}

function reset() {
    startBtn.disabled = false;  
    stopBtn.disabled = true;  
    resetBtn.disabled = true; 
    clearInterval(startTimer);

    if (hr !== "00" || min !== "00" || sec !== "00") {
        sendTimeToServer(); 
    }

    hr = min = sec = ms = "0" + 0;
    putValue();
}

function putValue() {
    document.querySelector(".millisecond").innerText = ms;
    document.querySelector(".second").innerText = sec;
    document.querySelector(".minute").innerText = min;
    document.querySelector(".hour").innerText = hr;
}

function sendTimeToServer() {
    const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $.ajax({
        type: "POST",
        url: "save_time.php", 
        data: {
            hour: hr,
            minute: min,
            second: sec,
            timezone: timeZone 
        },
        success: function(response) {
            console.log('Time saved successfully');
            console.log(timeZone);
        }
    });
}

$('.show-time').click(function(e) {
    e.preventDefault(); 
    window.location.href = $(this).attr('href');
});

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOMContentLoaded event fired LoginSuccess");
    var detectLoginSuccessPopup = document.querySelector('.login_success');
    var SuccessPopup = detectLoginSuccessPopup.querySelector('.success');
  
    if (SuccessPopup) {
        console.log("Success popup found");
        detectLoginSuccessPopup.classList.add('show'); 
  
        document.getElementById('back-to-login').addEventListener('click', function() {
        detectLoginSuccessPopup.classList.remove('show'); 
        });
    }
  });