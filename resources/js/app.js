import './bootstrap';
import Alpine from 'alpinejs';
import mensalidadeChart from './charts/mensalidadeChart';
import aulasChart from './charts/aulasChart';
import dashboardLogic from './dashboard/dashboardLogic';

//registra os charts
Alpine.data('mensalidadeChart', mensalidadeChart);
Alpine.data('aulasChart', aulasChart);
Alpine.data('dashboardLogic', dashboardLogic);

//expoe a instância do framework no objeto global do navegador
window.Alpine = Alpine;

Alpine.start();