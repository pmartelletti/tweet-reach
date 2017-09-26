<template>
    <div class="">
        <form class="form" @submit.prevent="submitForm">
            <div class="alert alert-danger" v-if="form.errors">
                {{ form.errors }}
            </div>
            <div class="input-group">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="form.tweet_url" placeholder="Tweet URL">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-info"
                                @click.prevent="submitForm"
                                :disabled="form.loading">
                            Calculate Reach!
                        </button>
                    </div><!-- /btn-group -->
                </div><!-- /input-group -->
            </div>
        </form>
        <div class="tweet-reach" v-if="tweet_reach">
            This tweet can reach <strong>{{ tweet_reach }}</strong> users!
        </div>
    </div>
</template>

<style>
    input[type="text"] {
        font-size: 20px;
        width: 650px !important;
        height: 60px;
    }
    button[type="button"] {
        height: 60px;
        font-size: 18px;
    }
    .tweet-reach {
        font-size: 25px;
        margin-top: 15px;
    }
</style>

<script>
    export default {
        data () {
            return {
                form: {
                    errors: null,
                    loading: false,
                    tweet_url: ''
                },
                tweet_reach: null
            }
        },
        methods: {
            submitForm() {
                this.cleanForm()
                axios.get('/api/tweet-reach', {params: {'url': this.form.tweet_url}})
                    .then(response => this.onSuccess(response))
                    .catch(response => this.onError(response))
            },
            cleanForm() {
                this.tweet_reach = null
                this.form.loading = true
                this.form.errors = null
            },
            onError(response) {
                this.form.loading = false
                this.form.errors = response.response.data.message
            },
            onSuccess(response) {
                this.form.loading = false
                this.tweet_reach = response.data;
            }
        }
    }
</script>
