/*Programmer Name: YEO PEI WEN (TP077057), SIM TIAN (TP077056)
Program Name: W.progress.js
Description: Result for workout progress page
First Written on: Saturday, 21-June-2025
Edited on: 08-JULY-2025*/

window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    navbar.style.background = window.scrollY > 50
      ? 'rgba(255, 255, 255, 0.98)'
      : 'rgba(255, 255, 255, 0.95)';
  }
});

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

function getRandomColor() {
  const colors = [
    '#8D7151', '#CCD2CC', '#B1ACB3', '#B1ACB3',
    '#BECBD3', '#B87F78', '#D7CDD5', '#A392A2'
  ];
  return colors[Math.floor(Math.random() * colors.length)];
}

document.addEventListener("DOMContentLoaded", () => {
  fetch("W.getProgress.php")
    .then(res => res.json())
    .then(data => {
      if (!data.success) {
        document.getElementById("progressTable").innerHTML = "<p>Failed to load workout data.</p>";
        return;
      }

      const workoutLog = data.log;

      // 1. Group logs by date and workout type
      const grouped = {};
      const allActivities = new Set();

      workoutLog.forEach(log => {
        const dateLabel = new Date(log.date).toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric'
        });

        if (!grouped[dateLabel]) grouped[dateLabel] = {};
        grouped[dateLabel][log.workout] = log.duration > 0 ? log.duration : 20;
        allActivities.add(log.workout);
      });

      // 2. Sorted date labels
      const labels = Object.keys(grouped).sort((a, b) => {
        const ad = new Date(`${a}, 2024`);
        const bd = new Date(`${b}, 2024`);
        return ad - bd;
      });

      // 3. Create datasets (one per workout type)
      const datasets = Array.from(allActivities).map(workout => ({
        label: workout,
        data: labels.map(date => grouped[date][workout] || 0),
        backgroundColor: getRandomColor(),
        categoryPercentage: 0.8, // width of entire category
        barPercentage: 0.9       // space between bars in same category
      }));

      // 4. Render chart
      const ctx = document.getElementById('progressChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: datasets
        },
        options: {
          responsive: true,
          plugins: {
            title: {
              display: true,
              text: 'Workout Progress (Grouped by Day)'
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Minutes'
              }
            }
          }
        }
      });

      // 5. Populate table
      const tbody = document.querySelector('#progressTable tbody');
      workoutLog.forEach(log => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${log.date}</td>
          <td>${log.workout}</td>
          <td class="status-done">✅ Done</td>
        `;
        tbody.appendChild(row);
      });
    })
    .catch(err => {
      console.error("Failed to fetch workout log:", err);
      document.getElementById("progressTable").innerHTML = "<p>Error loading workout progress.</p>";
    });
});
