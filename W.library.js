/*Programmer Name: YEO PEI WEN (TP077057)
Program Name: W.library.js
Description: Library for workout page
First Written on: Thursday, 19-June-2025
Edited on: 08-JULY-2025*/

//Scroll navigation effect//
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  navbar.style.background = window.scrollY > 50
    ? 'rgba(255, 255, 255, 0.98)'
    : 'rgba(255, 255, 255, 0.95)';
});

// Animate feature cards on scroll
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = 1;
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.feature-card').forEach(card => {
  card.style.opacity = 0;
  card.style.transform = 'translateY(30px)';
  card.style.transition = 'all 0.6s ease';
  observer.observe(card);
});

// --- Workout Data + Render Function ---
const workouts = [
  {
    id: 1,
    title: "Full Body Strength Builder",
    type: "Strength Training",
    level: "Intermediate",
    duration: "10 minutes",
    description: "Build lean muscle with this full-body strength workout using dumbbells and bodyweight exercises.",
    videoUrl: "https://www.youtube.com/watch?v=UoC_O3HzsH0",
    icon: "💪"
  },
  {
    id: 2,
    title: "Full Body Strength Builder",
    type: "Strength Training",
    level: "Intermediate",
    duration: "30 minutes",
    description: "Build lean muscle with this full-body strength workout using dumbbells and bodyweight exercises.",
    videoUrl: "https://www.youtube.com/watch?v=YYgYRSkFoJs&ab_channel=MadFit",
    icon: "💪"
  },
  {
    id: 3,
    title: "Beginner’s Strength Journey",
    type: "Strength Training",
    level: "Beginner",
    duration: "30 minutes",
    description: "Build lean muscle with this full-body strength workout using dumbbells and bodyweight exercises.",
    videoUrl: "https://www.youtube.com/watch?v=t4MJ8vHjc5s&ab_channel=TracySteen",
    icon: "💪"
  },
  {
    id: 4,
    title: "Modified Strength",
    type: "Strength Training",
    level: "Beginner",
    duration: "30 minutes",
    description: "Build lean muscle with this full-body strength workout using dumbbells and bodyweight exercises.",
    videoUrl: "https://www.youtube.com/watch?v=RPi9aJGuRDM&ab_channel=HASfit",
    icon: "💪"
  },
  {
    id: 5,
    title: "HIIT Fat Burner",
    type: "HIIT",
    level: "Advanced",
    duration: "30 minutes",
    description: "High-intensity intervals to maximize calorie burn and boost metabolism.",
    videoUrl: "https://www.youtube.com/watch?v=ml6cT4AZdqI",
    icon: "🔥"
  },
  {
    id: 6,
    title: "HIIT Fat Burner",
    type: "HIIT",
    level: "Intermediate-Advanced",
    duration: "20 minutes",
    description: "High-intensity intervals to maximize calorie burn and boost metabolism.",
    videoUrl: "https://www.youtube.com/watch?v=tKu6oA33f34&ab_channel=growingannanas",
    icon: "🔥"
  },
  {
    id: 7,
    title: "Quick HIIT Express",
    type: "HIIT",
    level: "Intermediate",
    duration: "20 minutes",
    description: "High-intensity intervals to maximize calorie burn and boost metabolism.",
    videoUrl: "https://www.youtube.com/watch?v=ml6cT4AZdqI&ab_channel=SELF",
    icon: "🔥"
  },
  {
    id: 8,
    title: "Cardio Dance Party",
    type: "Dance",
    level: "Beginner",
    duration: "30 minutes",
    description: "Fun dance workout to get your heart pumping and body moving.",
    videoUrl: "https://www.youtube.com/watch?v=ZWk19OVon2k",
    icon: "💃"
  },
  {
    id: 9,
    title: "Morning Yoga Flow",
    type: "Yoga",
    level: "Beginner",
    duration: "20 minutes",
    description: "Gentle stretches and mindful movement to energize your morning.",
    videoUrl: "https://www.youtube.com/watch?v=v7AYKMP6rOE",
    icon: "🧘"
  },
  {
    id: 10,
    title: "Morning Yoga Flow",
    type: "Yoga",
    level: "Beginner",
    duration: "20 minutes",
    description: "Gentle stretches and mindful movement to energize your morning.",
    videoUrl: "https://www.youtube.com/watch?v=Qi4jvLqsIrU&ab_channel=YogawithKassandra",
    icon: "🧘"
  },
  {
    id: 11,
    title: "Gentle Morning Stretch",
    type: "Yoga",
    level: "Beginner",
    duration: "15 minutes",
    description: "Gentle stretches and mindful movement to energize your morning.",
    videoUrl: "https://www.youtube.com/watch?v=Y8vJqiePu1I&ab_channel=YogawithKassandra",
    icon: "🧘"
  },
  {
    id: 12,
    title: "Pilates",
    type: "Pilates / Core",
    level: "Beginner",
    duration: "20 minutes",
    description: "Control movements that strengthen your abs, improve posture, and enhance overall stability.",
    videoUrl: "https://www.youtube.com/watch?v=YYgYRSkFoJs&ab_channel=MadFit",
    icon: "🤸"
  },
  {
    id: 13,
    title: "Core Pilates Power",
    type: "Pilates / Core",
    level: "Intermediate",
    duration: "30 minutes",
    description: "Control movements that strengthen your abs, improve posture, and enhance overall stability.",
    videoUrl: "https://www.youtube.com/watch?v=U5LwQW_IQOc&ab_channel=MoveWithNicole",
    icon: "🤸"
  },
  {
    id: 14,
    title: "Cardio Dance Party",
    type: "Cardio",
    level: "Beginner",
    duration: "30 minutes",
    description: "Get your heart rate up, burn calories, and improve endurance through continuous, rhythmic movements.",
    videoUrl: "https://www.youtube.com/watch?v=StmyxV5Z5lA&ab_channel=CARDIODANCEWITHCLAU%26PATY",
    icon: "🏃"
  },
  {
    id: 15,
    title: "Low-impact Cardio",
    type: "Cardio",
    level: "Beginner",
    duration: "30 minutes",
    description: "Get your heart rate up, burn calories, and improve endurance through continuous, rhythmic movements.",
    videoUrl: "https://www.youtube.com/watch?v=50kH47ZztHs&ab_channel=BodyProject",
    icon: "🏃"
  },
  {
    id: 16,
    title: "Light Cardio",
    type: "Cardio",
    level: "Beginner",
    duration: "20 minutes",
    description: "Get your heart rate up, burn calories, and improve endurance through continuous, rhythmic movements.",
    videoUrl: "https://www.youtube.com/watch?v=kHx-PyUWF5w&ab_channel=ImprovedHealth",
    icon: "🏃"
  },
  {
    id: 17,
    title: "Chair Yoga",
    type: "Chair/Seated",
    level: "Beginner",
    duration: "15 minutes",
    description: "Low-impact exercises done while sitting or using a chair for support, ideal for improving mobility, strength, and circulation with minimal strain.",
    videoUrl: "https://www.youtube.com/watch?v=XtsHaCco6Oc&ab_channel=CharlieFollows",
    icon: "🪑"
  },
  {
    id: 18,
    title: "Very Light Movement",
    type: "Chair/Seated",
    level: "Beginner",
    duration: "10-15 minutes",
    description: "Low-impact exercises done while sitting or using a chair for support, ideal for improving mobility, strength, and circulation with minimal strain.",
    videoUrl: "https://www.youtube.com/watch?v=zLer5A9LgMs&ab_channel=YogawithKassandra",
    icon: "🪑"
  }
];

function renderWorkouts() {
  const grid = document.getElementById('workoutLibrary');
  if (!grid) return;

  grid.innerHTML = workouts.map(workout => `
    <div class="workout-card feature-card">
      <div class="workout-thumbnail">
        <div class="workout-type">${workout.type}</div>
        <span>${workout.icon}</span>
      </div>
      <div class="workout-info">
        <h3 class="workout-title">${workout.title}</h3>
        <div class="workout-details">
          <div class="detail-item">
            <span>📊</span>
            <span class="level">${workout.level}</span>
          </div>
          <div class="detail-item">
            <span>⏱️</span>
            <span class="duration">${workout.duration}</span>
          </div>
        </div>
        <p class="workout-description">${workout.description}</p>
        <a href="${workout.videoUrl}" class="video-link" target="_blank">
          <span class="play-icon">▶</span>
          Watch Video
        </a>
      </div>
    </div>
  `).join('');

  // Apply observer again to the new cards
  document.querySelectorAll('.feature-card').forEach(card => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
  });
}

// Render on load
document.addEventListener("DOMContentLoaded", renderWorkouts);
