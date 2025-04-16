<template>
    <div class="chart-container">
      <h2>Música per Estils</h2>
      <canvas id="musicChart"></canvas>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        musics: [],
        chart: null
      };
    },
    mounted() {
      this.fetchMusics();
    },
    methods: {
      fetchMusics() {
        axios.get('estilMusica')
          .then(response => {
            this.musics = response.data;
            this.renderChart();
          })
          .catch(error => {
            console.error('Error al obtener musics:', error);
          });
      },
      renderChart() {
        const conteoEstilos = {};
  
        this.musics.forEach(m => {
          const estil = m.estil_musica || 'Desconocido';
          conteoEstilos[estil] = (conteoEstilos[estil] || 0) + 1;
        });
  
        const data = {
          labels: Object.keys(conteoEstilos),
          datasets: [{
            label: 'Cantidad de música por estilo',
            data: Object.values(conteoEstilos),
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(75, 192, 192)',
              'rgb(255, 205, 86)',
              'rgb(201, 203, 207)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(255, 159, 64)'
            ]
          }]
        };
  
        const config = {
          type: 'polarArea',
          data: data,
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'right'
              }
            }
          }
        };
  
        const ctx = document.getElementById('musicChart');
        if (this.chart) this.chart.destroy();
        this.chart = new Chart(ctx, config);
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
  