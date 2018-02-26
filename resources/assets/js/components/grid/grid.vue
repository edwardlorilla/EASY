<template>
    <div>

        <table class="w3-table w3-bordered w3-striped w3-border test w3-hoverable">
            <thead>
            <tr class="w3-green">
                <th v-for="key in columns"
                    @click="sortBy(key)"
                    :class="{ active: sortKey == key }">
                    {{ key | capitalize }}
                    <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>
                    Actions
                </th>
            </tr>

            </thead>
            <tbody>
            <column-data v-for="(entry, index) in searchLimit"
                         :key="index"
                         :entry="entry"
                         :nameKey="nameKey"
                         :updateKey="nameUpdate"
                         @updateData="$emit('update', $event)"
                         @delete="$emit('delete', $event)"
            >
            </column-data>

            </tbody>
        </table>
        <pagination :current-page="pageOne.currentPage"
                    :items-per-page="pageOne.itemsPerPage"
                    :total-items="totalSearch"
                    @page-changed="pageOneChanged">
        </pagination>
    </div>
</template>
<style>

</style>
<script>
    import ColumnData from './columnData.vue'
    export default{
        props: {
            data: Array,
            columns: Array,
            filterKey: String,
            nameKey: String,
            nameUpdate: String
        },
        components: {
            ColumnData
        },
        mounted(){
            var vm = this
            vm.pageOne.totalPages = vm.data.length
        },
        data: function () {

            var sortOrders = {}
            this.columns.forEach(function (key) {
                sortOrders[key] = 0
            })
            return {
                pageOne: {
                    currentPage: 1,
                    totalPages: null,
                    itemsPerPage: 10
                },
                sortKey: '',
                sortOrders: sortOrders
            }
        },
        computed: {
            searchLimit() {
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return  vm.filteredData.slice(index, index + vm.pageOne.itemsPerPage)
            },
            totalSearch(){
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return vm.filteredData.length
            },
            filteredData: function () {
                var sortKey = this.sortKey
                var filterKey = this.filterKey && this.filterKey.toLowerCase()
                var order = this.sortOrders[sortKey] || 1
                var data = this.data
                if (filterKey) {
                    data = data.filter(function (row) {
                        return Object.keys(row).some(function (key) {
                            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                        })
                    })
                }
                if (sortKey) {
                    data = data.slice().sort(function (a, b) {
                        a = a[sortKey]
                        b = b[sortKey]
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }
                return data
            }
        },
        filters: {
            capitalize: function (str) {
                return str.charAt(0).toUpperCase() + str.slice(1)
            }
        },
        methods: {
            pageOneChanged (pageNum) {
                this.pageOne.currentPage = pageNum
            },
            sortBy: function (key) {
                this.sortKey = key
                this.sortOrders[key] = this.sortOrders[key] * -1
            }
        }
    }
</script>
