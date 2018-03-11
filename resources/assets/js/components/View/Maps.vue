<template>
    <v-ons-page>
        <v-ons-progress-bar v-if="!userLocation.lat" indeterminate></v-ons-progress-bar>
        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button @click="changeView">
                    <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="right">
                <v-ons-toolbar-button>
                    <v-ons-icon icon="fa-search" @click="onSearch = true" v-if="!onSearch"></v-ons-icon>
                    <v-ons-icon icon="fa-check" @click="onSearch = false; searchQuery = ''" v-if="onSearch"></v-ons-icon>
                </v-ons-toolbar-button>
                <v-ons-toolbar-button v-if="!onSearch" @click="showPopover($event, 'down', true)">
                    <v-ons-icon v-if="$ons.platform.isAndroid()" icon="md-layers"></v-ons-icon>
                    <v-ons-icon v-else icon="ion-gear-b, material:md-settings"></v-ons-icon>
                </v-ons-toolbar-button>
                <v-ons-toolbar-button v-if="!onSearch" @click="mySigthing()">
                    <v-ons-icon  icon="fa-eye"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">
                <search-map class="center-textbox" v-if="onSearch" v-model="searchQuery"></search-map>
            </div>
        </v-ons-toolbar>

        <v-ons-popover cancelable
                       :visible.sync="popoverVisible"
                       :target="popoverTarget"
                       :direction="popoverDirection"
                       :cover-target="coverTarget"
        >

            <v-ons-list-item v-for="(tileset, index) in tileSets.all" :key="index" tappable
                             @change="setTileSet(selectedTileSet)">
                <label class="left">
                    <v-ons-radio
                            :input-id="'checkbox-' + index"
                            :value="index"
                            v-model="selectedTileSet"
                    >
                    </v-ons-radio>
                </label>
                <label class="center" :for="'checkbox-' + index">
                    {{ tileset.name }}
                </label>
            </v-ons-list-item>

        </v-ons-popover>

        {{watchLocation}}
        <div class="addMarker">
            <div class="center-textbox">
                <search-result-scope v-if="isArray"
                                     :style="{'margin-top': $ons.platform.isAndroidPhone() ? 5 + 'px' : 50 + 'px'}">
                    <v-ons-list-item v-for="(search, index) in resultItem" :key="index" @click="onResult(search)">
                        <div class="left">
                            <img style="object-fit: cover;" class="list-item__thumbnail" :src="search.photos | getPhoto">
                        </div>
                        <search-result :search="search"></search-result>
                    </v-ons-list-item>
                </search-result-scope>
            </div>
        </div>

        <div class="addMarker"  style="bottom: 0">
            <div style="display: flex;justify-content: center; ">
                <floating-map posiion="bottom left"></floating-map>
                <v-ons-fab
                        v-show="tempWatch"
                        position="bottom left"
                        class="btn-stop"
                        :visible="tempWatch"
                        @click="onStart"
                >
                    <v-ons-icon icon="md-gps-dot"></v-ons-icon>
                </v-ons-fab>
                <v-ons-fab
                        v-show="!tempWatch"
                        position="bottom left"
                        class="btn-btn"
                        :visible="!tempWatch"
                        @click="onStart"
                >
                    <v-ons-icon icon="md-gps-dot"></v-ons-icon>
                </v-ons-fab>
                <v-ons-fab
                        v-show="openFabInfo"
                        position="bottom right"
                        class="btn-btn"
                        :visible="openFabInfo"
                        @click="moreDetail"

                >
                    <v-ons-icon icon="fa-bars"></v-ons-icon>
                </v-ons-fab>

            </div>

        </div>
        <div id="snackbar" ref="snackbar" :class="isAlive.isWatch && totalDistance ? 'show' : ''">{{totalDistance ? totalDistance.toFixed(5) : ''}} km.</div>
        <div id="map"  style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"/>
    </v-ons-page>
