<template>
    <div>
        <div class="w3-panel w3-bottombar w3-margin">
            <h2>Edit Repository</h2>
        </div>
        <div v-if="repositoryEdit.edit " class="w3-row">
            <div class="w3-container w3-half">
                <img v-if="repositoryEdit.edit.photos && !image && repositoryEdit.edit.photos[0]"
                     style="width: 90%; object-fit: cover; height:200px;"
                     ref="imag"
                     :src="'/images/' +  repositoryEdit.edit.photos[0].file" alt="">

                 <div v-if="!image">

                     <section>
                         <h2 v-if="repositoryEdit.edit.published !== 0">Select an image</h2>
                         <input type="file" ref="fileOnChange" @change="onFileChange" accept="image/*" capture="camera"
                                style="display:none;">
                         <v-ons-button v-if="repositoryEdit.edit.published !== 0" @click="buttonFile" class="btn" modifier="large">Edit Plant
                         </v-ons-button>
                     </section>
                 </div>
                <img v-else ref="imag" style="width: 90%; object-fit: cover; height:300px;" :src="image"/>
                <div id="pallete">
                    <div v-for="pallete in repositoryEdit.edit.palletes" class="base_color"
                         :style="{'background-color': 'rgb(' + pallete.join( ', ') + ')' }"></div>
                </div>
                <br>
                <div v-if="plantItem.all && repositoryEdit.edit.shared === 1">
                    <label>Identified as:</label>
                    <el-select
                            v-model="repositoryEdit.edit.repository_id"
                            filterable
                            placeholder="Select">
                        <el-option
                                v-for="(item, index) in publishedPlant"
                                v-if="item.published === 1"
                                :key="index"
                                :label="item.title"
                                :value="item.id">
                        </el-option>
                    </el-select>
                </div>
                <br>
                <div>
                    <label>Name</label>
                    <input v-model="repositoryEdit.edit.title" class="w3-input w3-border" type="text"
                           placeholder="Name">
                </div>
                <div>
                    <label>Economic Importance</label>
                    <textarea name="economicImportance" v-model="repositoryEdit.edit.economicImportance"
                              class="w3-input w3-border"></textarea>

                </div>
                <div>
                    <label>Description</label>
                    <textarea name="description" v-model="repositoryEdit.edit.description"
                              class="w3-input w3-border"></textarea>

                </div>

            </div>
            <div class="w3-container w3-half">
                 <div v-if="repositoryEdit.edit.shared !== 1">
                     <label>Status</label>
                     <input class="w3-radio" value="1" v-model.number="repositoryEdit.edit.published" type="radio"
                            name="status">
                     <label>Published</label>

                     <input class="w3-radio" value="0" v-model.number="repositoryEdit.edit.published" type="radio"
                            name="status">
                     <label>Unpublished</label>
                 </div>
                <div v-if="repositoryEdit.edit && repositoryEdit.edit.shared === 1 " class="w3-row-padding">

                    <header class="w3-container w3-light-grey">
                        <h3>  {{repositoryEdit.edit.user.name}}</h3>
                    </header>
                    <br>
                    <div class="w3-half">
                       <div class=" w3-margin-right w3-left ">
                           <img v-if="repositoryEdit.edit.user.photos" :src="'/thumb_' + repositoryEdit.edit.user.photos[0]" class="w3-circle" style="width:60px">
                           <vue-initials-img v-else :name="repositoryEdit.edit.user.name || 'admin'"/>
                       </div>

                    </div>
                    <div class="w3-half">

                        <div v-if="repositoryEdit.edit.user.firstName">{{repositoryEdit.edit.user.firstName}} <br></div>
                        <div v-if="repositoryEdit.edit.user.lastName">{{repositoryEdit.edit.user.lastName}} <br></div>
                        <p>{{repositoryEdit.edit.user.email}}</p><br>
                    </div>
                    <br>
                    <div class="w3-bar">
                        <button class="w3-bar-item w3-button w3-block w3-ripple  w3-green" style="width: 50%"  :disabled="!repositoryEdit.edit.repository_id" @click="addBaseColor">Idenfied plant</button>
                        <button class="w3-bar-item w3-button w3-block w3-ripple  w3-purple" style="width: 50%"  @click="sendResearcher">Send to Researcher</button>
                    </div>
                </div>
                <hr>
                <div class="w3-row-padding">

                    <div class="w3-third">
                        <label>Species</label>
                        <input v-model="repositoryEdit.edit.species" class="w3-input w3-border" type="text"
                               placeholder="Species">
                    </div>
                    <div class="w3-third">
                        <label>Common Name</label>
                        <input v-model="repositoryEdit.edit.commonName" class="w3-input w3-border" type="text"
                               placeholder="Common Name">
                    </div>
                    <div class="w3-third">
                        <label>Scientific Name</label>
                        <input v-model="repositoryEdit.edit.scientificName" class="w3-input w3-border" type="text"
                               placeholder="Scientific Name">
                    </div>
                </div>

                <p></p>

                <div class="w3-row-padding">
                    <div class="w3-third">
                        <label>Latitude</label>
                        <input v-model.number="repositoryEdit.edit.latitude" class="w3-input w3-border" type="number"
                               placeholder="Latitude">
                    </div>
                    <div class="w3-third">
                        <label>Longitude</label>
                        <input v-model.number="repositoryEdit.edit.longitude" class="w3-input w3-border" type="number"
                               placeholder="Longitude">
                    </div>
                    <div class="w3-third">
                        <label>Altitude</label>
                        <input v-model.number="repositoryEdit.edit.altitude" class="w3-input w3-border" type="number"
                               placeholder="Altitude">
                    </div>
                </div>

                <p></p>

                <div class="w3-row-padding">

                    <div class="w3-third">
                        <label>Plant Families</label>
                        <select class="w3-select w3-border" v-model="selected.family" name="option">
                            <option value="" disabled selected>Select Plant Family</option>
                            <option v-for="family in allId.families" :value="family.id">{{family.name}}</option>
                        </select>
                    </div>
                    <div class="w3-third">
                        <label>Classification</label>
                        <select class="w3-select w3-border" v-model="selected.category" name="option">
                            <option value="" disabled selected>Select Classification</option>
                            <option v-for="category in allId.categories" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                    <div class="w3-third">
                        <label>Distribution</label>
                        <select class="w3-select w3-border" v-model="selected.distribution" name="option">
                            <option value="" disabled selected>Select Distribution</option>
                            <option v-for="distribution in allId.distributions" :value="distribution.id">
                                {{distribution.name}}
                            </option>
                        </select>
                    </div>

                    <p v-if="selectedPlant"></p>

                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label>Vegetation Type</label>
                            <!--<select multiple class="w3-select w3-border" v-model="selected.vegetation" name="option">
                                <option value="" disabled selected></option>
                                <option v-for="vegetation in allId.vegetations" :value="vegetation.id">
                                    {{vegetation.name}}
                                </option>
                            </select>-->
                            <el-select v-model="selected.vegetation" multiple clearable placeholder="Vegetation Type">
                                <el-option
                                        v-for="vegetation in allId.vegetations"
                                        :key="vegetation.id"
                                        :label="vegetation.name"
                                        :value="vegetation.id">
                                </el-option>
                            </el-select>
                        </div>
                        <div class="w3-half">
                            <label>Estimated Density</label>
                            <select class="w3-select w3-border" v-model="repositoryEdit.edit.estimatedDensity"
                                    name="option">
                                <option value="" disabled selected>Select Classification</option>
                                <option v-for="density in estimatedDensity" :value="density.id">
                                    {{density.name}}
                                </option>
                            </select>


                        </div>
                    </div>
                    <div class="w3-container w3-center w3-margin-top">

                        <button v-if="repositoryEdit.edit.shared === 0" class="w3-btn w3-ripple w3-large w3-blue" @click="deleteRepository">Delete</button>
                        <button v-if="repositoryEdit.edit.shared === 0" class="w3-btn w3-ripple w3-large w3-green" @click="addBaseColor">Update </button>
                        <button :disabled="!(repositoryEdit.edit.latitude && repositoryEdit.edit.longitude && repositoryEdit.edit.published === 1)"
                                v-if="repositoryEdit.edit.published === 1" class="w3-btn w3-ripple w3-large w3-blue"
                                @click="locatePlant">Locate
                        </button>
                        <router-link to="/repositories" class="w3-btn w3-ripple w3-large w3-red">Cancel</router-link>
                    </div>

                </div>

            </div>


        </div>
    </div>
