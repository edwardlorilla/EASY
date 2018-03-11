<template>
    <tr>
        <td>
            <input type="text" class="w3-input w3-border"
                   v-model="editForm.name" v-if="edit"
            >
            <span v-else>{{ entry.name }}</span>
        </td>

        <td>
            <button type="button" class="w3-bar-item w3-button w3-teal"
                    v-on:click="editUser" v-if="!edit"
            >
                Edit
            </button>

            <button type="button" class="w3-bar-item w3-button w3-red"
                    v-on:click="cancelEdit" v-if="edit"
            >
                Cancel
            </button>

            <button type="button" class="w3-bar-item w3-button w3-teal"
                    v-on:click="updateFamily(entry, editForm)" v-if="edit"
            >
                update
            </button>

            <button type="button" class="w3-bar-item w3-button w3-red"
                    v-on:click="$emit('delete', entry)" v-if="!edit"
            >
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    import {updatePlantItem, fetchUserActivity} from './../Ajax/getData'
    export default{
        props: ['entry', 'nameKey', 'updateKey'],
        data(){
            return {
                edit: false,
                editForm: {
                    name: '',
                    firebase: firebase.auth().currentUser.uid
                },
            }
        },
        methods: {
            editUser(){
                var vm = this
                vm.edit = true;
                vm.editForm.name = vm.entry.name;
            },
            cancelEdit(){
                var vm = this
                vm.edit = false;
                vm.editForm.name = '';
            },
            updateFamily(event){
                var vm = this
                axios.patch(`/api/${vm.nameKey}/${event.id}`, vm.editForm).then(function (response) {
                    fetchUserActivity(response.data.activity)
                    vm.$emit('updateData', response.data.updated)
                    /*vm.entry = response.data.updated
                    updatePlantItem(vm.updateKey, response.data.updated)*/
                    new Noty({
                        timeout: 5000,
                        type: 'success',
                        layout: 'topRight',
                        text: response.data.message
                    }).show();
                    vm.cancelEdit();
                });
            },
        }

    }
</script>
