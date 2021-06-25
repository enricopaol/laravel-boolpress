const { default: Axios } = require("axios")

var app = new Vue({
    el: '#root',
    data: {
        posts: []
    },   
    methods: {
        cutPostDescription(index) {
            let description = this.posts[index].content;
            return description.slice(0, 50);
        }
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/posts')
            .then(result => {
                this.posts = result.data.posts

                
                console.log(this.posts);
            })
    }
});