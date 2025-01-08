import React from "react";
import ReactDOM from "react-dom";
import Dashboard from "./components/Dashboard";
import './bootstrap';
import '../css/app.css';



if (document.getElementById("react-root")) {
    ReactDOM.render(<Dashboard />, document.getElementById("react-root"));
}
