// Chart.js: Simple weight chart
const ctx = document.getElementById('weightChart').getContext('2d');
const weightChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
      label: 'Weight (kg)',
      data: [55, 54.5, 54.8, 54.3, 54.2, 54.0, 53.9],
      borderColor: '#ff7043',
      borderWidth: 2,
      fill: false
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: { beginAtZero: false }
    }
  }
});

// Save body measurement (dummy function)
function saveMeasurements() {
  alert("Measurements saved! (you can enhance this to store data)");
}

// Save water and sleep log
function saveLog() {
  const water = document.getElementById("water").value;
  const sleep = document.getElementById("sleep").value;
  const report = document.getElementById("report");
  report.textContent = `💧 You drank ${water} cups of water & slept ${sleep} hours today!`;
}
function saveLog() {
  const water = document.getElementById("water").value;
  const sleep = document.getElementById("sleep").value;

  const formData = new FormData();
  formData.append("water", water);
  formData.append("sleep", sleep);

  fetch("sampleSave_log.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById("report").textContent = data;
  });
}
