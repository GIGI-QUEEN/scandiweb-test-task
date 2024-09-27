import axios from "axios";

export const axiosInstance = axios.create({
  //baseURL: "http://localhost:8080",
  baseURL: "http://217.146.79.199:8080",
  headers: {
    "Content-Type": "application/json",
  },
});
