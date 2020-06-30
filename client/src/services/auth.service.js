import axios from 'axios';
const API_URL = 'http://localhost:8000/dev/auth/';

class AuthService {
    login(user) {
        return axios.post(API_URL + 'login', {
            email: user.email,
            password: user.password
        }).then(res => {
            if (res.data.access_token) {
                //change to cookie
                console.log(JSON.stringify(res.data));
                localStorage.setItem('user', JSON.stringify(res.data));
            }
            return res.data;
        });
    }

    logout() {
        localStorage.removeItem('user');
    }

    register(user) {
        return axios.post(API_URL + 'register', {
            name: user.name,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation
        }).then(res => {
            console.log(res.data);
            return res.data;
        });
    }
}

export default new AuthService();