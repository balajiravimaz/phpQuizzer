<?php

require_once("inc/header.php");
require_once("config/config.php");
require_once("libraries/Database.php");

if (isset($_SESSION['name'])) {
    include "temp/take.php";
} else {
    header("Location: index.php");
}


require_once("inc/footer.php");

?>

<script>
    next.addEventListener("click", (e) => {
        e.preventDefault();
        ldx++;
        if (ldx > question.length) {
            ldx = 1;
        }
        addActive(ldx);
        navQuiz(ldx);
    });

    prev.addEventListener("click", (e) => {
        e.preventDefault();
        if (ldx > 1) {
            ldx--;
        }
        addActive(ldx);

    });

    const tt = document.querySelector(".time");
    const ttf = tt.getAttribute("data-time");
    const start = ttf;

    // Timings

    const COUNTER_SEC = 'seconds';
    const COUNTER_MIN = 'min';

    let time = start * 60;
    let refresh = setInterval(updateCounter, 1000);


    function updateCounter() {
        const min = parseInt(Math.floor(time / 60), 10);
        let sec = parseInt(time % 60, 10);

        sec = (sec < 10) ? "0" + sec : sec;

        tt.innerHTML = `${min}:${sec}`;
        time--;
        if (time < 0) {
            clearInterval(refresh);
            document.quiz.submit();
        }
    }
</script>