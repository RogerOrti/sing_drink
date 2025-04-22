<template>
    <div class="chart-container">
        <h2>Nombre de locals per tipus</h2>
        <canvas id="localesChart"></canvas>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            locals: [],
            tipuslocals: [],
            chart: null
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        async getData() {
            try {
                const [localsRes, tipusRes] = await Promise.all([
                    axios.get('locals'),
                    axios.get('tipusLocal')
                ]);
                this.locals = localsRes.data;
                this.tipuslocals = tipusRes.data;
                this.renderChart();
            } catch (error) {
                console.error('Error al obtenir dades:', error);
            }
        },
        renderChart() {
            const ctx = document.getElementById('localesChart');
            if (!ctx) return;

            const tipusCount = {};
            this.tipuslocals.forEach(t => {
                tipusCount[t.tipo_local] = 0;
            });

            this.locals.forEach(local => {
                const tipus = this.tipuslocals.find(t => t.id_tipo_local === local.id_tipo_local);
                if (tipus) {
                    tipusCount[tipus.tipo_local]++;
                }
            });

            const labels = Object.keys(tipusCount);
            const data = Object.values(tipusCount);

            if (this.chart) this.chart.destroy();

            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tipus de locals',
                        data: data,
                        backgroundColor: '#EEC765',
                        borderColor: '#EEC765',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
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
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 3rem;
    margin-top: 3rem;
    font-family: 'Arial', sans-serif;
    font-weight: bold;
    text-transform: uppercase;
    color: #ffffff;
    font-size: 3rem;
}
</style>
