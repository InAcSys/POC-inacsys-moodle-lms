import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "./index.css";
import App from "./App.tsx";
import Menu from "./components/Menu.tsx";
import { BrowserRouter } from "react-router-dom";

createRoot(document.getElementById("root")!).render(
  <StrictMode>
    <Menu />
    <BrowserRouter>
      <App />
    </BrowserRouter>
  </StrictMode>
);
