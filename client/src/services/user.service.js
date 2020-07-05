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
    createComment(commentModel){
        return axios.post(API_URL + "comments/", {
            post_id: commentModel.postid,
            body: commentModel.body,
            user_id: commentModel.user_id,
            parent_id : commentModel.parent_id
        }, {
            headers: authHeader()
        });
    }
    deleteComment(commentID) {
        return axios.delete(API_URL + "comments/"+ commentID,{
            headers: authHeader()
        });
    }
    updatePost(commentModel){
        return axios.post(API_URL + "comments/"+commentModel.id, {
            _method:"PUT",
            post_id: commentModel.postid,
            body: commentModel.body,
            user_id: commentModel.user_id,
            parent_id : commentModel.parent_id
        }, {
            headers: authHeader()
        });
    }
}

export default new UserService();