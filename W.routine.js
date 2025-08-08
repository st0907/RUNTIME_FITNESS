/*Programmer Name: YEO PEI WEN (TP077057), SIM TIAN (TP077057)
Program Name: W.routine.js
Description: Routine for workout page
First Written on: Sunday, 22-June-2025
Edited on: 08-JULY-2025*/

// Scroll navigation effect
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    navbar.style.background = window.scrollY > 50
      ? 'rgba(255, 255, 255, 0.98)'
      : 'rgba(255, 255, 255, 0.95)';
  }
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

// Show Workout Routine
document.addEventListener("DOMContentLoaded", () => {
  fetch("W.getWorkoutPlan.php")
    .then(res => res.json())
    .then(planData => {
      if (!planData.success) {
        document.getElementById("today-card").innerHTML = `<p>${planData.message}</p>`;
        return;
      }

      const rawPlan = planData.plan;
      const weekDaysOrder = [
        "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
      ];
      const plan = {};
      weekDaysOrder.forEach((day, i) => {
        plan[day] = rawPlan[i] || [];
      });

      // Fetch checkbox statuses
      fetch("W.R.getCheckbox.php")
        .then(res => res.json())
        .then(statusData => {
          const status = statusData.status_by_day || {};
          const today = new Date().toLocaleDateString('en-US', { weekday: 'long' });
          const todayContainer = document.getElementById("today-card");
          const otherContainer = document.getElementById("other-days");

          weekDaysOrder.forEach(day => {
            const card = document.createElement("div");
            card.className = "day-card";
            if (day === today) card.classList.add("highlight-today");

            const title = document.createElement("h2");
            title.textContent = day;
            card.appendChild(title);

            const list = document.createElement("ul");

            if (!plan[day] || plan[day].length === 0) {
              const li = document.createElement("li");
              li.textContent = "No workout assigned.";
              list.appendChild(li);
            } else {
              plan[day].forEach(item => {
                const li = document.createElement("li");
                const checkbox = document.createElement("input");
                const isToday = day === today;

                checkbox.type = "checkbox";
                checkbox.setAttribute("data-day", day);
                checkbox.setAttribute("data-item", item);

                // Disable if not today
                if (!isToday) {
                  checkbox.disabled = true;
                  checkbox.title = "You can only mark today’s workout.";
                }

                if (status[day] && status[day][item]) {
                  checkbox.checked = true;
                }

                checkbox.addEventListener("change", handleCheckboxChange);
                li.appendChild(checkbox);
                li.appendChild(document.createTextNode(" " + item));
                list.appendChild(li);
              });
            }

            card.appendChild(list);
            if (day === today) {
              todayContainer.appendChild(card);
            } else {
              otherContainer.appendChild(card);
            }
          });
        });
    })
    .catch(err => {
      console.error("Failed to load workout routine:", err);
      document.getElementById("today-card").innerHTML = "<p>Error loading workout routine.</p>";
    });
});

function handleCheckboxChange(e) {
  const checkbox = e.target;
  const day = checkbox.getAttribute("data-day");
  const item = checkbox.getAttribute("data-item");
  const checked = checkbox.checked;

  fetch("W.R.saveCheckbox.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      day: day,
      item: item,
      checked: checked
    })
  })
    .then(res => res.json())
    .then(data => {
      if (!data.success) console.error("Server error:", data.message);
    });
}
