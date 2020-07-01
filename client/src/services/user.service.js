
import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'api/';

//geting userservice
class UserService {
    savePost(post) {
        return axios.post(API_URL + "posts", {
            title: post.title,
            body: post.body,
            category_id: post.category_id
        }, {
            headers: authHeader()
        });
    }
    deletePost(post_id) {
        return axios.delete(API_URL + "posts/"+ post_id,{
            headers: authHeader()
        });
    }
    updatePost(post){
        return axios.post(API_URL + "posts/"+post.id, {
            _method:"PUT",
            title: post.title,
            body: post.body,
            category_id: post.category_id
        }, {
            headers: authHeader()
        });
    }
}

export default new UserService();