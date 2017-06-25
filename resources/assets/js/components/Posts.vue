<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="(post, index) in this.posts" @contextmenu="destroy(index)">
                {{ post.title }}
                <span class="pull-right" @click="editPost(post)">Edit</span>
            </li>
        </ul>
        <div class="form-group">
            <input v-model="newPostTitle" type="text" class="form-control">
        </div>
        <div class="form-group">
            <textarea v-model="newPostBody" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <select v-model="newPostTag" class="form-control">
                <option v-for="tag in this.tags" :value="tag.id" v-text="tag.name"></option>
            </select>
        </div>
        <div class="btn-group">
            <button class="btn btn-primary" @click="sendRequest" v-text="this.edit ? 'Update' : 'Add new post'"></button>
            <button class="btn btn-default" v-if="this.edit" @click="cancel">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data', 'tags'],
        data() {
            return {
                posts: this.data,
                newPostBody: '',
                newPostTitle: '',
                newPostTag: null,
                edit: false,
            }
        },
        methods: {
            sendRequest() {
                this.edit ? this.update(this.edit) : this.create();
            },
            create() {
                axios.post('/posts', {body: this.newPostBody, title: this.newPostTitle, tag_id: this.newPostTag})
                    .then(({data}) => {
                        this.posts.push(data);
                        this.clear();
                    });
            },
            cancel() {
                this.edit = false;
                this.newPostTitle = '';
                this.newPostBody = '';
            },
            editPost(post) {
                this.newPostTitle = post.title;
                this.newPostBody = post.body;
                this.edit = post.id;
            },
            update(id) {
                axios.patch('/posts/' + id, {body: this.newPostBody, title: this.newPostTitle})
                    .then(({data}) => {
                        let i = this.posts.map(item => item.id).indexOf(id);
                        this.posts[i].title = this.newPostTitle;
                        this.posts[i].body = this.newPostBody;
                        this.clear();
                    });
            },
            destroy(id) {
                axios.delete('/posts/' + id)
                    .then(() => {
                        this.posts.splice(id, 1);
                    });
            },
            clear() {
                this.edit = false;
                this.newPostBody = '';
                this.newPostTitle = '';
            }
        }
    }
</script>
