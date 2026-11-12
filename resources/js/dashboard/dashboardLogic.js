
export default function dashboardLogic() {
    return {
        selectedPeriod: 'month',

        baseMetrics: [
            {
                label: window.traducoes.alunosAtivos,
                value: '248',
            },
            {
                label: window.traducoes.receitames,
                value: 'R$ 32.480',
            },
            {
                label: window.traducoes.aulasRe,
                value: '186',
            },
            {
                label: window.traducoes.taxaP,
                value: '92,4%',
            }
        ],

        periods: {
            today: {
                label: window.traducoes.hoje,
                values: ['2', 'R$ 1.285', '12', '94,8%'],
            },
            week: {
                label: window.traducoes.ulS,
                values: ['28', 'R$ 8.960', '46', '93,1%'],
            },
            month: {
                label: window.traducoes.ulMes,
                values: ['248', 'R$ 32.480', '186', '92,4%'],
            },
            year: {
                label: window.traducoes.ulA,
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
                    ? window.traducoes.receita
                    : metric.label,
                value: this.period.values[index],
                change: this.period.change,
                detail: this.period.detail
            }));
        },
    };
}
