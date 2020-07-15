import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'api/';

//geting userservice
class UserService {
    savePost(post, images_info = null) {
        return axios.post(API_URL + "posts", {
            title: post.title,
            body: post.body,
            category_id: post.category_id,
            images_info: images_info
        }, {
            headers: authHeader()
        });
    }
    deletePost(post_id) {
        return axios.delete(API_URL + "posts/" + post_id, {
            headers: authHeader()
        });
    }
    updatePost(post) {
        return axios.post(API_URL + "posts/" + post.id, {
            _method: "PUT",
            title: post.title,
            body: post.body,
            category_id: post.category_id
        }, {
            headers: authHeader()
        });
    }
    completePost(post_id) {
        return axios.post(API_URL + "posts/tradeInfo/" + post_id, {
            _method: "PUT",
            trade_status: "complete"
        }, {
            headers: authHeader()
        });
    }
    createComment(commentModel) {
        return axios.post(API_URL + "comments", {
            post_id: commentModel.postid,
            body: commentModel.body,
            user_id: commentModel.user_id,
            parent_id: commentModel.parent_id
        }, {
            headers: authHeader()
        });
    }
    deleteComment(commentID) {
        return axios.delete(API_URL + "comments/" + commentID, {
            headers: authHeader()
        });
    }
    updateComments(commentModel) {
        return axios.post(API_URL + "comments/" + commentModel.id, {
            _method: "PUT",
            post_id: commentModel.postid,
            body: commentModel.body,
            user_id: commentModel.user_id,
            parent_id: commentModel.parent_id
        }, {
            headers: authHeader()
        });
    }
    async uploadImage(imageFile) {
        var result = await axios.post(API_URL + "images",
            imageFile, {
                headers: authHeader()
            }).then(
            response => {
                return response.data;
            },
            error => {
                console.log(error.response);
                return [];
            }
        );;
        return result;
    }

}

export default new UserService();