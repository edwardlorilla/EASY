<template>
    <div>
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-container w3-brown">
                    <h2>Plant Category</h2>
                </div>
                <form id="search" @submit.prevent="add">
                    <p>
                        <label class="w3-text-brown"><b>Category Name:</b></label>
                        <input class="w3-input w3-border" v-model="plantCategory" type="text">
                    </p>

                    <input type="submit" class="w3-btn w3-brown" value="Add Plant Category"/>

                </form>
            </div>

            <div class="w3-half">
                <div  class="w3-container w3-text-blue w3-margin">
                    <input name="query" class="w3-input w3-border" placeholder="Search..." v-model="searchQuery">

                </div>
                <grid
                        :nameKey="nameKey"
                        nameUpdate="categories"
                        @update="update($event)"
                        @delete="deleteData($event)"
                        :data=" orderBy(allId.categories, 'updated_at', -1)"
                        :columns="gridColumns"
                        :filter-key="searchQuery"/>


            </div>
        </div>

    </div>
</template>
<style>

</style>
<script>
    import Grid from './../grid/grid.vue'
    import {allId, fetchUserActivity} from './../Ajax/getData'
    export default{
        methods: {
            add(){
                var vm = this
                    axios.post(`/api/${vm.nameKey}/`, {name: vm.plantCategory, firebase: firebase.auth().currentUser.uid}).then(function (response) {
                        fetchUserActivity(response.data.activity)
                        vm.$set(vm.allId.categories, vm.allId.categories.length, response.data.created)
                        new Noty({
                            timeout: 5000,
                            type: 'success',
                            layout: 'topRight',
                            text: response.data.message
                        }).show();
                });
            },
            deleteData(event){
                var vm = this
                axios.delete(`/api/${vm.nameKey}/${event.id}/${firebase.auth().currentUser.uid}`).then(function (response) {
                    fetchUserActivity(response.data.activity)
                    var index = _.findIndex(vm.allId.categories, ['id', event.id]);
                    vm.$delete(vm.allId.categories, index)
                    new Noty({
                        timeout: 5000,
                        type: 'success',
                        layout: 'topRight',
                        text: response.data.message
                    }).show();
                }).catch(function(error) {
                    new Noty({
                        timeout: 5000,
                        type: 'error',
                        layout: 'topRight',
                        text: error.response.statusText
                    }).show();
                });
            },
            update(event){
                var vm = this
                var index = _.findIndex(vm.allId.categories, ['id', event.id]);
                vm.$set(vm.allId.categories, index, event)
            }
        },
        components: {
            Grid
        },
        data(){
            return {
                nameKey:"category",
                plantCategory: null,
                category: {
                    name: null
                },
                searchQuery: '',
                gridColumns: ['name'],
                allId
            }
        }
    }
</script>
