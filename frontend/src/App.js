import React, { useState } from 'react';
import axios from 'axios';
import './App.css';

function App() {
  const [amount, setAmount] = useState('');
  const [currencyFrom, setCurrencyFrom] = useState('USD');
  const [currencyTo, setCurrencyTo] = useState('BRL');
  const [convertedAmount, setConvertedAmount] = useState(null);
  const [error, setError] = useState('');

  const handleAmountChange = (e) => {
    setAmount(e.target.value);
  };

  const handleConvert = async () => {
    if (!amount || isNaN(amount) || amount <= 0) {
      setError('Por favor, insira um valor válido.');
      return;
    }
  
    setError('');
    setConvertedAmount(null);
  
    try {
      const response = await axios.post('http://localhost/conversion/backend/api.php', {
        amount,
        currencyFrom,
        currencyTo
      });
  
      if (response.data.success) {
        setConvertedAmount(response.data.convertedAmount);

        const dbResponse = await axios.post('http://localhost/conversion/backend/db.php', {
          amount,
          currencyFrom,
          currencyTo,
          convertedAmount: response.data.convertedAmount
        });

        if (!dbResponse.data.success) {
          setError('Error saving data to database.');
        }
      } else {
        setError(response.data.message || 'Error converting currency.');
      }
    } catch (error) {
      console.error(error);
      setError('Error connecting to PHP server.');
    }
  };

  return (
    <div className="App">
      <h1 className="text-center text-primary">Currency Converter</h1>
      <div className="form-container">
        <div className="mb-3">
          <label htmlFor="amount" className="form-label">Value:</label>
          <input
            type="number"
            className="form-control"
            id="amount"
            value={amount}
            onChange={handleAmountChange}
            placeholder="Digite o valor"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="currencyFrom">Of:</label>
          <select
            id="currencyFrom"
            value={currencyFrom}
            onChange={(e) => setCurrencyFrom(e.target.value)}
          >
            <option value="USD">USD (Dólar)</option>
            <option value="BRL">BRL (Real)</option>
            <option value="EUR">EUR (Euro)</option>
            <option value="GBP">GBP (Libra)</option>
            <option value="CNY">CNY (Yuan Chinês)</option>
            <option value="JPY">JPY (Yene Japonês)</option>
            <option value="BTC">BTC (Bitcoin)</option>
          </select>
        </div>

        <div className="mb-3">
          <label htmlFor="currencyTo">To:</label>
          <select
            id="currencyTo"
            value={currencyTo}
            onChange={(e) => setCurrencyTo(e.target.value)}
          >
            <option value="USD">USD (Dólar)</option>
            <option value="BRL">BRL (Real)</option>
            <option value="EUR">EUR (Euro)</option>
            <option value="GBP">GBP (Libra)</option>
            <option value="CNY">CNY (Yuan Chinês)</option>
            <option value="JPY">JPY (Yene Japonês)</option>
            <option value="BTC">BTC (Bitcoin)</option>
          </select>
        </div>

        <button onClick={handleConvert} className="btn btn-success" >Convert</button>

        {error && <div className="error">{error}</div>}

        {convertedAmount !== null && (
          <div className="result">
            <h3>Converted Value:</h3>
            <p>{convertedAmount.toFixed(2)} {currencyTo}</p>
          </div>
        )}
      </div>
    </div>
  );
}

export default App;