/*Programmer Name: YEO PEI WEN (TP077057), SIM TIAN (TP077056)
Program Name: W.GeneratedPlan.js
Description: Generate workout plan for workout plan page
First Written on: Saturday, 21-June-2025
Edited on: 08-JULY-2025*/

export function showBMIResult(result, addMessage, member_profiles, tempHeight, tempWeight) {
  addMessage("Great! Here are your results:", "bot");

  setTimeout(() => {
    addMessage(`📏 Height: ${tempHeight > 0 ? tempHeight : member_profiles.height} cm`, "bot");
  }, 500);

  setTimeout(() => {
    addMessage(`⚖️ Weight: ${tempWeight > 0 ? tempWeight : member_profiles.weight} kg`, "bot");
  }, 1000);

  setTimeout(() => {
    addMessage(`📊 Your BMI: ${result.BMI} (${result.Category})`, "bot");
  }, 1500);

  setTimeout(() => {
    addMessage(`🏋️‍♂️ Recommended Workout Types: ${result.SuggestedWorkoutTypes.join(", ")}`, "bot");
  }, 2000);

  setTimeout(() => {
    addMessage(`💪 Example Workouts: ${result.ExampleWorkouts.join(", ")}`, "bot");
  }, 2500);

  setTimeout(() => {
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    let structuredPlan = {};

    let weeklyPlanHTML = `<div class="workout-plan">
      <h3>🗓️ Your 7-Day Weekly Workout Plan:</h3>
      <div class="weekly-schedule">`;

    result.WeeklyPlan.forEach((dayPlan, index) => {
      const planItems = dayPlan.map(e => `• ${e}`).join('<br>');
      const dayName = days[index];
      structuredPlan[dayName] = dayPlan.map(name => ({ name }));

      weeklyPlanHTML += `
        <div class="day-plan">
          <strong>${dayName}:</strong><br>${planItems}
        </div>`;
    });

    weeklyPlanHTML += `</div></div>`;
    addMessage(weeklyPlanHTML, "bot");

    // ✅ Save to localStorage
    localStorage.setItem("generatedWorkoutPlan", JSON.stringify(structuredPlan));

  }, 3000);

  setTimeout(() => {
    addMessage("✅ Plan saved! You can now visit the 'Workout Routine' page to view your daily workouts.", "bot");
  }, 3500);
}
