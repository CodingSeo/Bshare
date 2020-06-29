import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'http://localhost:8000/dev/api/';
//geting userservice
class UserService {
    getAdminBoard() {
        return axios.get(API_URL + 'admin', {
            headers: authHeader()
        });
    }
    savePost(post) {
        return axios.post(API_URL + "posts", {
            title: post.title,
            body: post.body,
            category_id: post.category_id
        }, {
            headers: authHeader()
        });
    }
}

export default new UserService();