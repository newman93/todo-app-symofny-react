/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import React from 'react';
import { createRoot } from 'react-dom/client';

import { BrowserRouter as Router } from 'react-router-dom';
import App from './components/app.component';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
//import './bootstrap';
const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<Router><App /></Router>);
