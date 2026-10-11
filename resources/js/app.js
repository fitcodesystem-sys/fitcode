import './bootstrap';
import Alpine from 'alpinejs';
import mensalidadeChart from './charts/mensalidadeChart';
import aulasChart from './charts/aulasChart';

Alpine.data('mensalidadeChart', mensalidadeChart);
Alpine.data('aulasChart', aulasChart);
window.Alpine = Alpine;

Alpine.start();