/*Programmer Name: YEO PEI WEN (TP077057), SIM TIAN (TP077056)
Program Name: W.P.plan.js
Description: Generate workout plan for workout plan page
First Written on: Friday, 20-June-2025
Edited on: 08-JULY-2025*/

import { calculateBMI, generateWorkoutPlan } from './W.P.Calculation.js';
import { showBMIResult } from './W.P.GeneratedPlan.js';

let stage = 0;
let tempHeight = 0;
let tempWeight = 0;

let member_profiles = {
  mbp_height: null,
  mbp_weight: null
};

let userHeight = 0;
let userWeight = 0;

// Step 1: Fetch height & weight from DB first
function startBMIChat() {
  // Fetch height and weight
  fetch("W.P.getMemberData.php")
    .then(res => res.text())
    .then(text => {
      if (text.startsWith("<!DOCTYPE")) {
        throw new Error("Received HTML instead of JSON. Possibly logged out.");
      }
      const data = JSON.parse(text);
      if (data.mbp_height && data.mbp_weight) {
        member_profiles.mbp_height = parseFloat(data.mbp_height);
        member_profiles.mbp_weight = parseFloat(data.mbp_weight);
        addMessage(`
          <div>These are the most recent details we’ve saved for you 💞</div>
          <table class="chat-table">
            <tr><th>Height:</th><td>${data.mbp_height} cm</td></tr>
            <tr><th>Weight:</th><td>${data.mbp_weight} kg</td></tr>
          </table>
        `);
        addMessage("Do you want to use your profile's height and weight? (yes/no)");
        stage = 0;
      } else {
        addMessage("No height and weight found in your profile. Please enter your height in cm:");
        stage = 1;
      }
    })
    .catch(err => {
      console.error("Failed to fetch profile data:", err);
      addMessage("⚠️ Error retrieving profile data. Please make sure you're logged in.");
    });
}


// Add message to chat window
function addMessage(text, sender = "bot") {
  const box = document.getElementById("chatBox");
  const msg = document.createElement("div");
  msg.className = sender;
  msg.innerHTML = text;
  box.appendChild(msg);
  box.scrollTop = box.scrollHeight;
}

// Listen to user input
document.getElementById("sendBtn").addEventListener("click", handleUserInput);
document.getElementById("userInput").addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    handleUserInput();
  }
});

// Main handler
function handleUserInput() {
  const input = document.getElementById("userInput");
  const msg = input.value.trim();
  if (!msg) return;

  addMessage(msg, "user");
  input.value = "";

  if (stage === 0) {
    if (msg.toLowerCase() === "yes") {
      userHeight = member_profiles.mbp_height;
      userWeight = member_profiles.mbp_weight;
      proceedToGeneratePlan();
      stage = -1;
    } else {
      addMessage("Please enter your height in cm:");
      stage = 1;
    }
  } else if (stage === 1) {
    tempHeight = parseFloat(msg);
    if (isNaN(tempHeight) || tempHeight <= 0) {
      addMessage("Please enter a valid number for height.");
      return;
    }
    addMessage("Now enter your weight in kg:");
    stage = 2;
  } else if (stage === 2) {
    tempWeight = parseFloat(msg);
    if (isNaN(tempWeight) || tempWeight <= 0) {
      addMessage("Please enter a valid number for weight.");
      return;
    }
    userHeight = tempHeight;
    userWeight = tempWeight;
    proceedToGeneratePlan();
    stage = -1;
  }
}


fetch("W.P.checkExistingPlan.php")
  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      addMessage("⚠️ You must be logged in to continue.");
      return;
    }

    if (data.exists) {
      const createdDate = new Date(data.created_at).toLocaleDateString('en-GB');
            // Show chatbot message + buttons together
      const messageDiv = document.createElement("div");
      messageDiv.className = "bot";

      messageDiv.innerHTML = `
        💪 You already have a workout plan created on <b>${createdDate}</b> this week.<br>
        Would you like to create a new one or continue with the current one?
        <div class="chat-button-group">
          <button class="chat-option-btn" id="createBtn">🆕 Create New Plan</button>
          <button class="chat-option-btn" id="continueBtn">🔄 Continue Existing Plan</button>
        </div>
      `;

      const chatBox = document.getElementById("chatBox");
      chatBox.appendChild(messageDiv);
      chatBox.scrollTop = chatBox.scrollHeight;

      document.getElementById("createBtn").onclick = () => {
        // Reuse saved profile height/weight
        if (member_profiles.mbp_height && member_profiles.mbp_weight) {
          userHeight = member_profiles.mbp_height;
          userWeight = member_profiles.mbp_weight;
          proceedToGeneratePlan(); // ✅ Directly proceed to new plan
        } else {
          startBMIChat(); // fallback if no profile found
        }
      };


      document.getElementById("continueBtn").onclick = () => {
        messageDiv.remove();
        window.location.href = "W.routine.php"; // ✅ Redirect to workout routine
      };
    } else {
      startBMIChat();
    }
  })
  .catch(err => {
    console.error("Error:", err);
    addMessage("❌ Failed to check existing workout plan.");
  });


// Step to generate and show plan
function proceedToGeneratePlan() {
  const result = generateWorkoutPlan(userWeight, userHeight);
  showBMIResult(result, addMessage, member_profiles, userHeight, userWeight);
  saveWorkoutPlan(result, userWeight, userHeight); // ✅ Pass the correct object
}

// Save to database
function saveWorkoutPlan(planResult, weight, height) {
  const bmi = planResult.BMI;
  const category = planResult.Category;
  const plan = planResult.WeeklyPlan;

  console.log("🧪 Sending to PHP:", {
    height,
    weight,
    bmi,
    category,
    plan
  });

  fetch("W.saveWorkoutPlan.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      height,
      weight,
      bmi,
      category,
      plan
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      // Step 1: confirm saved
      addMessage("✅ Workout plan saved!");

      // Step 2: guide message after slight delay
      setTimeout(() => {
        addMessage("🎯 You can now visit the <b>Workout Routine</b> page to view your daily workouts.");

        // Step 3: show the button only after message
        const buttonDiv = document.createElement("div");
        buttonDiv.className = "bot";
        buttonDiv.innerHTML = `
          <div class="chat-button-group">
            <button class="chat-option-btn" onclick="window.location.href='W.routine.php'">
              🏋️ Go to Workout Routine
            </button>
          </div>
        `;
        document.getElementById("chatBox").appendChild(buttonDiv);
        document.getElementById("chatBox").scrollTop = document.getElementById("chatBox").scrollHeight;
      }, 4000);
    } else {
      addMessage("❌ Failed to save workout plan.");
      console.error("Server says:", data.message);
    }
  });
}

