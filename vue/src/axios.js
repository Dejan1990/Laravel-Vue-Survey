import axios from "axios";
import store from "./store";
import { useRouter } from 'vue-router'

const axiosClient = axios.create({
  baseURL: 'http://localhost:8000/api'
})

axiosClient.interceptors.request.use(config => {
  config.headers.Authorization = `Bearer ${store.state.user.token}`
  return config;
})

axiosClient.interceptors.response.use(response => {
  return response;
}, error => {
  if (error.response.status === 401) {
    const router = useRouter();
    sessionStorage.removeItem('TOKEN')
    router.push({name: 'Login'})
  }
  return error;
})

export default axiosClient;