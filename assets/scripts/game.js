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
let gameTime = 20;
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
   // console.log("Start X:", startX);
    
    const startY = football.offsetTop;
    const goalpostRect = goalpost.getBoundingClientRect();

    const randomChance = Math.floor(Math.random() * 5) + 1;
     console.log("Random Number:", randomChance);

let targetX, targetY;

if (randomChance === 2 || randomChance === 3 || randomChance === 4) {
    //  Ball enters goal (inside post)
    targetX = goalpostRect.left + goalpostRect.width / 2; // Center of goalpost
    targetY = goalpostRect.top + 20;
} else if (randomChance === 1) {
    //  Ball misses to the LEFT (away from the post)
    targetX = goalpostRect.left - 50; // Move ball further left
    targetY = goalpostRect.top + Math.random() * 50; // Random height
} else if (randomChance === 5) {
    //  Ball misses to the RIGHT (away from the post)
    targetX = goalpostRect.right + 50; // Move ball further right
    targetY = goalpostRect.top + Math.random() * 50; // Random height
}

football.style.transition = "transform 1s, left 1s, bottom 1s";
football.style.transform = `translate(${targetX - startX}px, ${targetY - startY}px)`;
football.style.left = `${targetX}px`;
football.style.bottom = `${targetY}px`;

}

football.addEventListener("transitionend", () => {
    if (!ballMoving) return;

    const goalpostRect = goalpost.getBoundingClientRect();
    const ballRect = football.getBoundingClientRect();
    const ballInGoal = ballRect.left >= goalpostRect.left && ballRect.right <= goalpostRect.right;

    if (ballInGoal) {
         console.log("Initial Goal!", goals);
        goals++;
         console.log("New Goal!", goals);
         goalCount.textContent = goals;
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

    $.post("save_score.php", { goals: finalGoals }, function(response) {
        console.log("Score saved:", response);
        
        // Redirect based on the number of goals
        setTimeout(() => {
            if (finalGoals < 5) {
                window.location.replace("index.php"); // Redirect to index.php if goals < 5
            } else {
                window.location.replace("form.php"); // Redirect to form.php if goals >= 5
            }
        }, 500); // Short delay ensures AJAX completes before redirect

    }).fail(function() {
        alert("Error saving score.");
        
        // Even on failure, apply the same redirection logic
        setTimeout(() => {
            if (finalGoals < 5) {
                window.location.replace("index.php");
            } else {
                window.location.replace("form.php");
            }
        }, 500);
    });
}





