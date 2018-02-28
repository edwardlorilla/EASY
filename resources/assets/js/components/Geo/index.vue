<template>
    <div>
        <div v-if="plantItem.all" class="w3-sidebar" style="width: 100%;">
            <div class=" sidebar">
                <div class='heading'>
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <h1>Repositories</h1>
                        </div>
                        <div class="w3-half">
                            <input class="w3-input w3-border" v-model="search" style="margin-top: 10px;width: 160px;height: 28px;" placeholder="Search.." type="text">
                        </div>

                    </div>
                </div>
                <div class="w3-row">
                    <a>
                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"
                             @click="isView = 'listings'" :class="isView === 'listings' ? 'w3-border-red' : ''">Plants <span class="w3-tag w3-tiny w3-blue">{{filters ? filters.length : '0'}}</span>
                        </div>
                    </a>
                    <a>
                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"
                             @click="isView = 'grid'" :class="isView === 'grid' ? 'w3-border-red' : ''">Filter
                        </div>
                    </a>
                    <a>
                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"
                             @click="isView = 'settings'" :class="isView === 'settings' ? 'w3-border-red' : ''">Settings
                        </div>
                    </a>
                </div>
                <div id='listings' class='listings'>
                    <div   id="listings" class="listings">
                        <div v-show="isView === 'listings'" class="w3-bar item" v-for="(item, index) in filters"
                             @click="getLocation(item.latitude, item.longitude, index)">
                            <img :src="getPhoto(item.photos)" class="w3-bar-item w3-circle w3-hide-small"
                                 style="object-fit: cover;width: 85px; height: 85px;"/>
                            <div class="w3-bar-item">
                                <a class="title">{{item.title}}<br>
                                    <small class="quiet">{{item.description ? (item.description.length > 30 ?
                                        item.description.substring(0, 20) : item.description) : ''}}
                                    </small>
                                </a>
                                <p><span v-for="vegetation in item.vegetations" class="w3-tag w3-blue w3-tiny">{{vegetation.name}}</span>
                                </p>
                            </div>
                        </div>
                        <div v-if="isView === 'grid'">
                            <div class="item">
                                <el-select v-model="distributions" multiple clearable placeholder="Filter Distributions">
                                    <el-option
                                            v-for="item in pluckDistributions"
                                            :key="item"
                                            :label="item"
                                            :value="item">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="item">
                                <el-select v-model="categories" multiple clearable placeholder="Categories">
                                    <el-option
                                            v-for="item in pluckCategories"
                                            :key="item"
                                            :label="item"
                                            :value="item">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="item">
                                <el-select v-model="families" multiple clearable placeholder="Families">
                                    <el-option
                                            v-for="item in pluckFamilies"
                                            :key="item"
                                            :label="item"
                                            :value="item">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="item">
                                <el-select v-model="vegetations" multiple clearable placeholder="Vegetations">
                                    <el-option
                                            v-for="item in pluckVegetation"
                                            :key="item"
                                            :label="item"
                                            :value="item">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="w3-bar item">
                                <div class="chart" style="height:250px">

                                    <chart-pie class="with-3d-shadow with-transitions"
                                               :data='chart_0' :config='chartConfig'></chart-pie>
                                </div>
                            </div>
                            <div class="item">
                                <div class="chart" style="height:250px">

                                    <chart-pie class="with-3d-shadow with-transitions"
                                               :data='chart_1' :config='chartConfig'></chart-pie>
                                </div>
                            </div>
                            <div class="item">
                                <div class="chart" style="height:250px">

                                    <chart-pie class="with-3d-shadow with-transitions"
                                               :data='chart_2' :config='chartConfig'></chart-pie>
                                </div>
                            </div>
                        </div>
                        <div v-if="isView === 'settings'">
                            <select  class="w3-select w3-border" v-model="tileProvider">
                                <option v-for="provider in tileProviders" :value="provider">{{provider.name}}</option>
                            </select>
                        </div>


                    </div>
                </div>

            </div>

            <v-map ref="map" class='map' :zoom="zoom" :maxZoom="maxZoom" :center="center">
                <v-tilelayer ref="tile" :url="tileProvider.url" :attribution="tileProvider.attribution"></v-tilelayer>
                <!--   <v-marker :lat-lng="marker"></v-marker>-->
                <v-marker-cluster ref="markerCluster">
                    <!--<v-marker v-for="item in filterCategory" :key="item.id"-->
                    <v-marker v-for="item in filters" ref="item" v-if="item.latitude && item.longitude"
                              :key="item.id"
                              :icon="iconMarker(item.photos)"
                              :lat-lng="formatLocation(item.latitude, item.longitude)"
                    >

                        <v-popup
                                :content="contentPop(item.title, item.photos, item.vegetations, item.category, item.distribution, item.family)">

                        </v-popup>
                    </v-marker>
                </v-marker-cluster>
            </v-map>
        </div>
    </div>
