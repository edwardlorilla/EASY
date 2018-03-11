<template>
    <div>
        <!-- Header -->
        <header id="portfolio">

            <div class="w3-container">
                <h1><b>Book of flora</b></h1>
                <div class="w3-section w3-padding-8">
                    <div class="w3-bar">
                        <router-link class="w3-left w3-bar-item w3-button w3-green" to="repositories/create">Add
                            Repositories
                        </router-link>
                        <button @click="isGrid = !isGrid; isTable = false" class="w3-bar-item w3-button w3-teal"><i
                                class='fa' :class="isGrid ? 'fa-th' : 'fa-list'"></i>
                        </button>
                        <!--<button @click="isTable = true; isGrid  = false" class="w3-bar-item w3-button w3-teal"><i
                                class='fa fa-table'></i>
                        </button>-->
                        <input class="w3-right w3-input  w3-border w3-right w3-bar-item" placeholder="Search"
                               v-model="search" type="text">

                    </div>
                </div>

                <div class="w3-section w3-padding-16">

                    <span class="w3-margin-right">Filter:</span>
                    <el-form>
                        <el-select v-model="distributions" multiple clearable placeholder="Filter Distributions">
                            <el-option
                                    v-for="item in pluckDistributions"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                        <el-select v-model="categories" multiple clearable placeholder="Categories">
                            <el-option
                                    v-for="item in pluckCategories"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                        <el-select v-model="families" multiple clearable placeholder="Families">
                            <el-option
                                    v-for="item in pluckFamilies"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                        <el-select v-model="vegetations" multiple clearable placeholder="Vegetations">
                            <el-option
                                    v-for="item in pluckVegetation"
                                    :key="item"
                                    :label="item"
                                    :value="item">
                            </el-option>
                        </el-select>
                    </el-form>

                    <!--<button class="w3-button w3-white"><i class="fa fa-diamond w3-margin-right"></i>Design</button>
                    <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos
                    </button>
                    <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art
                    </button>-->
                    <div class="w3-row">
                        <a>
                            <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding"
                                 @click="isView = 'published'" :class="isView === 'published' ? 'w3-border-blue' : ''">
                                Plants
                            </div>
                        </a>

                        <a>
                            <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding"
                                 @click="isView = 'shared'" :class="isView === 'shared' ? 'w3-border-blue' : ''">Shared
                                by
                                the user
                                <!--<span class="w3-tag w3-tiny w3-blue">{{ chunkItems ?  (chunkItems.length > 0 ? chunkItems.length : '') : ''}}</span>-->
                            </div>
                        </a>
                        <a>
                            <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding"
                                 @click="isView = 'identified'" :class="isView === 'identified' ? 'w3-border-blue' : ''">
                                Identified Plant
                            </div>
                        </a>
                        <a>
                            <div class="w3-quarter tablink w3-bottombar w3-hover-light-grey w3-padding"
                                 @click="isView = 'unidentified'" :class="isView === 'unidentified' ? 'w3-border-blue' : ''">
                                Unindentifed Plants
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </header>

        <!-- First Photo Grid-->
        <div>
            <div v-for="items in chunkItems" v-if="items">
                <div class="w3-row-padding" v-if="isGrid && !isTable">
                    <photo-grid v-for="(item, index) in items" :edit="editRepository" :key="index" :item="item"
                                class="w3-third w3-container w3-margin-bottom">
                    </photo-grid>
                </div>
                <div v-else-if="!isGrid && !isTable" class="w3-row w3-margin" @click="editRepository(items)" >

                    <div class="w3-third">
                        <img v-if="items.photos[0]" :src="items.photos[0] ? '/images/thumb_' + items.photos[0].file : ''"
                             :alt="items.title"
                             style="object-fit: cover;width: 100%; height:150px;" class="w3-hover-opacity">
                        <vue-initials-img size="200" v-else :name="items.title || 'admin'"/>
                    </div>
                    <div class="w3-twothird w3-container">
                        <h2>{{items.title}}</h2>
                        <p>
                            {{items.description ? items.description.substring(0, 231 ) : items.description }}
                        </p>
                    </div>

                </div>
            </div>
        </div>


        <!-- Pagination -->
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
    import EditView from './edit.vue'
    import TableView from './../grid/grid.vue'
    import PhotoGrid from './photo_grid.vue'
    import {changeRepository, editRepository, togglerViewFunc, togglerView}  from './../Ajax/getData'
    export default{
        mounted(){
            var vm = this
            vm.fuse = new window.Fuse(vm.items, vm.options);
            vm.pageOne.totalPages = vm.items.length
        },
        methods: {
            pageOneChanged(pageNum){
                this.pageOne.currentPage = pageNum
            },
            editRepository(item){
                var vm = this
                const loading = this.$loading({
                    lock: true,
                    text: 'Loading',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });


                vm.$router.push({name: 'edit-repositories', params: {id: item.id}}, function () {
                    loading.close()
                })
            },
            isLength(string){

            },
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
            }
        },
        props: ['items'],
        components: {
            EditView,
            PhotoGrid
        },
        data(){
            return {
                togglerView,
                gridColumns: ['title', 'description'],
                isTable: false,
                isView: 'published',
                isGrid: true,
                pageOne: {
                    currentPage: 1,
                    totalPages: null,
                    itemsPerPage: 6
                },
                options: {
                    shouldSort: true,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: [
                        "title"
                    ]
                },
                fuse: null,
                search: '',
                changeRepository,
                distributions: [],
                categories: [],
                families: [],
                vegetations: []
            }
        },
        computed: {
            totalSearch(){
                var vm = this
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage

                return (vm.search.trim() === '') ? vm.selectedDistributions.length : vm.fuse.search(vm.search.trim()).length
            },
            pluckVegetation(){
                var vm = this
                var allTags = [];
                vm.items ? vm.items.map(function (t) {
                        return t.vegetations;
                    }).forEach(function (a) {
                        return a ? a.forEach(function (b) {
                                return allTags.push(b.name);
                            }) : null;
                    }) : null;
                return _.uniq(allTags)
            },
            selectedDistributions(){
                var vm = this
                var selectedDistributions;
                var distributions = vm.distributions
                var categories = vm.categories
                var families = vm.families
                var vegetations = vm.vegetations

                var items = vm.search.trim() === '' ? vm.items : vm.fuse.search(vm.search.trim())
                var selectedFilter = vm.multiFilter(items, {
                    distribution: distributions,
                    category: categories,
                    family: families,
                    vegetations: vegetations
                })

                if (_.isEmpty(distributions) && _.isEmpty(categories) && _.isEmpty(families) && _.isEmpty(vegetations) && vm.search.trim() === '') {
                    selectedDistributions = vm.items
                } else {
                    selectedDistributions = selectedFilter
                }
                return _.filter(selectedDistributions, function (select) {
                    if(vm.isView === 'shared'){
                        return select.shared === 1 && select.published !== 1
                    } else if(vm.isView === 'published'){
                        return select.published === 1
                    }else if(vm.isView === 'identified'){
                        return select.identified === 1
                    }else{
                        return select.identified !== 1 && select.shared === 1
                    }
                })
            },
            pluckDistributions(){
                var distributions = this.items
                var map = _.map(distributions, function (num, key) {
                    return num.distribution ? num.distribution.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            }, pluckCategories(){
                var categories = this.items
                var map = _.map(categories, function (num, key) {
                    return num.category ? num.category.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            }, pluckFamilies(){
                var families = this.items
                var map = _.map(families, function (num, key) {
                    return num.family ? num.family.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            },
            chunkItems(){
                var vm = this;
                var index = vm.pageOne.currentPage * vm.pageOne.itemsPerPage - vm.pageOne.itemsPerPage
                return (vm.search.trim() === '') ?
                    (vm.isGrid ? _.chunk(vm.selectedDistributions.slice(index, index + vm.pageOne.itemsPerPage), 3) : vm.selectedDistributions.slice(index, index + vm.pageOne.itemsPerPage)) :
                    (vm.isGrid ? _.chunk(vm.fuse.search(vm.search.trim()).slice(index, index + vm.pageOne.itemsPerPage), 3) : vm.fuse.search(vm.search.trim()).slice(index, index + vm.pageOne.itemsPerPage))
            }
        }
    }
</script>
