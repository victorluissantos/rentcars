import React from 'react';
import VehicleList from './components/VehicleList'; // Importando o componente
import logo from './logo.svg';
import './App.css';


function App() {
  return (
    <div className="App">
      <h1>Bem-vindo à RentCars</h1>
      <VehicleList />  {/* Usando o componente VehicleList */}
    </div>
  );
}

export default App;
