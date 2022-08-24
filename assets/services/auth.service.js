import axios from "axios";
const API_URL = "http://localhost:8000/api/";
class AuthService {
  login(username, password) {
    return axios
      .post(API_URL + "login_check", {
        username,
        password
      })
      .then(response => {
        if (response.data.token) {
          localStorage.setItem("user", '{"username" : '  + username + '" , "token" : ' +  response.data.token + '"}"');
        }
        return response.data;
      });
  }
  logout() {
    localStorage.removeItem("user");
  }
  register(username, email, password) {
    return axios.post(API_URL + "register", {
      username,
      email,
      password
    });
  }
  getCurrentUser() {
    return JSON.parse(localStorage.getItem('user'));;
  }
}
export default new AuthService();