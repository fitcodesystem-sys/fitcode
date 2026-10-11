
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

export default function mensalidadeChart() {
    return {
        chart: null,

        init() {
            this.chart = new Chart(this.$refs.canvas, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    datasets: [{
                        label: 'IAG',
                        data: [10, 10, 22, 20, 12, 32, 12, 24, 23, 42, 42, 43],
                    },
                    {
                        label: 'IAP',
                        data: [20, 10, 30, 20, 12, 32, 12, 24, 23, 42, 42, 43]
                    },
                    {
                        label: 'IC',
                        data: [30, 22, 32, 20, 12, 32, 12, 24, 23, 42, 42, 43]
                    }
                
                    
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });
        },

        destroy() {
            this.chart?.destroy();
        },
    };
}
