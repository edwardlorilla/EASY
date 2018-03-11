<template>
    <div class="chat">
        <div class="chat-header clearfix">

            <img v-if="getChatInfo.photos" :src="'/images/'+ getChatInfo.photos[0].file"
                 alt="avatar"/>
            <vue-initials-img v-else :name="getChatInfo.name || 'admin'"/>
            <div class="chat-about w3-right">
                <div class="chat-with">Chat with {{getChatInfo.name}}</div>
                <div class="chat-num-messages">already {{getStartIndex}} messages</div>
            </div>
            <i class="fa fa-star" @click="scrollToEnd"></i>
            <i @click="$emit('close')" class="fa fa-arrow-left" aria-hidden="true"></i>
        </div> <!-- end chat-header -->
        <div class="chat-history">
            <virtual-list :size="30" :remain="10">
                <div v-for="(send, index) in getChat"
                    :index="index"
                    :key="index"
                     class="container"
                    :class="send.from !== userId ? 'darker'  : ''">
                    <div class="message-data" :class="send.from !== userId ? 'align-right'  : ''">
                        <!--<span class="message-data-time">5:15 PM, Today</span> &nbsp; &nbsp;-->
                        <span class="message-data-name">{{getChatInfo.name}}</span> <i class="fa fa-circle me"></i>
                    </div>
                    <div class="message" :class="send.from !== userId ? 'other-message float-right'  : 'my-message'">{{send.message }}</div>
                </div>
            </virtual-list>
        </div> <!-- end chat-history -->

        <div class="footer chat-message clearfix">


            <form class="w3-container w3-card-4">
                <p>
                    <textarea
                            v-model="newMessage"
                            id="message-to-send" placeholder="Type your message"
                            class="w3-input w3-border" style="resize:none"></textarea>
                </p>
                <button type="button" @click="send" class="w3-btn w3-padding w3-teal" style="width:120px">Send &nbsp; &#10095;</button></p>
            </form>

        </div>
    </div>
</template>
<style scoped>
    .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .container::after {
        content: "";
        clear: both;
        display: table;
    }

    .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .container img.right {
        float: right;
        margin-left: 20px;
        margin-right:0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }
</style>
<script>
    import {userProfile} from './../Ajax/getData'
    export default{
        props: ['user'],
        computed: {
            getChatInfo(){
                var vm = this
                return !_.isEmpty(vm.user) ? vm.user : null
            },
            getChat(){
                var vm = this
                return !_.isEmpty(vm.messages) ? vm.messages : null
            },
            getStartIndex(){
                var vm = this
                return vm.messages.length
            }
        },
        mounted(){
            var vm = this

            vm.userId = vm.user.id.toString()


            vm.currentUser = userProfile.user.role_id === 2 ? 'A2' : null

            vm.chatRef = firebase.database().ref().child(`chats/admin`)
            vm.chatRef.on('child_added', function (snapshot) {
                if ((snapshot.val().to === vm.userId && snapshot.val().from === vm.currentUser) || (snapshot.val().from === vm.userId && snapshot.val().to === vm.currentUser)) {
                    vm.messages.push(snapshot.val())
                }
            })


        },
        methods: {
            scrollToEnd: function () {
                var container = this.$el.querySelector(".container");
                container.scrollTop = container.scrollHeight;
            },
            send(){
                var vm = this;
                let data = {
                    from: vm.currentUser,
                    to: vm.userId,
                    message: vm.newMessage
                };

                vm.chatRef.push(data, function (snapshot) {
                    vm.newMessage = ''
                    vm.scrollToEnd()
                })

            }
        },
        data(){
            return {
                chatRef: null,
                currentUser: null,
                userId: null,
                messages: [],
                newMessage: '',
                retryCount: 0
            }
        },
    }
</script>
