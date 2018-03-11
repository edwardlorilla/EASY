<template>
    <div v-if="user" class="w3-container w3-row">
        <div class="w3-col s4" v-if="user">
            <img v-if="user.photos" :src="'/thumb_' + user.photos[0]" class="w3-circle w3-margin-right" style="width:46px">
            <vue-initials-img v-else :name="user.name || 'admin'"/>
        </div>
        <div class="w3-col s8 w3-bar">
            <span>Welcome, <strong>{{user.name}}</strong></span><br>
            <a @click="currentView = 'message'" class="w3-bar-item w3-button"><i class="fa fa-envelope"/></a>
            <a @click="currentView = 'edit'" class="w3-bar-item w3-button"><i class="fa fa-user"/></a>
            <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"/></a>
        </div>
        <message v-if="currentView === 'message'" @close="currentView = '';"></message>
        <edit v-if="currentView == 'edit'" @close="currentView = ''; $emit('updateProfile', $event)" :user="user" />
    </div>
</template>
<style>

</style>
<script>
    import Edit from './User/edit.vue'
    import Message from './User/Message.vue'
    export default{
        props: ['user'],
        components:{
            Edit,
            Message
        },
        data(){
            return {
                currentView: ''
            }
        },
        methods:{
            updateUser(user){

            }
        }
    }
</script>
