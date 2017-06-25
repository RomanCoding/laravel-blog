<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="(tag, index) in this.tags" @contextmenu="destroy(index)">
                {{ tag.name }}
                <span class="pull-right" @click="editTag(tag)">Edit</span>
            </li>
        </ul>
        <div class="form-group">
            <input v-model="newTag" type="text" class="form-control">
        </div>
        <div class="btn-group">
            <button class="btn btn-primary" @click="sendRequest" v-text="this.edit ? 'Update' : 'Add new tag'"></button>
            <button  class="btn btn-default" v-if="this.edit" @click="cancel">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                tags: this.data,
                newTag: '',
                edit: false,
            }
        },
        methods: {
            sendRequest() {
                this.edit ? this.update(this.edit) : this.create();
            },
            create() {
                axios.post('/tags', {name: this.newTag})
                    .then(({data}) => {
                        this.tags.push(data);
                    }, ((data) => {
                        this.newTag = 'Tag already exists!';
                    }));
            },
            cancel() {
                this.edit = false;
                this.newTag = '';
            },
            editTag(tag) {
                this.newTag = tag.name;
                this.edit = tag.id;
            },
            update(id) {
                axios.patch('/tags/' + id, {name: this.newTag})
                    .then(({data}) => {
                        let i = this.tags.map(item => item.id).indexOf(id);
                        this.tags[i].name = this.newTag;
                        this.clear();
                    });
            },
            destroy(id) {
                axios.delete('/tags/' + id)
                    .then(() => {
                        this.tags.splice(id, 1);
                    });
            },
            clear() {
                this.edit = false;
                this.newTag = '';
            }
        }
    }
</script>
