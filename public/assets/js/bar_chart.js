let copiedPlan = [];

/* --- Chart contexts ------------------------------------------------------ */
const ctx  = document.getElementById('prodChart').getContext('2d');
const ctxd = document.getElementById('downChart').getContext('2d');

/* --- Chart definitions --------------------------------------------------- */
const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      label: 'Production',
      data: [],
      backgroundColor: [],
      borderColor: 'rgba(75,192,192,1)',
      borderWidth: 1,
      barThickness: 25 // optional, can remove for auto
    }]
  },
  options: {
    responsive: true,
    scales: { 
      y: { beginAtZero: true } // ✅ Chart.js v3+
    }
  }
});

const chartd = new Chart(ctxd, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      label: 'Downtime',
      data: [],
      backgroundColor: 'rgba(200,0,0,.7)',
      borderColor: 'rgba(75,192,192,1)',
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: { 
      y: { beginAtZero: true }
    }
  }
});

/* --- Helpers ------------------------------------------------------------- */
function colourBars(prod, plan) {
  return prod.map((v, i) =>
    +v >= +(plan[i] ?? 0) ? 'rgba(0,200,0,.7)' : 'rgba(200,0,0,.7)'
  );
}

/* --- Data fetchers ------------------------------------------------------- */
function fetchPlan() {
  return fetch('../src/controller/getarrayplan.php')
    .then(r => r.json())
    .then(d => {
      if (!d.datas || !Array.isArray(d.datas)) {
        throw new Error("Invalid plan data");
      }
      copiedPlan = d.datas.map(Number);
    });
}

function fetchProd() {
  return fetch('../src/controller/data_prod_chart.php')
    .then(r => r.json())
    .then(d => {
      if (!Array.isArray(d.datas) || !Array.isArray(d.labels)) {
        throw new Error("Invalid prod data");
      }
      chart.data.labels = d.labels;
      chart.data.datasets[0].data = d.datas;
      chart.data.datasets[0].backgroundColor = colourBars(d.datas, copiedPlan);
      chart.update();
    })
    .catch(err => console.error("Prod fetch failed:", err));
}

function fetchDown() {
  return fetch('../src/controller/data_down_chart.php')
    .then(r => r.json())
    .then(d => {
      if (!Array.isArray(d.time_datas) || !Array.isArray(d.labels)) {
        throw new Error("Invalid down data");
      }
      chartd.data.labels = d.labels;
      chartd.data.datasets[0].data = d.time_datas;
      chartd.update();
    })
    .catch(err => console.error("Down fetch failed:", err));
}

/* --- Kick-off ------------------------------------------------------------ */
fetchPlan()
  .then(() => {
    // draw once right away
    return Promise.all([fetchProd(), fetchDown()]);
  })
  .then(() => {
    // then update every 2 s
    setInterval(fetchProd, 2000);
    setInterval(fetchDown, 2000);
  })
  .catch(err => alert('May error sa graph fetch failed: ' + err.message));
