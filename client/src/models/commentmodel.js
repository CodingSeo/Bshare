export default class CommentModel {
    constructor(id, postid, body, user_id, parent_id=null) {
        this.id = id;
        this.postid=postid;
        this.body = body;
        this.user_id = user_id;
        this.parent_id = parent_id;
    }
}