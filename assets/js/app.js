const question = document.querySelectorAll(".question");
const next = document.querySelector(".btn-f");
const prev = document.querySelector(".btn-b");
const num = document.querySelectorAll(".num");


for (i = 1; i < question.length; i++) {
    let inp = document.querySelectorAll(`input[type="radio"]`);
    inp.forEach(inps => {
        inps.addEventListener("change", function (e) {
            if (e.target.checked) {
                addBackground(e.target.getAttribute('data-id'));
            }
        })
    })
}

function addBackground(lsx) {
    num.forEach(nums => {
        if (nums.getAttribute("data-id") == lsx) {
            nums.classList.remove("bgr");
            nums.classList.add("bgs");
        }
    })
}

num.forEach(nums => {
    nums.classList.add("bgr");
})




num.forEach(nums => {
    nums.addEventListener("click", function (e) {
        if (e.target.classList.contains("active")) {
            console.log('yes');
        } else {
            document.querySelector(".active").classList.remove("active");
            e.target.classList.add("active");
            addActive(e.target.getAttribute("data-id"));
        }
    })
})


let ldx = 1;



function addActive(ld) {
    question.forEach(quest => {
        if (quest.getAttribute("data-id") == ld) {
            quest.classList.add("active");
        } else {
            quest.classList.remove("active");
        }
    })
}

function navQuiz(lx) {
    num.forEach(nums => {
        if (nums.getAttribute("data-id") == lx) {
            nums.classList.add("active");
        } else {
            nums.classList.remove("active");
        }
    })
}


// next.addEventListener("click", (e) => {
//     e.preventDefault();
//     ldx++;
//     if (ldx > question.length) {
//         ldx = 1;
//     }
//     addActive(ldx);
//     navQuiz(ldx);
// });

// prev.addEventListener("click", (e) => {
//     e.preventDefault();
//     if (ldx > 1) {
//         ldx--;
//     }
//     addActive(ldx);

// });

// const ttf = tt.getAttribute("data-time");
// const tt = document.querySelector(".time");
// const start = ttf;

// // Timings

// const COUNTER_SEC = 'seconds';
// const COUNTER_MIN = 'min';

// let time = start * 60;
// let refresh = setInterval(updateCounter, 1000);


// function updateCounter() {
//     const min = parseInt(Math.floor(time / 60), 10);
//     let sec = parseInt(time % 60, 10);

//     sec = (sec < 10) ? "0" + sec : sec;

//     tt.innerHTML = `${min}:${sec}`;
//     time--;
//     if (time < 0) {
//         clearInterval(refresh);
//         document.quiz.submit();
//     }
// }




