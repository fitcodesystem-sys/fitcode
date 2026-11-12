
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

export default function aulasChart() {
        let chart = null;

    return {
        modalitiesPeriod: {
            today: [
                { name: window.traducoes.mus, value: 30 },
                { name: window.traducoes.funcional, value: 15 },
                { name: 'Pilates', value: 10 },
                { name: 'Hit', value: 5 },               
            ],

            week: [
                { name: window.traducoes.mus, value: 120 },
                { name: window.traducoes.funcional, value: 80 },
                { name: 'Pilates', value: 60 },
                { name: 'Hit', value: 10 },
            ],

            month: [
                { name: window.traducoes.mus, value: 300 },
                { name: window.traducoes.funcional, value: 180 },
                { name: 'Pilates', value: 150 },
                { name: 'Hit', value: 120 },
            ],

            year: [
                { name: window.traducoes.mus, value: 850 },
                { name: window.traducoes.funcional, value: 500 },
                { name: 'Pilates', value: 400 },
                { name: 'Hit', value: 200 },
            ],
        },
        init() {

            this.createChart();

            //observa a mudança de periodo
            this.$watch('selectedPeriod', (period) => {
                this.updateChart(period);
            });
        },

        createChart(){
            const modalities = this.modalitiesPeriod[this.selectedPeriod];

            chart = new Chart(this.$refs.canvas, {
                type: 'bar',
                data: {
                    labels: modalities.map(({ name }) => name),
                    datasets: [{
                        label: window.traducoes.alunos,
                        data: modalities.map(({ value }) => value),
                        }
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                },
            });
        },

        updateChart(period) {
            const modalities = this.modalitiesPeriod[period];

            if (!modalities || !chart) return;

            chart.data.labels = modalities.map(({ name }) => name);
            chart.data.datasets[0].data = modalities.map(({ value }) => value);
            chart.update();
        },

        destroy() {
            chart?.destroy();
            chart = null;
        },
    };
}
