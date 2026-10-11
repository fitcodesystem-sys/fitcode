
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

export default function aulasChart() {
    return {
        chart: null,

        init() {
            this.chart = new Chart(this.$refs.canvas, {
                type: 'bar',
                data: {
                    labels: ['Musculação','Funcional', 'Pilates', 'Hit',],
                    datasets: [{
                        label: 'Alunos',
                        data: [10, 10, 22, 20],
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

        destroy() {
            this.chart?.destroy();
        },
    };
}
