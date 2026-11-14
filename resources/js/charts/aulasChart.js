import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

export default function aulasChart() {
    let chart = null;

    return {
        init() {
            this.createChart();

            this.$watch('selectedPeriod', (period) => {
                this.updateChart(period);
            });
        },

        createChart() {
            chart = new Chart(this.$refs.canvas, {
                type: 'bar',

                data: {
                    labels: window.dadosAulas.labels,

                    datasets: [{
                        label: window.traducoes.alunos,
                        data: window.dadosAulas.dados,
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                },
            });
        },

        updateChart(period) {
            //
        },

        destroy() {
            chart?.destroy();
            chart = null;
        },
    };
}