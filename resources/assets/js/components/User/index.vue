<template>
    <div>
        <div class="w3-container" :class="{'w3-half': w3Half }">
            <header style="padding-top:22px">
                <h5><b><i class="fa fa-dashboard"></i> Users</b></h5>
                <h5>
                    <div class="w3-row-padding">
                        <div class="w3-bar">
                            <button @click="currentView = 'create'" class="w3-left w3-bar-item w3-button w3-green "><i
                                    class="zmdi zmdi-account-add"></i> Add User
                            </button>
                            <!--<button class="w3-left w3-bar-item w3-button w3-blue" >Messages-->
                            </button>
                            <el-select v-model="role" multiple clearable placeholder="Filter Distributions">
                                <el-option
                                        v-for="item in pluckRole"
                                        :key="item"
                                        :label="item"
                                        :value="item">
                                </el-option>
                            </el-select>
                            <input type="text" class="w3-input w3-border w3-right w3-bar-item" v-model="search"
                                   placeholder="Search..."
                                   style="width:30%; margin-bottom: 2px;">
                        </div>


                    </div>
                </h5>
            </header>

            <edit v-if="currentView == 'edit'  && currentView != 'create'"
                  @close="currentView = ''; userInfo = null; updateUser($event)" :user="userInfo"></edit>

            <delete v-else-if="currentView == 'delete'  && currentView != 'create'"
                    @deleteUser="currentView = ''; userInfo = null; removeUser($event);"
                    @close="currentView = ''; userInfo = null; " :user="userInfo"></delete>

            <create v-else-if="currentView && currentView === 'create'" @createUser="createUser($event)" @close="currentView = ''"></create>

            <table class="w3-table w3-bordered w3-striped w3-border test w3-hoverable">
                <tr class="w3-green">
                    <th>Name</th>
                    <th>Email</th>
                    <th v-if="!w3Half">Actions</th>
                </tr>
                <tbody>
                <user v-if="usersLimit"
                      :half="!w3Half"
                      @create="actions('create', $event)"
                      @edit="actions('edit', $event)"
                      @chat="chat($event)"
                      @delete="actions('delete', $event)"
                      v-for="(user, index) in usersLimit"
                      :key="index"
                      :user="user"></user>
                </tbody>
            </table>
            <pagination :current-page="pageOne.currentPage"
                        :items-per-page="pageOne.itemsPerPage"
                        :total-items="totalSearch"
                        @page-changed="pageOneChanged">
            </pagination>
        </div>
        <div class="w3-container w3-half" v-if="w3Half">
            <user-chat :user="userInfo" v-if="w3Half" @close="w3Half = !w3Half"></user-chat>
        </div>
    </div>
</template>

<script>
    import {list,  insertUser} from './../Ajax/getData'
    import User from './../User/User.vue'
    import Edit from './../User/edit.vue'
    import Delete from './../User/delete.vue'
    import Create from './../User/create.vue'
    import UserChat from './../User/UserChat.vue'
    export default{
        components: {
            User,
            Create,
            Edit,
            Delete,
            UserChat
        },
        data(){
            return {
                role: [],
                w3Half: false,
                list,
                pageOne: {
                    currentPage: 1,
                    totalPages: null,
                    itemsPerPage: 10
                },
                search: '',
                currentView: null,
                userInfo: null,
                fuse: null,
                options: {
                    shouldSort: true,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: [
                        "name",
                        "email"
                    ]
                }
            }
        },
        computed: {
            userFilter(){
                var vm = this
              return vm.multiFilter(vm.list.users, {
                  role: vm.role
              })
            },
            usersLimit() {
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return (vm.search.trim() === '') ? vm.userFilter.slice(index, index + vm.pageOne.itemsPerPage) : vm.fuse.search(vm.search.trim()).slice(index, index + vm.pageOne.itemsPerPage)
            },
            totalSearch(){
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return (vm.search.trim() === '') ? vm.userFilter.length : vm.fuse.search(vm.search.trim()).length
            },
            pluckRole(){
                var vm = this
                var roles = vm.role
                var map = _.map(vm.list.users, function (num, key) {
                    return num.role ? num.role.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            },
        },
        methods: {
            multiFilter(array, filters) {
                var filterKeys = Object.keys(filters);
                return array.filter(function (eachObj) {
                    return filterKeys.every(function (eachKey) {
                        if (!filters[eachKey].length) {
                            return true; // passing an empty filter means that filter is ignored.
                        }
                        return _.isArray(eachObj[eachKey]) ?
                            eachObj[eachKey].some(function (o) {
                                return filters[eachKey].includes(o.name);
                            })
                            : filters[eachKey].includes(_.isObject(eachObj[eachKey]) ? eachObj[eachKey].name : eachObj[eachKey])
                    });
                });
            },
            chat(user){
                var vm = this
                vm.w3Half = false
                setTimeout(function(){
                    vm.w3Half = true
                    vm.userInfo = user
                }, 100);

            },
            createUser(user){
                console.log(user)
                var vm = this
                vm.$set(vm.list.users, vm.list.users.length, user)
            },
            updateUser(user){
                var vm = this

                if (user) {
                    var userIndex = _.findIndex(vm.list.users, ['id', user.id]);
                    console.log(user, userIndex)
                    vm.$set(vm.list.users, userIndex, user)
                }
            },

            removeUser(user){
                var vm = this
                var userIndex = _.findIndex(vm.list.users, ['id', user.id]);
                vm.$delete(vm.list.users, userIndex)
            },
            actions(action, user){
                var vm = this

                if (action === 'delete') {

                    vm.currentView = 'delete'
                }
                else if (action === 'create') {
                    insertUser(user)
                    vm.currentView = 'create'
                }

                else {
                    vm.currentView = 'edit'
                }
                if (user) {
                    //need to clone to prevent the reativity of one updating
                    var clone = _.clone(user)
                    vm.userInfo = clone
                }
            },
            pageOneChanged (pageNum) {
                this.pageOne.currentPage = pageNum
            },

            stateModal(){
                var vm = this
                vm.showModal == 'none' ? vm.showModal = 'block' : vm.showModal = 'none'
            }
        },
        mounted(){
            var vm = this;

            vm.fuse = new window.Fuse(vm.list.users, vm.options);
            vm.pageOne.totalPages = this.userFilter.length
        },
    }
</script>
