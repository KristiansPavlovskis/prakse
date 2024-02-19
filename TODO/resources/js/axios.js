// axios.js

import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://localhost', // Adjust base URL as needed
  withCredentials: true,
});

// Add a request interceptor to include the authorization token in all requests
instance.interceptors.request.use(
  (config) => {
    const authToken = localStorage.getItem('authToken');
    if (authToken) {
      config.headers.Authorization = `Bearer ${authToken}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default instance;
