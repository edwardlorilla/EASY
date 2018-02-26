<template>
    <div>
        <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:230px">
            <div v-if="repositoryPhoto.length > 0" id='listings' class='listings'>
                <div   id="listings" class="item">
                    <h5 class="w3-bar-item">Repositories</h5>
                    <button v-if="repositoryPhoto" v-for="(repository, index)  in repositoryPhoto"  @click="getLocation(repository.latitude, repository.longitude, index)" :id="repository.id" class="w3-bar-item w3-button tablink">
                        <img :src="getPhoto(repository.photos)" class="w3-bar-item w3-round w3-hide-small"
                             style="object-fit: cover;width: 100%; height: 85px;"/>
                    </button>
                </div>
            </div>
            <div v-if="repositoryPhoto.length === 0">
                <h5 class="w3-bar-item">no repository yet!</h5>
            </div>
        </div>

        <div  style="margin-left:230px">
            <v-map  ref="map" class='map' :zoom="zoom" :center="center">
                <v-tilelayer :url="url" :attribution="attribution"></v-tilelayer>
                <!--   <v-marker :lat-lng="marker"></v-marker>-->
                <v-marker-cluster ref="markerCluster">
                    <!--<v-marker v-for="item in filterCategory" :key="item.id"-->
                    <v-marker v-for="item in repositoryPhoto" ref="item" v-if="item.latitude && item.longitude"
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
        height: 100vh;

        width: 78.5%;
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
    import {editUser, list, plantItem} from './../Ajax/getData'
    export default{
        data(){
            return {
                list,
                plantItem,
                zoom: 13,
                center: [47.413220, -1.219482],
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            }
        },
        methods:{
            contentPop(title, photos, vegetations, category, distribution, family){
                return `<div class='leaflet-popup-content' style='width: 201px;'>
                               ${(!_.isUndefined(photos[0]) ? "<img class='w3-round'  style='width: 200px; object-fit: cover; height:150px;' src='/images/" + photos[0].file + "'>" : '')}
                                <h3>${title ? title : ''}</h3>
                                <table class="w3-table">
                                ${category ? '<tr><th>Classification</th><th>' : ''}

                                 ${category ? category.name : ''}
                                ${category ? '</th></tr>' : ''}

                                ${family ? '<tr><th>Family</th><th>' : ''}

                                 ${family ? family.name : ''}
                                ${family ? '</th></tr>' : ''}

                                ${distribution ? '<tr><th>Distribution</th><th>' : ''}

                                 ${distribution ? distribution.name : ''}
                                ${distribution ? '</th></tr>' : ''}
                                </table>
                                <a target='_blank' class='url' href=''></a>
                                </div>`
            },
            iconMarker(item){
                if (_.isEmpty(item)) {
                    return
                } else {

                    return L.divIcon({
                        html: '<img style="width: 100%;" src="/images/thumb_' + item[0].file + '"/>',
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
                var marker = vm.$refs.item[index] ? vm.$refs.item[index].mapObject : null
                var position = L.latLng(lat, lng)
                var map = vm.$refs.map ? vm.$refs.map.mapObject : null
//                map.panTo(position);

                /*
                 if (!marker._icon) {
                 marker.__parent.spiderfy()
                 }*/
                if(marker){
                    vm.$refs.markerCluster.mapObject.zoomToShowLayer(marker, function () {
                        marker.openPopup();

                    });
                }
            },
            formatLocation(lat, lng){
                return L.latLng(lat, lng)
            },
            getPhoto(photo){
                return `${(!_.isUndefined(photo[0]) ? '/images/thumb_' + photo[0].file : '' )}`
            },
        },
        mounted(){
            var vm = this
            L.Marker.prototype.update = function () {
                if (this._icon) {
                    var pos = this._map.latLngToLayerPoint(this._latlng).round();
                    this._setPos(pos);
                }
            };
            var map = vm.$refs.map ? vm.$refs.map.mapObject : null
            map.on('popupopen', function (e) {
                var px = map.project(e.popup._latlng);
                px.y -= e.popup._container.clientHeight / 2
                map.panTo(map.unproject(px), {animate: true});
            });
            var bounds = _.map(vm.plantItem.all, function (plant) {
                return [plant.latitude, plant.longitude]
            });
            map.fitBounds(_.compact(bounds));
        },
        computed:{
            user(){
                var vm = this,
                index =  _.findIndex(vm.list.users, ['id', _.parseInt(vm.$route.params.id)]);
                return vm.list.users ? vm.list.users[index] : null
            },
            repositoryPhoto(){
                //['user_id', _.parseInt(vm.$route.params.id)]
                var vm = this
                return vm.plantItem.all ?  _.filter(vm.plantItem.all , function(data){
                    return data.user_id === _.parseInt(vm.$route.params.id) && data.latitude && data.longitude
                    } ) : [];
            }
        }
    }
</script>
