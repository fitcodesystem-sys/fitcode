
export default function dashboardLogic() {
    return {
        selectedPeriod: 'month',

        baseMetrics: [
            {
                label: 'Alunos ativos',
                value: '248',
            },
            {
                label: 'Receita mensal',
                value: 'R$ 32.480',
            },
            {
                label: 'Aulas realizadas',
                value: '186',
            },
            {
                label: 'Taxa de presença',
                value: '92,4%',
            }
        ],

        periods: {
            today: {
                label: 'Hoje',
                values: ['2', 'R$ 1.285', '12', '94,8%'],
            },
            week: {
                label: 'Últimos 7 dias',
                values: ['28', 'R$ 8.960', '46', '93,1%'],
            },
            month: {
                label: 'Último mês',
                values: ['248', 'R$ 32.480', '186', '92,4%'],
            },
            year: {
                label: 'Último ano',
                values: ['300', 'R$ 91.620', '524', '91,7%'],
            }
        },

        get period() {
            return this.periods[this.selectedPeriod];
        },

        //cria um array a partir de baseMetrics e period
        get metrics() {
            return this.baseMetrics.map((metric, index) => ({
                ...metric,
                label: index === 1
                    ? 'Receita no período'
                    : metric.label,
                value: this.period.values[index],
                change: this.period.change,
                detail: this.period.detail
            }));
        },
    };
}
