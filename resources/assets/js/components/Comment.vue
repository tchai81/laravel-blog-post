<template>
  <section>
    <div class="card my-4">
      <h5 class="card-header">Leave a Comment:</h5>
      <div class="card-body">
        <form>
          <div class="form-group">
            <textarea v-model="body" class="form-control" rows="3"></textarea>
            <small class="text-danger">{{ error }}</small>
          </div>
          <button @click.prevent="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <div v-if="comments.length === 0">Be the first who comment.</div>
    <div :key="comment.id" class="media mb-4" v-for="comment in comments">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <ul class="list-inline">
          <li class="list-inline-item">
            <h5 class="mt-0">{{ comment['author'] }}</h5>
          </li>
          <li class="list-inline-item" v-if="comment['dateDiff']">
            <small class="text-muted">{{ comment['dateDiff'] }} ago</small>
          </li>
        </ul>
        {{ comment['body'] }}
      </div>
    </div>
  </section>
</template>

<script>
// please note that all static text here is not "localized"
export default {
  props: ['blogPostId'],
  data() {
    return {
      error: null,
      body: null,
      comments: []
    }
  },
  mounted() {
    // get comments when the component is first loaded
    this.getCommentsByBlogPostId(this.blogPostId)
  },
  methods: {
    // handle form submission
    submit() {
      // hide all errors
      this.error = null
      // saving of a comment via ajax call
      axios
        .post('/api/comment', {
          body: this.body,
          blog_post_id: this.blogPostId
        })
        .then(response => {
          // upon saving of comments, get all comments to refresh the list
          this.getCommentsByBlogPostId(this.blogPostId)
        })
        .catch(ex => {
          // show errors if any
          this.error = ex.response.data.message
        })
        .then(() => {
          // always empty the comment input after operation
          this.body = null
        })
    },
    getCommentsByBlogPostId(blogPostId) {
      // get all comments by blog post id via ajax call
      axios.get(`/api/blog-post/${blogPostId}/comments`).then(response => {
        this.comments = response.data
      })
    }
  }
}
</script>