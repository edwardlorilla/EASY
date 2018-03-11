<template>
   <v-ons-page >
       <v-ons-toolbar class="w3-bar w3-top w3-black w3-large" style="z-index:4">
           <button class="w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey" @click="w3_open();"><i class="fa fa-bars"></i></button>
           <span class="w3-bar-item w3-right">HAGO</span>
       </v-ons-toolbar>

       <!-- Sidebar/menu -->
       <nav  class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" ref="mySidebar" id="mySidebar"><br>
           <avatar @updateProfile="userProfile =  $event"
                   :user="userProfile"
           ></avatar>
           <hr>
           <div class="w3-container">
               <h5>Dashboard</h5>
           </div>
          <side-bar @w3_close="w3_close"></side-bar>
       </nav>


       <!-- Overlay effect when opening sidebar on small screens -->
       <div class="w3-overlay w3-animate-opacity" @click="w3_close()" style="cursor:pointer" title="close side menu" ref="myOverlay" id="myOverlay"></div>

       <!-- !PAGE CONTENT! -->
       <div class="w3-main"  ref="main" style="margin-left:300px;margin-top:10px;">

           <!-- Header -->


          <main-content></main-content>


           <!-- Footer -->
           <!--<footer class="w3-container w3-padding-16 w3-light-grey">
               <p>Powered by <a target="_blank">HAGO</a></p>
           </footer>-->

           <!-- End page content -->
       </div>

   </v-ons-page>
</template>
<style scoped>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
    }
</style>
<script>
    import {AppMixin} from './AppMixin'
    import {listUser, fetchAll, getData, profilePage, scientificInformationHandler} from './Ajax/getData'
    import Avatar from './Avatar.vue'
    import SideBar from './SideBar.vue'
    import MainContent from './MainContent.vue'

    export default {
        mixins: [AppMixin],
        data(){
           return {
               userProfile: null,
               fullscreenLoading: false
           }
        },
        methods:{
            w3_open() {
                var vm = this, mySidebar = vm.$refs.mySidebar, overlayBg = vm.$refs.myOverlay, main = vm.$refs.main
                /*if (mySidebar.style.display === 'block') {
                    mySidebar.style.display = 'none';
                    overlayBg.style.display = "none";
                } else {
                    mySidebar.style.display = 'block';
                    overlayBg.style.display = "block";
                }*/
                if (mySidebar.style.display !== 'block') {
                    main.style.marginLeft = "300px";
                    mySidebar.style.width = "300px";
                    mySidebar.style.display = "block";

                }else{
                    main.style.marginLeft = "0px";
                    mySidebar.style.width = "0px";
                    mySidebar.style.display = "none";

                }
            },
            w3_close() {
                var vm = this, mySidebar = vm.$refs.mySidebar, overlayBg = vm.$refs.myOverlay
                mySidebar.style.display = "none";
                overlayBg.style.display = "none";
            }
        },
        mounted(){
            var vm = this
            const loading = vm.$loading({
                lock: true,
                text: 'Loading',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });
            axios.get(`/api/user/${firebase.auth().currentUser.uid}`).then(function (response) {
                vm.userProfile = response.data.user
                profilePage(response.data.user)
                listUser(response.data.users, response.data.activity, response.data.roles )
            })
            axios.all([

                axios.get(`/api/distribution/${firebase.auth().currentUser.uid}`),
                axios.get(`/api/category/${firebase.auth().currentUser.uid}`),
                axios.get(`/api/family/${firebase.auth().currentUser.uid}`),
                axios.get(`/api/vegetation/${firebase.auth().currentUser.uid}`),
            ]).then(axios.spread(function (distribution, category, family, vegetation) {
                loading.close();
                fetchAll(distribution.data, category.data, family.data, vegetation.data)
                scientificInformationHandler(family.data.length, category.data.length, distribution.data.length, vegetation.data.length)
                getData()
            }));
        },
        components:{
            Avatar,
            SideBar,
            MainContent
        }
    }
</script>
