import React from "react";
import ReactDOM from "react-dom/client";

function App() {
    return (
        <h1 className="text-2xl text-center mt-10">
            Hello from React in Laravel!
        </h1>
    );
}

ReactDOM.createRoot(document.getElementById("app")).render(<App />);