</template>
<style>
</style>
<script>
    import {
        getData,
        plantItem,
        allId, plantPush,
        repositoryEdit,
        editRepository,
        plantInfoBrowser,
        removePlant,
        updateRepository,
        currentPage,
        capturePhoto,
        cnvrtRGBClrToHex,
        hexColorDelta,
        cameraInfo,
        urltoFile,
        getSimilar,
        setSimilar,
        togglerViewFunc
    } from './../Ajax/getData'
    export default{
        data(){
            return {
                identifiedPlant: null,
                plantItem,
                repositoryEdit: {
                    edit: null
                },
                hostName: window.location.hostname,
                allId,
                selected: {
                    category: null,
                    distribution: null,
                    family: null,
                    vegetation: [],
                    density: null
                },
                estimatedDensity: [
                    {id: 1, name: 'High'},
                    {id: 2, name: 'Medium'},
                    {id: 3, name: 'Low'}
                ],
                image: '',
                palletes: null,
                hexColor: [],
            }
        },
        methods: {
            locatePlant(){
                var vm = this
                plantInfoBrowser({
                    latitude: vm.repositoryEdit.edit.latitude,
                    longitude: vm.repositoryEdit.edit.longitude,
                    id: vm.repositoryEdit.edit.id
                })
                vm.$router.push('/geo')
            },
            buttonFile(){
                var vm = this
                vm.$refs.fileOnChange.click()
            },
            sortList(value){
                return value.splice(0, 5)
            },
            getPhoto(photo){
                return !_.isEmpty(photo.file) ? '/images/thumb_' + photo.file : photo
            },
            hexColorDelta(hex1, hex2) {
                return hexColorDelta(hex1, hex2)
            },
            onFileChange(e) {
                this.hexColor = []
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            sendResearcher(){
                axios.get(`/api/researcher/${firebase.auth().currentUser.uid}/${vm.repositoryEdit.edit.id}`)
            },
            createImage(file) {

                //urltoFile(url, file.name, mimeType)
                var image = new Image();
                var reader = new FileReader();
                var vm = this;
                vm.urlFile = file

                reader.onload = function (event) {
                    // The file's text will be printed here
                    vm.image = event.target.result
                };

                reader.readAsDataURL(file);
                var img = this.$refs.imag
                if (img.naturalWidth) {
                    vm.onImageLoad(img);
                } else {
                    img.onload = function () {
                        vm.onImageLoad(img);
                    };
                }
            },
            removeImage: function (e) {
                var vm = this
                vm.image = '';
                vm.hexColor = [],
                    vm.palletes = null
                vm.repositoryInfo.title = ''
                vm.repositoryInfo.description = ''
            },
            onImageLoad(img){
                var vm = this
                var colorThief = new ColorThief();
                var rgb = colorThief.getPalette(img);
                vm.palletes = rgb
                for (var j = 0; j < rgb.length; j++) {
                    vm.hexColor.push(vm.cnvrtRGBClrToHex(rgb[j].join(', ')))
                }

            },
            cnvrtRGBClrToHex(rgbClr){
                return cnvrtRGBClrToHex(rgbClr)
            },
            palletesConvertHex(){
                var vm = this
                return _.map(vm.palletes, function (obj) {
                    return vm.cnvrtRGBClrToHex(obj.toString())
                });
            },
            addBaseColor(){
                var vm = this,
                    hexArray = vm.palletesConvertHex();
                vm.repositoryEdit.edit.identified = vm.repositoryEdit.edit.shared === 1 ?  1 : 0

                vm.disabledButton = true
                //post image, pallete, repository infomation to the database, if the netword is not exist, then gonna go local storage
                updateRepository(vm.image, vm.repositoryEdit.edit, vm.selected, firebase.auth().currentUser.uid).then(function (response) {
                    new Noty({
                        timeout: 5000,
                        type: 'success',
                        layout: 'topRight',
                        text: response
                    }).show();

                    vm.$router.push('/repositories')
                }).catch(function (error) {
                    new Noty({
                        timeout: 5000,
                        type: 'error',
                        layout: 'topRight',
                        text: error.response.statusText
                    }).show();
                });

            },
            deleteRepository(){
                //api/repository/admin/delete{repository}/{firebase}
                var vm = this
                axios.get(`/api/repository/admin/delete/${vm.repositoryEdit.edit.id}/${firebase.auth().currentUser.uid}`).then(function (response) {
                    new Noty({
                        timeout: 5000,
                        type: 'success',
                        layout: 'topRight',
                        text: response
                    }).show();
                    removePlant(vm.repositoryEdit.edit.id)
                    vm.$router.push('/repositories')
                }).catch(function (error) {
                    new Noty({
                        timeout: 5000,
                        type: 'error',
                        layout: 'topRight',
                        text: error.response.statusText
                    }).show();
                });
            },
            setData(data){
                var vm = this
                vm.selected.distribution = data.distribution_id
                vm.selected.category = data.category_id
                vm.selected.family = data.family_id
                vm.selected.vegetation = _.map(data.vegetations, 'id');
                vm.selected.density = data.estimatedDensity
            }
        },
        mounted(){

            var vm = this

            if (capturePhoto) {
                vm.onFileChange(capturePhoto)
            }

        },
        computed: {
            publishedPlant(){
                var vm = this
                return vm.repositoryEdit.edit ? ( vm.repositoryEdit.edit.shared === 1 ? _.filter(plantItem.all, function (data) {
                    return data.published === 1
                }) : null) : null
            },
            selectedPlant(){
                var vm = this

                var index = _.findIndex(vm.publishedPlant, ['id', vm.repositoryEdit.edit.repository_id]);
                if (index != -1 && vm.publishedPlant) {

                    vm.repositoryEdit.edit.category = vm.publishedPlant[index].category
                    vm.repositoryEdit.edit.category_id = vm.publishedPlant[index].category_id
                    vm.repositoryEdit.edit.commonName = vm.publishedPlant[index].commonName
                    vm.repositoryEdit.edit.description = vm.publishedPlant[index].description
                    vm.repositoryEdit.edit.distribution = vm.publishedPlant[index].distribution
                    vm.repositoryEdit.edit.distribution_id = vm.publishedPlant[index].distribution_id
                    vm.repositoryEdit.edit.economicImportance = vm.publishedPlant[index].economicImportance
                    vm.repositoryEdit.edit.estimatedDensity = vm.publishedPlant[index].estimatedDensity
                    vm.repositoryEdit.edit.family = vm.publishedPlant[index].family
                    vm.repositoryEdit.edit.family_id = vm.publishedPlant[index].family_id
                    vm.repositoryEdit.edit.localName = vm.publishedPlant[index].localName
                    vm.repositoryEdit.edit.location = vm.publishedPlant[index].location
                    vm.repositoryEdit.edit.pathwaySpread = vm.publishedPlant[index].pathwaySpread
                    vm.repositoryEdit.edit.scientificName = vm.publishedPlant[index].scientificName
                    vm.repositoryEdit.edit.specie = vm.publishedPlant[index].specie
                    vm.repositoryEdit.edit.threats = vm.publishedPlant[index].threats
                    vm.repositoryEdit.edit.title = vm.publishedPlant[index].title

                    vm.selected.distribution = vm.publishedPlant[index].distribution_id
                    vm.selected.category = vm.publishedPlant[index].category_id
                    vm.selected.family = vm.publishedPlant[index].family_id
                    vm.selected.vegetation = _.map(vm.publishedPlant[index].vegetations, 'id');
                    vm.selected.density = vm.publishedPlant[index].estimatedDensity

                }


                return vm.repositoryEdit.edit ? ( index != -1 ? vm.publishedPlant[index] : null) : null
            }
        },
        beforeRouteEnter (to, from, next) {

            getData().then(function () {
                next(function (vm) {
                    vm.setData(vm.repositoryEdit.edit = editRepository(to.params.id))
                })
            })
        },
        beforeRouteUpdate (to, from, next) {
            console.log(to.params.id)
        },
        beforeMount(){
            var vm = this

        },
        beforeDestroy(){
        }
    }
</script>
