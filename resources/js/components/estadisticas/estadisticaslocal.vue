<template>
    <div class="chart-container">
      <h2>Locals registrats</h2>
      <canvas id="localesChart"></canvas>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        locales: [],
        chart: null
      };
    },
    mounted() {
      this.getLocales();
    },
    methods: {
      getLocales() {
        axios.get('locals')
          .then(response => {
            this.locales = response.data;
            this.renderChart();
          })
          .catch(error => {
            console.error('Error al obtener locales:', error);
          });
      },
      renderChart() {
        const ctx = document.getElementById('localesChart');
        if (!ctx) return;
  
        const labels = this.locales.map(local => local.nom_local);
        const data = labels.map(() => 1);
  
        const colores = [
          '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
          '#9966FF', '#FF9F40', '#8B8B8B', '#00A896',
          '#F67280', '#C06C84', '#6C5B7B', '#355C7D',
          '#E84A5F', '#2A363B', '#FF847C'
        ];
  
        if (this.chart) {
          this.chart.destroy();
        }
  
        this.chart = new Chart(ctx, {
          type: 'polarArea',
          data: {
            labels: labels,
            datasets: [{
              label: 'Locales',
              data: data,
              backgroundColor: colores.slice(0, data.length),
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'right'
              },
              tooltip: {
                callbacks: {
                  label: (tooltipItem) => {
                    return `${tooltipItem.label}: 1 local`;
                  }
                }
              }
            }
          }
        });
      }
    },
    beforeUnmount() {
      if (this.chart) {
        this.chart.destroy();
      }
    }
  };
  </script>
  
  <style scoped>
  .chart-container {
    width: 100%;
    max-width: 600px;
    margin: auto;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }
  h2 {
    text-align: center;
    margin-bottom: 1rem;
    margin-top: 3rem;
    font-family: 'Arial', sans-serif;
    font-weight: bold;
    text-transform: uppercase;
    color: #ffffff;
    font-size: 3rem;
  }
  </style>
  