</template>
<style scoped>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 401;
        left: 50%;
        top: 70px;
        font-size: 17px;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {top: 0; opacity: 0;}
        to {top: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {top: 0; opacity: 0;}
        to {top: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {top: 30px; opacity: 1;}
        to {top: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {top: 30px; opacity: 1;}
        to {top: 0; opacity: 0;}
    }
</style>
<script>
    import {tileSet} from './TileSet'
    import {getUserLocation, currentPageSwitcher,moreDetail,coordinateMap, change_view, PlantFound, userLocation, plantItem, gps_distance, PlantIndex, isWatch, isAlive} from './../Ajax/getData'
    export default{
        name: 'plant-item-map-view',
        filters:{
            getPhoto(photo){
                return !_.isEmpty(photo) ? 'images/thumb_' + photo[0].file : 'http://placekitten.com/g/40/40'
            }
        },
        props: {
            pageName: {
                type: String,
                required: false
            }
        },
        data(){
            return {
                fabVisible: true,
                onSearch: true,
                plantItem,
                openFabInfo: false,
                visible: true,
                keys: ['title'],
                fuse: '',
                searchQuery: '',

                plantFound: PlantFound,

                popoverVisible: false,
                popoverTarget: null,
                popoverDirection: 'up',
                coverTarget: false,

                numAttempts: 0,
                map: null,
                totalPanX: 6.7400,
                panStep: 0.001,
                totalPanY: 126.1817,
                markers: [],
                markerClusters: null,
                selectedTileSet: '3',
                userLocation: userLocation,

                userMarker: null,
                coordinateMap,
                trackId: '',
                polyline:null,
                trackingData: [],
                trackInfo: {
                    totalDistance: null,
                    totalMinute: null,
                    totalMilliseconds: null,
                    totalSecond: null
                },
                tileSets: tileSet,


                initialize: null,
                accuracy: null,
                altitude: null,
                heading: null,
                speed: null,
                positionOptions: {
                    enableHighAccuracy: true,
                    timeout: 20000,
                    maximumAge: 0,
                    distanceFilter: 1
                },
                tempWatch: false,
                watchId: null,
                resultFuse: [],
                result: null,
                isAlive,
                isOpen: false,
                stateFilter: 1,
                markerX:[],
                raduis: 0,
                line: null
            }
        },
        mounted(){
            var vm = this
            this.onMounted()
        },
        activated (){
            var vm = this
            if (vm.plantFound.index && vm.markers) {
                vm.onResult(vm.plantFound.index)
            }
        },
        computed: {
            mySigthing(){
                currentPageSwitcher("plant-navigator", 'My Sighting', 0)
            },
            isArray(){
                return _.isArray(this.resultItem)
            },
            watchLocation(){
                var vm = this
                return vm.markers == [] ? vm.getGoogleData() : null;
            },
            resultItem(){
                var vm = this
                if (vm.searchQuery.trim() === '')
                    return null
                else
                    return vm.fuse.search(vm.searchQuery.trim()).splice(0, 3)
            },
            getLocation(){
                return _.uniqWith(this.coordinateMap.coords, _.isEqual)
            },
            totalDistance(){
                var vm = this,
                    coord = vm.getLocation,
                    currentLocation = coord[coord.length - 1],
                    previousLocation = coord[coord.length - 2]
                return previousLocation && currentLocation ? vm.trackInfo.totalDistance += gps_distance(previousLocation.lat, previousLocation.lng, currentLocation.lat, currentLocation.lng) : null
            }
        },
        methods: {

            moreDetail(){
                var vm = this
                vm.offWatch()
                moreDetail()
            },
            onMounted(){
                var vm = this
                vm.markerClusters = L.markerClusterGroup();
                var userIcon = L.icon({
                    iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
                    iconSize: [32, 32]
                });
                vm.map = L.map('map', {
                    center: [10.0, 5.0],
                    minZoom: 2,
                    zoom: 2,
                    zoomControl: true
                })
                vm.map.zoomControl.setPosition('topleft');
                var options = {
                    shouldSort: true,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: vm.keys
                };
                vm.fuse = new Fuse(vm.resultFuse, options);
                vm.map.locate({setView: true, maxZoom: 15});
                vm.setTileSet(vm.selectedTileSet)
                vm.map.on('locationfound', vm.onLocationFound);
                vm.map.on('popupopen', function (e) {
                    PlantIndex(e.popup._source._id);
                    if (vm.isWatch) {
                        vm.onStart()
                    }
                    var floraLocation = new L.LatLng(e.popup._latlng.lat, e.popup._latlng.lng) || null;
                    vm.createPolyLine(floraLocation, vm.userLocation)
                    var latlongs = [floraLocation, vm.userLocation];
                    vm.polyline = new L.Polyline(latlongs, {
                        color: 'green',
                        opacity: 1,
                        weight: 1,
                        clickable: false
                    })
                    var px = vm.map.project(e.popup._latlng);
                    px.y -= e.popup._container.clientHeight / 2
                    vm.map.panTo(vm.map.unproject(px), {animate: true});
                    vm.$set(vm.$data, 'isOpen', true)
                    vm.openFabInfo = true
                });
                vm.map.on('popupclose', function (e) {
                    vm.$set(vm.$data, 'isOpen', false)
                    vm.openFabInfo = false
                });
            },
            onStart(){
                var vm = this;
                vm.tempWatch = !vm.tempWatch
                isWatch(vm.trackInfo.totalDistance)
                if (vm.isAlive.isWatch) {

                    vm.map.closePopup();

                    vm.map.flyTo(vm.userLocation, 15);
                    vm.onWatch()
                } else {
                    vm.trackInfo.totalDistance = null
                    vm.offWatch()

                }
            },
            offWatch(){
                var vm = this
                navigator.geolocation.clearWatch(this.watchId);
                if(vm.polyline){
                    vm.map.removeLayer(vm.polyline);
                }

                vm.map.removeLayer(vm.line)
                vm.coordinateMap.coords = []
            },
            onWatch(){
                var vm = this
                if(vm.polyline){
                    vm.map.addLayer(vm.polyline);
                }
                if (vm.userMarker) {
                    vm.map.addLayer(vm.userMarker);
                }
                if (vm.isAlive.isWatch) {
                    ('geolocation' in navigator) ?
                        vm.watchId =
                            navigator.geolocation.watchPosition
                            (
                                vm.onSuccess,
                                vm.onError,
                                vm.positionOptions
                            ) :
                        vm.initialize = 'Sorry, geolocation does not appear to be supported in this browser.'

                }
            },
            addMarker(lat, lng, ){
                var vm = this
                if (vm.userMarker) {
                    vm.map.removeLayer(vm.userMarker);
                }if (vm.userLocation) {
                    vm.map.removeLayer(vm.userLocation);
                }
                vm.coordinateMap.coords.push(L.latLng(lat, lng));
                var userIcon = L.icon({
                    iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
                    iconSize: [32, 32]
                });
                vm.userMarker =L.marker(L.latLng(lat, lng), {
                    icon: userIcon,
                    title: "marker_",
                    name: 'User Location',
                    content: 'you are here',
                    image: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png'
                }).bindPopup("You are within " + vm.radius + " meters from this point").openPopup().addTo(vm.map);
                vm.line = L.polyline(vm.coordinateMap.coords);
                vm.map.fitBounds(vm.line.getBounds());
                vm.map.addLayer(vm.line);
                vm.map.panTo([lat, lng], 20)
            },
            onResult(search){
                var vm = this, plant = _.findIndex(this.markers, {options: {id: search.id}});
                vm.searchQuery = ''
                vm.markerFunction(plant)
            },
            onSuccess (position) {

                var vm = this,
                    lat = position.coords.latitude,
                    lng = position.coords.longitude
                getUserLocation(position.coords)
               /* var userLocation = L.marker([e.latlng.lat, e.latlng.lng], {
                    icon: userIcon,
                    title: "marker_",
                    name: 'User Location',
                    content: 'you are here',
                    image: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png'
                }).bindPopup("You are within " + radius + " meters from this point").openPopup();*/

                vm.radius = position.coords.accuracy / 2;
                vm.numAttempts++
                vm.initialize = 'Success! Attempt ' + vm.numAttempts + ' results:'
                vm.userLocation.lat = position.coords.latitude
                vm.userLocation.lng = position.coords.longitude
                vm.accuracy = "Accuracy: " + position.coords.accuracy + ' meters'
                vm.altitude = "Altitude: " + position.coords.altitude || 'null'
                vm.heading = "Heading: " + position.coords.heading || 'null'
                vm.speed = "Speed: " + position.coords.speed || 'null'
                //frame.setAttribute('src', frameUrl + position.coords.latitude + ',' + position.coords.longitude)
                setTimeout(function () {
                    vm.initialize = "Success!"
                }, 1000)
                new google.maps.LatLng(lat, lng);
                vm.addMarker(lat, lng);
            },
            onError: function (error) {
                var msg = 'An unknown error occurred while requesting your location.'
                // https://www.w3.org/TR/geolocation-API/#position_error_interface
                switch (error.code) {
                    case 1:
                        msg = 'The document does not have permission to use the Geolocation API.'
                        break
                    case 2:
                        msg = 'The position of the device could not be determined.'
                        break
                    case 3:
                        msg = 'The position request timed out.'
                        break
                    default:
                        break
                }
            },
            onLocationFound(e) {
                var vm = this
                var radius = e.accuracy / 2;
                var userIcon = L.icon({
                    iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png',
                    iconSize: [32, 32]
                });
                var userLocation = L.marker([e.latlng.lat, e.latlng.lng], {
                    icon: userIcon,
                    title: "marker_",
                    name: 'User Location',
                    content: 'you are here',
                    image: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-64.png'
                }).bindPopup("You are within " + radius + " meters from this point").openPopup().addTo(vm.map);
                vm.map.initlat = e.latlng.lat;
                vm.map.initlng = e.latlng.lng
//                vm.markerClusters.addLayer(userLocation);
                vm.markers.push(userLocation);
                vm.map.addLayer(userLocation)
                vm.userMarker = userLocation
                vm.userLocation = new L.LatLng(e.latlng.lat, e.latlng.lng);
                vm.getGoogleData()
            },
            changeView(){
                change_view()
            },
            showPopover(event, direction, coverTarget = false) {
                var vm = this;
                vm.popoverTarget = event;
                vm.popoverDirection = direction;
                vm.coverTarget = coverTarget;
                vm.popoverVisible = true;
            },
            displayLocation(position) {
                var vm = this
                console.log('position', position);
                var lat = 6.7400;
                var lng = 126.1817;
                var userLocation = L.marker([lat, lng], {icon: userIcon}).bindPopup('<h2> Your Locations</h2>');
                vm.map.setView([lat, lng], 16);
                vm.markerClusters.addLayer(userLocation);
                vm.markers.push(userLocation);
                vm.map.addLayer(vm.markerClusters)
                vm.userLocation = new L.LatLng(lat, lng);
                vm.getGoogleData()
            },
            setTileSet(selectedTileLayer){
                var vm = this;
                var basemap = null
                var tileLayer = _.parseInt(selectedTileLayer)
                var tile = this.tileSets.all[tileLayer]
                if (tile.name == 'OpenStreetMap') {
                    basemap = L.tileLayer(tile.tileLayer, {
                        attribution: tile.attribution
                    })
                } else {
                    basemap = L.tileLayer(tile.tileLayer, {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    });
                }
                if (vm.map.hasLayer(basemap)) {
                    vm.map.removeLayer(basemap);
                }
                else {
                    vm.map.addLayer(basemap);
                }
            },
            markerFunction(id) {
                if(id != -1){
                    var vm = this
                    vm.offWatch()
                    var marker = vm.markers[id]
                    var itemObject = marker.options;
                    PlantIndex(itemObject.id)
//                    currentPageSwitcher('plant-navigator', 'View Plant Repository')
                    var position = marker.getLatLng();
                    var floraLocation = new L.LatLng(position.lat, position.lng) || null;
                    var userDistance = floraLocation ? vm.createPolyLine(floraLocation, vm.userLocation) : null;
                    vm.map.setView(position, 15);
                    vm.markers[id]._popup._content = '<div style="z-index: 402; max-width: 80vw;"><h2>' + itemObject.title + '</h2>' + userDistance + itemObject.content + '<img style="width: 100%;" src="images/' + itemObject.image + '" /> ' + '</div>' || null
                    if (!marker._icon) marker.__parent.spiderfy();
                    marker.openPopup();
                }
            },
            createPolyLine(floraLocation, userLocation){
                return 'About ' + (floraLocation.distanceTo(userLocation) / 1000).toFixed(0) + 'km away from you.</p>';
            },
            getGoogleData: function () {
                var vm = this, userDistance = null
                _.forEach(plantItem.all, function (val, i) {
                    if (val.latitude && val.longitude && val.published === 1){
                        vm.resultFuse.push(val)
                        var photo = !_.isEmpty(val.photos) ? val.photos[0].file : 'http://placekitten.com/g/40/40'
                        var floralocation = new L.LatLng(val.latitude, val.longitude);
                        vm.userLocation ? userDistance = vm.createPolyLine(floralocation, vm.userLocation) : null;
                        var markerX = L.marker([val.latitude, val.longitude], {
                            icon: L.divIcon({
                                html: '<img style="width: 100%;" src="images/thumb_' + photo + '"/>',
                                // Specify a class name we can refer to in CSS.
                                className: 'image-icon',
                                // Set a markers width and height.
                                iconSize: [36, 36]
                            }),
                            id: val.id,
                            title: val.title,
                            name: val.title,
                            content: val.description,
                            image: photo,
                            closeOnClick: true
                        }).bindPopup('<div style="z-index: 402; max-width: 80vw; "><h2>' + val.title  + '</h2>' + userDistance  + val.description + '<img style="width: 100%;" src="images/' + photo + '"/>' + "</div>");
                        markerX._id = val.id
                        vm.markerClusters.addLayer(markerX);
                        vm.markers.push(markerX);
                        vm.map.setView(floralocation, 15);
                        vm.map.addLayer(vm.markerClusters)
                    }
                });
                if (vm.plantFound.index) {
                    vm.onResult(vm.plantFound.index)
                }
                if (!vm.isOpen) {
                    vm.openFabInfo = false
                    vm.map.flyTo(vm.userLocation, 15);
                }
                if (vm.fuse) {
                    vm.resultFuse = null
                }
            },
        },
    }
</script>