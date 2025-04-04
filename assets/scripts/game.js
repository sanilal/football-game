document.addEventListener("DOMContentLoaded", function () {
    function isMobileDevice() {
        return /Mobi|Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent);
    }

    if (!isMobileDevice()) {
        // Redirect to a different page if it's not a smartphone/tablet
        window.location.href = "desktop_warning.html"; 
    }
});

const viewportWidth = window.innerWidth;
const viewportHeight = window.innerHeight;
const football = document.getElementById("football");
const goalpost = document.getElementById("goalpost");
const goalCount = document.getElementById("goal-count");
const timerElement = document.getElementById("timer");

let goals = 0;
let gameEnded = false;
let gameTime = 200;
let ballMoving = false;


const initialBallPosition = {
    left: "50%",
    bottom: "25px",
    transform: "translateX(-50%)"
};

football.addEventListener("click", kickBall);
startTimer();

function startTimer() {
    const timer = setInterval(() => {
        if (gameEnded) {
            clearInterval(timer);
            return;
        }

        gameTime--;
        timerElement.textContent = gameTime;

        if (gameTime <= 0) {
            clearInterval(timer); // Stop the timer
           //  console.log("Timer ended, calling endGame()");
            endGame();
        } else {

        }
    }, 1000);
}


function kickBall() {
    if (ballMoving || gameEnded) return;
    ballMoving = true;

    const startX = football.offsetLeft;
    const startY = football.offsetTop;
    const goalpostRect = goalpost.getBoundingClientRect();
    const ballRect = football.getBoundingClientRect();

    const randomChance = Math.floor(Math.random() * 5) + 1;

    let targetX, targetY;
console.log(randomChance)
    if (randomChance === 3 || randomChance === 4) {
        // Ball enters goal (inside post)
        targetX = goalpostRect.left + (goalpostRect.width / 2) - (ballRect.width / 2);
        targetY = goalpostRect.top + (goalpostRect.height / 2) - (ballRect.height / 2);
    } else if (randomChance === 1 || randomChance === 2) {
        // Ball misses to the LEFT
        targetX = goalpostRect.left - 50; 
        targetY = goalpostRect.top + Math.random() * 50;
    } else if (randomChance === 5) {
        // Ball misses to the RIGHT
        targetX = goalpostRect.right + 50; 
        targetY = goalpostRect.top + Math.random() * 50;
    }

    // Move the ball
    football.style.transition = "transform 2s, left 2s, bottom 2s";
    football.style.transform = `translate(${targetX - startX}px, ${targetY - startY}px)`;
    football.style.left = `${targetX}px`;
    football.style.bottom = `${targetY}px`;

    // Prevent ball from passing beyond the goal
    setTimeout(() => {
        if (randomChance === 3 || randomChance === 4) {
            football.style.transition = "none"; // Stop movement
            football.style.left = `${targetX}px`; 
            football.style.top = `${targetY}px`;
        }
    }, 2000); // Ensures ball doesn't move beyond goal after transition
}



football.addEventListener("transitionend", () => {
    if (!ballMoving) return;

    const goalpostRect = goalpost.getBoundingClientRect();
    const ballRect = football.getBoundingClientRect();
    const ballInGoal = ballRect.left >= goalpostRect.left && ballRect.right <= goalpostRect.right;

    if (ballInGoal) {
        // console.log("Initial Goal!", goals);
        goals++;
        // console.log("New Goal!", goals);
        // goalCount.textContent = goals;
        goalCount.textContent = String(goals).padStart(2, '0'); // Ensures 01, 02, 03

    }

    resetBall();
});

function resetBall() {
    football.style.transition = "none";
    football.style.transform = initialBallPosition.transform;
    football.style.left = initialBallPosition.left;
    football.style.bottom = initialBallPosition.bottom;
    ballMoving = false;
}


function endGame() {
    gameEnded = true;
    football.removeEventListener("click", kickBall);

    let finalGoals = goals || 0;
    // console.log("Final Goals:", finalGoals);

    $.post("save_score.php", { goals: finalGoals }, function(response) {
        // console.log("Score saved:", response);
        // console.log("Redirecting to form.php...");
      //  window.location.replace("form.php");
        setTimeout(() => {
            window.location.replace("form.php");
        }, 500); // Short delay ensures AJAX completes before redirect
    }).fail(function() {
        alert("Error saving score.");
        setTimeout(() => {
            window.location.replace("form.php");
        }, 500);
    });
}





