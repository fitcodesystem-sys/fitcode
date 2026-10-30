import './bootstrap';
import Alpine from 'alpinejs';
import mensalidadeChart from './charts/mensalidadeChart';
import aulasChart from './charts/aulasChart';
import dashboardLogic from './dashboard/dashboardLogic';

Alpine.data('mensalidadeChart', mensalidadeChart);
Alpine.data('aulasChart', aulasChart);
Alpine.data('dashboardLogic', dashboardLogic);
window.Alpine = Alpine;

Alpine.start();