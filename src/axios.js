import axios from 'axios';

export default axios.create({
  baseURL: 'http://localhost:8000/api', // Laravel backend API
  headers: {
    'Content-Type': 'application/json',
  }
});
