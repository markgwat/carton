<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Run Collection</div>

                    <div class="panel-body">
                       Method: POST<br/>
                       Path: test/<br/>
                       Parameters: { "purchase_order_ids": [2344, 2345, 2346] }<br/>
                       Basic Auth: demo:pwd1234</br>
                      
                       <button :disabled="!sending" @click="attemptRun()" type="button" class="btn btn-primary">Send</button>
                    </div>
                    <div class="alert alert-success" v-if="ok">
                        <strong>Success!</strong> <br/>
                        <ul id="example-1">
                        <li v-for="item in items">
                           Product Type ID: {{ item.product_type_id }} --- 
                           Total:  {{ item.total }}
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
            ok: false,
            sending: true,
            items: [],
            }
        },
        methods: {
            attemptRun() {
            this.sending = false;
            var url = 'http://demo:pwd1234@'+window.location.hostname+'/test';
            axios.post(url, {
                purchase_order_ids: [2344, 2345, 2346],
                loading: false,
                errors: {},
                
            }).then(resp => {
                this.ok = true;
                this.sending = true;
                this.items = resp.data.result;
                console.log(resp.data.result);
            }).catch(error => {
                this.sending = true;
                if(error.response.status == 422)
                {
                this.errors.push('We couldn\'t verify your account details' )
                
                } else {``
                this.errors.push('Something went wrong' )

                }
                console.log(error)
            })
            
            }
      },
    }
</script>
