import "./bootstrap";
import alerts from './components/alerts';
import cards from './components/cards';
import carousel from './components/carousel';
import charts from './components/charts';
import ckeditor from './components/ckeditor';
import collapse from './components/collapse';
import customizer from './components/customizer';
import darkMode from './components/dark-mode';
import customFileInput from './components/file-input';
import fullscreen from './components/fullscreen';
import {menu, showActivePage} from './components/menu';
import modal from './components/modal';
import ratingStars from './components/rating-stars';
import showPassword from './components/show-password';
import sidebar from './components/sidebar';
import sortable from './components/sortable';
import tabs from './components/tabs';
import customTippy from './components/tippy';
import toasts from './components/toasts';

// import.meta.glob(["../images/**"]);

document.addEventListener('DOMContentLoaded', () => {
    alerts();
    cards();
    carousel();
    // charts();
    ckeditor();
    collapse();
    customizer();
    darkMode();
    customFileInput();
    fullscreen();
    menu();
    showActivePage();
    modal();
    ratingStars();
    showPassword();
    sidebar();
    sortable();
    tabs();
    customTippy();
    toasts();
})