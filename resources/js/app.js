import './bootstrap';
import '../css/app.css';
import '../css/synth-midnight-terminal-dark.min.css';
import highlight from 'highlight.js'
import {tableSearch} from '../js/searchCatalog.js';


window.tableSearch = tableSearch;
window.hljs = highlight;
hljs.highlightAll();
