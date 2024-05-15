import './App.css';
import { useState, useEffect } from "react";
import axios from 'axios';
import React from 'react';

function App() {
  const [sensorData, setSensorData] = useState([]);

  useEffect(() => {
    // Function to fetch data from the server
    const fetchData = async () => {
      try {

        
        // const response = await axios.get("http://192.168.18.5:8000/api/datasensor");
        // const response = await axios.get("http://192.168.83.16:8000/api/datasensor");
        // const response = await axios.get("http://192.168.240.16:8000/api/datasensor");
        // const response = await axios.get("http://192.168.214.16:8000/api/datasensor");
        const response = await axios.get("http://192.168.199.16:8000/api/datasensor");
        console.log(response.data);

        // Assuming the data structure is { status, message, data }
        if (response.data.status) {
          setSensorData(response.data.data);
        } else {
          console.error(response.data.message);
        }
      } catch (error) {
        console.log(error);
      }
    };

    
    fetchData();

    const intervalId = setInterval(() => {
      fetchData();
    }, 1000);

    return () => clearInterval(intervalId);
  }, []);

  
  return (
    <div className="App" style={{ backgroundColor: '#EAEDED', minHeight: '100vh'}}>

      <h1>Room Monitoring Device</h1>

<br></br>

        {sensorData.map((data) => (
          <div key={data.id}>
                    
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card h-200">
      <div class="card-body" style={{ backgroundColor: '#73F1FF', border: '3px solid #000000', fontSize: '25px', fontFamily: 'Bangkokean Extra Bold, Monospace' }}>
      <img src="https://freesvg.org/img/1445945222.png" alt="Suhu" style={{width: '70px', height: 'auto'}}></img>
      {data.suhu} Celsius<br/><br/>
      <img src="https://freesvg.org/img/1588767826Tropfen.png" alt="Kelembapan" style={{width: '70px', height: 'auto'}}></img>
      {data.kelembapan}% Kelembaban<br/>
      </div>
    </div>
  </div>


  <div class="col">
    <div class="card h-300">
      <div class="card-body" style={{ backgroundColor: '#FFCB5E', border: '3px solid #000000', fontSize: '23px', fontFamily: 'Bangkokean Extra Bold, Monospace' }}>
      <img src="https://freesvg.org/img/zeimusu-Fire-Icon.png" alt="Api" style={{width: '110px', height: 'auto'}}></img>
<br></br>
      {Number(data.api) === 1 ? <span style={{ color: 'red' }}>FLAME DETECTED!</span> : 'Tidak Ada Api'}<br></br>
           Alarm : {Number(data.buzzer) === 1 ? <span style={{ color: 'red' }}>AKTIF!</span> : 'Mati'}<br></br>
      </div>
    </div>
  </div>
  </div>
  <br></br> 

  <div className="card text-center mb-3" style={{ backgroundColor: '#529DFF', border: '1px solid #000000', fontSize: '25px', fontFamily: 'Bangkokean Extra Bold, Monospace'  }}>
  <p className="card-text">
  <img src="https://freesvg.org/storage/img/thumb/internet-cloud.png" alt="Gas" style={{width: '100px', height: 'auto'}}></img>
        {Number(data.asap) === 1 ? 'TERDETEKSI GAS!' : 'Tidak Ada Gas Berbahaya'} <br></br>
  </p>
</div>
<br></br> 

<div className="card text-center mb-3" style={{ backgroundColor: '#7DFF69', border: '1px solid #000000', fontSize: '25px', fontFamily: 'Bangkokean Extra Bold, Monospace' }}>
  <p className="card-text">
  {Number(data.motion) === 1 ?  (
      <>
        <img src="https://freesvg.org/storage/img/thumb/1553972032.png" alt="Pintu Terbuka" style={{ width: '100px', height: 'auto' }}></img>
        Terdeteksi Orang!
      </>
    ) : (
      <>
        <img src="https://freesvg.org/img/1553971808.png" alt="Pintu Tertutup" style={{ width: '100px', height: 'auto' }}></img>
        Tidak ada Orang
      </>
    )}
  </p>
</div>
<br></br> 

           
<div className="card text-center mb-3" style={{ backgroundColor: '#EDBB99', border: '1px solid #000000', fontSize: '25px', fontFamily: 'Bangkokean Extra Bold, Monospace' }}>
  <p className="card-text">
  {Number(data.pintu) === 1 ?  (
      <>
        <img src="https://freesvg.org/storage/img/thumb/door.png" alt="Pintu Terbuka" style={{ width: '100px', height: 'auto' }}></img>
        <span style={{ color: 'red' }}>PINTU TERBUKA!</span>
      </>
    ) : (
      <>
        <img src="https://freesvg.org/storage/img/thumb/door-rg1024-Door-with-cristal-and-wall.png" alt="Pintu Tertutup" style={{ width: '100px', height: 'auto' }}></img>
        Pintu Tertutup
      </>
    )}
    <br></br>
  </p>
</div>
<br></br> 



</div>
        ))}
    </div>
  );
}

export default App;