</template>
<style scoped>
    body {
        color: #404040;
        font: 400 15px/22px 'Roboto slab', 'Georgia', Sans-serif;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    h1 {
        font-size: 22px;
        margin: 0;
        font-weight: 400;
    }

    a {
        color: #404040;
        text-decoration: none;
    }

    a:hover {
        color: #101010;
    }

    .sidebar {
        position: absolute;
        width: 33.3333%;
        height: 100%;
        top: 0;
        left: 0;
        overflow: hidden;
        border-right: 1px solid rgba(0, 0, 0, 0.25);
    }

    .pad2 {
        padding: 20px;
    }

    .quiet {
        color: #888;
    }

    .boxtop {
        padding-left: 10px;
        padding-top: 10px;
        white-space: pre-wrap;
        display: inline-block;
    }

    .box {
        padding-left: 10px;
        padding-top: 5px;
        /*    padding-bottom: 10px;*/
        white-space: pre-wrap;
        display: inline-block;
        font-weight: normal;
    }

    .url {
        padding-left: 10px;
        /*    padding-top:5px;*/
        padding-bottom: 10px;
        white-space: pre-wrap;
        display: inline-block;
        font-weight: normal;
    }

    .map {
        position: absolute;
        left: 33.3333%;
        width: 66.6666%;
        top: 0;
        bottom: 0;
    }

    .heading {
        background: #fff;
        border-bottom: 1px solid #eee;
        height: 60px;
        line-height: 60px;
        padding: 0 10px;
    }

    .listings {
        height: 100%;
        overflow: auto;
        padding-bottom: 100px;
    }

    .listings .item {
        display: block;
        border-bottom: 1px solid #eee;
        padding: 10px;
        text-decoration: none;
    }

    .listings .item:last-child {
        border-bottom: none;
    }

    .listings .item .title {
        display: block;
        color: #00aced;
        font-weight: 700;
    }

    .listings .item .title small {
        font-weight: 400;
    }

    .listings .item.active .title,
    .listings .item .title:hover {
        color: #0491c6;
    }

    .listings .item.active {
        background-color: #f8f8f8;
    }

    ::-webkit-scrollbar {
        width: 8px;
        height: 3px;
        border-left: 0;
        background: rgba(0, 0, 0, 0.1);
    }

    ::-webkit-scrollbar-track {
        background: none;
    }

    ::-webkit-scrollbar-thumb {
        background: #00aced;
        border-radius: 0;
    }

    .clearfix {
        display: block;
    }

    .clearfix:after {
        content: '.';
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }

    img {
        max-width: 201px;
        height: auto;
        border-radius: 3px 3px 0px 0px;
    }

    /* Marker tweaks */
    .leaflet-popup-close-button {
        display: none;
    }

    .leaflet-popup-content {
        font: 400 15px/22px 'Roboto Slab', 'Georgia', Sans-serif;
        padding: 0;
        width: 200px;
    }

    .leaflet-popup-content-wrapper {
        padding: 0;
    }

    .leaflet-popup-close-button + .leaflet-popup-content-wrapper .leaflet-popup-content {

        padding-top: 0px !important;
    }

    .leaflet-popup-content h3 {
        background: #00aced;
        color: #fff;
        margin: 0;
        display: block;
        padding: 18px 10px 10px 10px;
        /*    border-radius:3px 3px 0 0;*/
        font-weight: 700;
        margin-top: -15px;
    }

    .leaflet-popup-content div {
        padding: 10px 10px 10px 10px;
    }

    .leaflet-container .leaflet-marker-icon {
        cursor: pointer;
    }

    @media only screen and (max-width: 460px) {
        h1 {
            font-size: 16px;
        }

        .leaflet-popup-content {
            font: 400 15px/15px 'Roboto Slab', 'Georgia', Sans-serif;
            padding: 0;
            width: 150px;
        }

        img {
            width: 150px;
        }

        .sidebar {
            display: none;
        }

        .map {
            position: absolute;
            left: 0 !important;
            width: 100%;
            top: 0;
            bottom: 0;
        }
    }
</style>
<script>

    import {plantItem, tileProviders} from './../Ajax/getData'
    import PopupContent from './PopupContent.vue';
    import {ChartPie} from 'vue-d2b'
    export default{
        components: {
            'popup-content': PopupContent,
            'chart-pie': ChartPie
        },
        data(){
            return {
                tileProviders,
                tileProvider: tileProviders[0],
                maxZoom: 17,
                options: ["category.name", 'distribution.name', 'family.name'],
                chartConfig (chart) {
                    chart.donutRatio(0.5)
                },
                isView: 'listings',
                content: '',
                plantItem,
                zoom: 13,
                center: [47.413220, -1.219482],
                url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(47.413220, -1.219482),
                countBy: "category.name",
                chartValue: [],
                distributions: [],
                categories: [],
                families: [],
                vegetations: [],
                search: '',
                fuse: null,

                fuseOptions: {
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
            }
        },
        mounted () {
            var vm = this
            vm.fuse = new window.Fuse(vm.plantItem.all, vm.fuseOptions);
            L.Marker.prototype.update = function () {
                if (this._icon) {
                    var pos = this._map.latLngToLayerPoint(this._latlng).round();
                    this._setPos(pos);
                }
            };
            var map = vm.$refs.map.mapObject
            map.on('popupopen', function (e) {
                var px = map.project(e.popup._latlng);
                px.y -= e.popup._container.clientHeight / 2
                map.panTo(map.unproject(px), {animate: true});
            });

            var bounds = vm.plantItem.all ?  _.map(vm.plantItem.all, function (plant) {
                return [plant.latitude, plant.longitude]
            }) : [];
                if(bounds){
                    map.fitBounds(_.compact(bounds));
                }
            vm.$refs.tile.mapObject.options.subdomains = ['mt0','mt1','mt2','mt3']
        },
        methods: {
            getPhoto(photo){
                return `${(!_.isUndefined(photo[0]) ? '/images/thumb_' + photo[0].file : '' )}`
            },
            contentPop(title, photos, vegetations, category, distribution, family){
                return `<div class='leaflet-popup-content' style='width: 201px;'>
                               ${(!_.isUndefined(photos[0]) ? "<img class='w3-round'  style='width: 200px; object-fit: cover; height:150px;' src='images/" + photos[0].file + "'>" : '')}
                                <h3>${title}</h3>
                                <table class="w3-table">
                                <tr>
                                  <th>Classification</th>
                                  <th>${category ? category.name : ''}</th>
                                </tr>
                                <tr>
                                   <th>Family</th>
                                  <th>${family ? family.name : ''}</th>
                                </tr>
                                <tr>
                                   <th>Distribution</th>
                                  <th>${distribution ? distribution.name : ''}</th>
                                </tr>
                                </table>
                                <a target='_blank' class='url' href=''></a>
                                </div>`
            },
            iconMarker(item){
                if (_.isEmpty(item)) {
                    return
                } else {

                    return L.divIcon({
                        html: '<img style="width: 100%;" src="images/thumb_' + item[0].file + '"/>',
                        // Specify a class name we can refer to in CSS.
                        className: 'image-icon',
                        // Set a markers width and height.
                        iconSize: [36, 36]
                    })
                }
            },
            getLocation(lat, lng, index){
                var vm = this
                console.log(index)
                var marker = vm.$refs.item[index].mapObject
                var position = L.latLng(lat, lng)
                var map = vm.$refs.map.mapObject
//                map.panTo(position);

                /*
                 if (!marker._icon) {
                 marker.__parent.spiderfy()
                 }*/

                vm.$refs.markerCluster.mapObject.zoomToShowLayer(marker, function () {
                    marker.openPopup();

                });
            },
            formatLocation(lat, lng){
                return L.latLng(lat, lng)
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
        computed: {
            pluckVegetation(){
                var vm = this
                var allTags = [];
                vm.plantItem.all.map(function (t) {
                    return t.vegetations;
                }).forEach(function (a) {
                    return a.forEach(function (b) {
                        return allTags.push(b.name);
                    });
                });
                return _.uniq(allTags)
            },
            pluckDistributions(){
                var vm = this
                var distributions = vm.plantItem.all
                var map = _.map(distributions, function (num, key) {
                    return num.distribution ? num.distribution.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            }, pluckCategories(){
                var vm = this
                var categories = vm.plantItem.all
                var map = _.map(categories, function (num, key) {
                    return num.category ? num.category.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            }, pluckFamilies(){
                var vm = this
                var families = vm.plantItem.all
                var map = _.map(families, function (num, key) {
                    return num.family ? num.family.name : null
                });
                var unique = _.uniq(map);
                var pluckFilter = _.filter(unique, function (fil) {
                    return fil == "" ? null : fil
                });
                return pluckFilter
            },
            chart_0(){
                var vm = this
                var countBy = _.countBy(vm.filters, vm.options[0]);
                return _.map(countBy, function (count, name) {
                    return {label: name, value: count};
                })
            },chart_1(){
                var vm = this
                var countBy = _.countBy(vm.filters, vm.options[1]);
                return _.map(countBy, function (count, name) {
                    return {label: name, value: count};
                })
            },chart_2(){
                var vm = this
                var countBy = _.countBy(vm.filters, vm.options[2]);
                return _.map(countBy, function (count, name) {
                    return {label: name, value: count};
                })
            },
            filters(){
                var vm = this
                var selectedDistributions;
                var distributions = vm.distributions
                var categories = vm.categories
                var families = vm.families
                var vegetations = vm.vegetations

                var items = vm.search.trim() === '' ? vm.plantItem.all : vm.fuse.search(vm.search.trim())
                var selectedFilter = vm.multiFilter(items, {
                    distribution: distributions,
                    category: categories,
                    family: families,
                    vegetations: vegetations
                })

                if (_.isEmpty(distributions) && _.isEmpty(categories) && _.isEmpty(families) && _.isEmpty(vegetations) && vm.search.trim() === '') {
                    selectedDistributions = vm.plantItem.all
                } else {
                    selectedDistributions = selectedFilter
                }
                return _.filter(selectedDistributions, function (select) {
                    return select.published === 1 && select.latitude && select.longitude
                })




            },
        }
    }
</script>
