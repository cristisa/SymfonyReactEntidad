import React from 'react';
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import RecetaList from "./pages/RecetaList";
import RecetaCreate from "./pages/RecetaCreate";
import RecetaEdit from "./pages/RecetaEdit";
import RecetaShow from "./pages/RecetaShow";

import './styles/app.css';
import './styles/app.scss';

    
function Main() {
    return (
        <Router>
            <Routes>
                <Route exact path="/"  element={<RecetaList/>} />
                <Route path="/create"  element={<RecetaCreate/>} />
                <Route path="/edit/:id"  element={<RecetaEdit/>} />
                <Route path="/show/:id"  element={<RecetaShow/>} />
            </Routes>
        </Router>
    );
}
    
export default Main;
    
if (document.getElementById('app')) {
    const rootElement = document.getElementById("app");
    const root = createRoot(rootElement);
  
    root.render(
        <StrictMode>
            <Main />
        </StrictMode>
    );
}