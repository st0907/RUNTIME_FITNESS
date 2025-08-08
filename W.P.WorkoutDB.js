/*Programmer Name: YEO PEI WEN (TP077057)
Program Name: W.P.WorkoutDB.js
Description: Generate workout plan for workout plan page
First Written on: Sunday, 22-June-2025
Edited on: 08-JULY-2025*/

//workout details
export const workoutData = {
  underweight: {
    category: "Underweight",
    types: ["Light Strength", "Yoga", "Pilates", "Core Pilates Power"],
    examples: [
      "Full Body Strength Builder (20–30 mins)",
      "Gentle Morning Stretch (15 mins)",
      "Pilates (20 mins)",
      "Core Pilates Power (30 mins)"
    ],
    plan: [
      ["Light Strength (20 mins)", "Core Pilates Power (30 mins)"],
      ["Yoga (20 mins)", "Core Pilates Power (20 mins)"],
      ["Pilates (20 mins)", "Gentle Stretch (15 mins)"],
      ["Light Strength (20 mins)", "Core Pilates Power (30 mins)"],
      ["Yoga (15 mins)", "Pilates (20 mins)"],
      ["Light Strength (20 mins)", "Core Pilates Power (30 mins)"],
      ["Active Rest: Light walk or stretch (15 mins)"]
    ]
  },

  normal: {
    category: "Normal Weight",
    types: ["Cardio", "Strength", "HIIT"],
    examples: [
      "Full Body Strength Builder (30 mins)",
      "Cardio Dance Party (30 mins)",
      "HIIT (20 mins)"
    ],
    plan: [
      ["Cardio: Jog (30 mins)", "Strength Builder (30 mins)", "Plank + Russian Twists (3x20)"],
      ["HIIT (20 mins)", "Stretch (15 mins)"],
      ["Leg Strength (30 mins)", "Plank Variations (3x30s)"],
      ["Cycling (40 mins)", "Abs: Leg Raises + Flutter Kicks (3x20)"],
      ["Full Body Strength (30 mins)", "Leg HIIT (20 mins)"],
      ["Walk or Jog (45 mins)", "Flexibility Stretch (20 mins)"],
      ["Active Rest: Light yoga (15 mins)"]
    ]
  },

  overweight: {
    category: "Overweight",
    types: ["Low-impact Cardio", "HIIT", "Strength"],
    examples: [
      "Quick HIIT Express (20 mins)",
      "Beginner’s Strength Journey (30 mins)",
      "Low-impact Cardio (30 mins)"
    ],
    plan: [
      ["Low-impact Cardio (30 mins)", "Strength: Beginner (30 mins)", "Plank (3x20s)"],
      ["HIIT Express (20 mins)", "Stretch (15 mins)"],
      ["Strength Journey (30 mins)", "Core: Flutter Kicks (3x20)"],
      ["Cycling/Walking (30 mins)", "Stretch (15 mins)"],
      ["Upper Body Strength (30 mins)", "HIIT (20 mins)"],
      ["Walk or Bike (30 mins)", "Stretch (20 mins)"],
      ["Active Rest: Yoga (20 mins)"]
    ]
  },

  obese1: {
    category: "Obese (Class I)",
    types: ["Low-impact Cardio", "Modified Strength", "HIIT"],
    examples: [
      "Morning Yoga Flow (20 mins)",
      "Quick HIIT Express (20 mins)",
      "Modified Strength (30 mins)"
    ],
    plan: [
      ["Walk or Bike (30 mins)", "Modified Strength (30 mins)"],
      ["HIIT Express (20 mins)", "Yoga Flow (20 mins)"],
      ["Strength (30 mins)", "Core: Flutter Kicks (3x20)"],
      ["Low-impact Cardio (30 mins)", "Stretch (20 mins)"],
      ["Strength (30 mins)", "HIIT (20 mins)"],
      ["Walking (30 mins)", "Stretch (20 mins)"],
      ["Active Rest: Light Yoga (20 mins)"]
    ]
  },

  obese2: {
    category: "Obese (Class II)",
    types: ["Beginner Yoga", "Light Cardio"],
    examples: [
      "Gentle Morning Stretch (15 mins)",
      "Morning Yoga Flow (20 mins)",
      "Light Cardio (20 mins)"
    ],
    plan: [
      ["Yoga (20 mins)", "Light Cardio (20 mins)"],
      ["Stretch (15 mins)", "Yoga Flow (20 mins)"],
      ["Light Cardio (20 mins)", "Stretch (15 mins)"],
      ["Yoga (20 mins)", "Walking (20 mins)"],
      ["Stretch (15 mins)", "Light Cardio (20 mins)"],
      ["Light Cardio (20 mins)", "Stretch (15 mins)"],
      ["Active Rest: Yoga or Breathing (15 mins)"]
    ]
  },

  obese3: {
    category: "Obese (Class III)",
    types: ["Chair Yoga", "Very Light Movement"],
    examples: [
      "Gentle Morning Stretch (10 mins)",
      "Chair Yoga (15 mins)",
      "Very Light Movement (10–15 mins)"
    ],
    plan: [
      ["Chair Yoga (15 mins)", "Seated March/Arm Raises (10 mins)"],
      ["Stretch (10 mins)", "Chair Yoga (15 mins)"],
      ["Very Light Movement (10 mins)", "Stretch (10 mins)"],
      ["Chair Yoga (15 mins)", "Leg Lifts (10 mins)"],
      ["Stretch (10 mins)", "Arm Extensions (10 mins)"],
      ["Chair Yoga (15 mins)", "Breathing & Stretch (10 mins)"],
      ["Active Rest: Seated Relaxation (10 mins)"]
    ]
  }
};
