let copiedPlan = [];
const ctx  = document.getElementById('prodChart').getContext('2d');
const ctxd = document.getElementById('downChart').getContext('2d');

/* --- Chart definitions --------------------------------------------------- */
const chart = new Chart(ctx,  {
  type: 'bar',
  data: { labels: [], datasets: [{
      label: 'Production',
      data: [], backgroundColor: [], borderColor: 'rgba(75,192,192,1)', borderWidth: 1, barThickness: 25
  }]},
  options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

const chartd = new Chart(ctxd, {
  type: 'bar',
  data: { labels: [], datasets: [{
      label: 'Downtime', data: [], backgroundColor: 'rgba(200,0,0,.7)',
      borderColor: 'rgba(75,192,192,1)', borderWidth: 1
  }]},
  options: { scales: { y: { beginAtZero: true } } }
});

/* --- Helpers ------------------------------------------------------------- */
function colourBars(prod, plan) {
  return prod.map((v, i) => (+v >= +plan[i] ? 'rgba(0,200,0,.7)' : 'rgba(200,0,0,.7)'));
}

/* --- Data fetchers ------------------------------------------------------- */
function fetchPlan() {
  return fetch('getarrayplan.php')
    .then(r => r.json())
    .then(d => { copiedPlan = d.datas.map(Number); });
}

function fetchProd() {
  return fetch('data_prod_chart.php')
    .then(r => r.json())
    .then(d => {
      chart.data.labels = d.labels;
      chart.data.datasets[0].data = d.datas;
      chart.data.datasets[0].backgroundColor = colourBars(d.datas, copiedPlan);
      chart.update();
    });
}

function fetchDown() {
  return fetch('data_down_chart.php')
    .then(r => r.json())
    .then(d => {
      chartd.data.labels = d.labels;
      chartd.data.datasets[0].data = d.time_datas;
      chartd.update();
    });
}

/* --- Kick‑off ------------------------------------------------------------ */
fetchPlan()
  .then(() => {
    // draw once right away
    fetchProd(); fetchDown();

    // then update every 2 s
    setInterval(fetchProd, 2000);
    setInterval(fetchDown, 2000);
  })
  .catch(err => alert('Plan fetch failed: ' + err.message));