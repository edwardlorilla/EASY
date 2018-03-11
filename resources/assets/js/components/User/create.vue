<template>
    <div id="id01"  :style="{ display: showModal}" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span v-hotkey="keymap"
                      @click="stateModal"
                      class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">&times;</span>
                <i class="fa fa-user-circle-o fa-6 w3-xxlarge" aria-hidden="true"></i>
                <!--<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">-->
            </div>

            <form class="w3-container">
                <div class="w3-section">
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label>Role Type:</label>
                            <select class="w3-select w3-border" v-model="role_id" name="option">
                                <option value="" disabled selected>Choose your option</option>
                                <option v-for="role in userRoles.name" :value="role.id" >{{role.name}}</option>

                            </select>
                        </div><div class="w3-third">
                            <label>First name:</label>
                            <input class="w3-input w3-border w3-margin-bottom"
                                   type="text"
                                   v-model="firstName" placeholder="Enter First Name"
                                   name="firstName"
                                   required>
                        </div>
                        <div class="w3-third">
                            <label>Last Name:</label>
                            <input class="w3-input w3-border"
                                   v-model="lastName"
                                   type="text"
                                   placeholder="Enter Last Name"
                                   name="lastName"
                                   required>
                        </div>
                    </div> <div class="w3-row-padding">
                        <div class="w3-half">
                            <label>Username</label>
                            <input class="w3-input w3-border w3-margin-bottom"
                                   type="text"
                                   v-model="name" placeholder="Enter Username"
                                   name="Name"
                                   required>
                        </div>
                        <div class="w3-half">
                            <label><b>Email</b></label>
                            <input class="w3-input w3-border"
                                   v-model="email"
                                   type="email"
                                   placeholder="Enter Email"
                                   name="email"
                                   required>
                        </div>
                    </div>
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border"
                                   v-model="password"
                                   type="password"
                                   placeholder="Enter Password"
                                   name="psw"
                                   required>
                        </div>
                        <div class="w3-half">
                            <label><b>Confirm Password</b></label>
                            <input class="w3-input w3-border"
                                   v-model="password_confirmation"
                                   type="password"
                                   placeholder="Enter Password"
                                   name="psw"
                                   required>
                        </div>
                    </div>
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label><b>School</b></label>
                            <input class="w3-input w3-border"
                                   v-model="school"
                                   type="text"
                                   placeholder="Enter School"
                                   name="school"
                                   required>
                        </div>
                        <div class="w3-third">
                            <label><b>Country</b></label>

                            <select-input v-model="country" :select="country"></select-input>
                        </div>
                        <div class="w3-third">
                            <label><b>Field of Study</b></label>
                            <input class="w3-input w3-border"
                                   v-model="field"
                                   type="text"
                                   placeholder="Enter Field of Study"
                                   name="field"
                                   required>
                        </div>
                    </div>






                    <ons-button v-if="!loading"
                                @click="register"
                                class="w3-button w3-block w3-green w3-section w3-padding"
                                modifier="large--cta">Add User</ons-button>
                    <ons-button v-else disabled modifier="large--cta"><v-ons-progress-circular indeterminate></v-ons-progress-circular></ons-button>

                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button :disabled="loading"  @click="stateModal" type="button"
                        class="w3-button w3-red">Cancel
                </button>
            </div>

        </div>
    </div>

</template>
<script>
    import Select from './Select.vue'
    import {insertUser, userRoles, fetchUserActivity} from './../Ajax/getData'
    export default{
        components:{
          'select-input' : Select
        },
        data(){
            return{
                userRoles,
                showModal: 'block',
                country: 'PH',
                school: '',
                role_id: 5,
                field: '',
                name: '',
                firstName: '',
                lastName: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: [],
                userRef: firebase.database().ref('users'),
                loading: false
            }
        },
        mounted(){

        },
        computed:{
            hasErrors(){
                var vm = this
                return vm.errors.length > 0
            },
            keymap () {
                var vm = this
                return {
                    // bind to hotkey
                    'esc': vm.stateModal
                }
            }
        },
        methods:{
            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
                vm.$emit('close')
            },
            register(){
                var vm = this
                vm.errors = []
                if(vm.isFormValid){
                    vm.loading = true
                    axios.post('/api/user', {
                        name: vm.name,
                        firstName: vm.firstName,
                        lastName: vm.lastName,
                        email: vm.email,
                        password: vm.password,
                        password_confirmation: vm.password_confirmation,
                        country: vm.country,
                        school: vm.school,
                        role_id: vm.role_id,
                        field: vm.field,
                        uid: firebase.auth().currentUser.uid
                    })
                        .then(function (response) {
                            fetchUserActivity(response.data.activity)
                            vm.loading = false
                            vm.name = ''
                            vm.email = ''
                            vm.password = ''
                            vm.role_id = ''
                            vm.password_confirmation = ''
                            vm.country = ''
                            vm.school = ''
                            vm.field = ''
                            vm.$emit('createUser', response.data.created)

                            new Noty({
                                timeout: 5000,
                                type: 'success',
                                layout: 'topRight',
                                text: response.data.message
                            }).show();
                        })
                        .catch(function (error) {
                            vm.loading = false
                            if(error.response){
                                $.each( error.response.data, function( key, value ) {
                                    for (var i = 0; i < value.length; i++) {
                                        new Noty({
                                            timeout: 5000,
                                            type: 'error',
                                            layout: 'topRight',
                                            text: value[i]
                                        }).show();
                                    }
                                });
                            }
                        });

                }

            },
            saveUserToUsersRef(user ){
                var vm = this
                vm.loading = false
                return vm.userRef.child(user.uid).set({
                    name:user.displayName,
                    display: vm.name,
                    avatar: user.photoURL,
                    uid: user.uid
                })
            },
            isEmpty(){
                var vm = this
                if(vm.name.length ==  0 || vm.email.length == 0 || vm.password.length == 0 || vm.password_confirmation.length == 0){
                    return true
                }
                return false
            },
            passwordValid(){
                var vm = this
                if(vm.password.length < 6 || vm.password_confirmation < 6){
                    return false
                }
                if(vm.password !== vm.password_confirmation){
                    return false
                }
                return true
            },
            isFormValid(){
                var vm = this
                if(vm.isEmpty()){
                    vm.errors.push('Empty Field')
                    return false
                }
                if(!vm.passwordValid){
                    vm.errors.push('password incorrect')
                    return false
                }
                return true
            }
        }
    }
</script>
