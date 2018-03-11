<template>
        <div id="id01" :style="{ display: showModal}"  class="w3-modal">
            <div class="w3-modal-content" style="max-width: 600px;">
                <div class="w3-container">
                    <span @click="stateModal"
                          v-hotkey="keymap"
                          class="w3-button w3-display-topright">&times;</span>
                    <p>Do you want to delete {{user.name}}?</p>
                    <button @click="deleteUser" :disabled="loading" class="w3-button w3-block w3-black w3-section w3-padding" style="width:30%">Delete</button>
                </div>
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button  @click="stateModal" type="button"
                             :disabled="loading"
                             class="w3-button w3-red">Cancel
                    </button>
                </div>
            </div>
        </div>
</template>
<script>
    import {fetchUserActivity} from './../Ajax/getData'
    export default{
        props:['user'],
        data(){
            return{
                showModal: 'block',
                loading: false
            }
        },
        methods:{
            deleteUser(){
                var vm = this
                //api/user/{user}
                vm.loading = true
                var usr = vm.user
                axios.get(`/api/user/${vm.user.id}/${vm.user.firebase_uid}/${firebase.auth().currentUser.uid}`)
                    .then(function(response) {
                        console.log(response)
                    fetchUserActivity(response.data.activity)
                    vm.loading = false
                    new Noty({
                        timeout: 5000,
                        type: 'success',
                        layout: 'topRight',
                        text: response.data.message
                    }).show();

                        vm.$emit('deleteUser', vm.user)

                }).catch(function (error) {
                    vm.loading = false
                    if(error.response){
                        new Noty({
                            timeout: 5000,
                            type: 'error',
                            layout: 'topRight',
                            text:  error.response.statusText
                        }).show();
                    }
                });

            },
            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
                vm.$emit('close')
            }
        },
        computed:{
            keymap () {
                var vm = this
                return {
                    // bind to hotkey
                    'esc': vm.stateModal
                }
            }
        }
    }
</script>
