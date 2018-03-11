<template>
    <div class="w3-bar-block">
        <a class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" @click="$emit('w3_close')" title="close menu"><i class="fa fa-remove fa-fw"></i>&nbsp; Close Menu</a>
        <router-link to="/" class="w3-bar-item w3-button w3-padding">
            <i class="fa fa-eye fa-fw"></i>&nbsp; Overview
        </router-link>
        <router-link to="/users" class="w3-bar-item w3-button w3-padding" >
            <i class="fa fa-users fa-fw"></i>&nbsp; Users
        </router-link>
        <router-link to="/repositories" class="w3-bar-item w3-button w3-padding" >
            <i class="fa fa-leaf" aria-hidden="true"></i>&nbsp; Book of Flora
        </router-link>
        <div  class="w3-dropdown-hover">
            <button @click="myAccFunc" class="w3-button">
                Scientific Information <i class="fa" :class="dropHover ? 'fa-caret-down' : 'fa-caret-up'"></i>
            </button>

            <div  ref="dropdown" class="w3-bar-block w3-show w3-padding-large w3-medium">
                <router-link  to="/plant/families" class="w3-bar-item w3-button w3-padding fa fa-pagelines" >
                    &nbsp; Plant Family <span class="w3-right w3-tag w3-purple ">{{scientificInformationCount ? scientificInformationCount.family : '0'}}</span>
                </router-link>
                <router-link to="/plant/classification" class="w3-bar-item w3-button w3-padding fa fa-tags" >
                    &nbsp; Plant Classification <span class="w3-right w3-tag w3-pink ">{{scientificInformationCount ? scientificInformationCount.classification : '0'}}</span>
                </router-link>
                <router-link to="/plant/vegetation" class="w3-bar-item w3-button w3-padding fa fa-tree" >
                    &nbsp; Plant Vegetation <span class="w3-right w3-tag w3-cyan ">{{scientificInformationCount ? scientificInformationCount.vegetation : '0'}}</span>
                </router-link>
                <router-link to="/plant/distribution" class="w3-bar-item w3-button w3-padding fa fa-sun-o" >
                    &nbsp; Plant Distribution <span class="w3-right  w3-tag w3-lime ">{{scientificInformationCount ? scientificInformationCount.distribution : '0'}}</span>
                </router-link>
            </div>
        </div>


        <router-link to="/geo" class="w3-bar-item w3-button w3-padding" >
            <i class="fa fa-bullseye fa-fw" aria-hidden="true"></i>&nbsp; Geo
        </router-link>
       <!-- <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>&nbsp; Orders</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>&nbsp; News</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>&nbsp; General</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>&nbsp; History</a>
        <a class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>&nbsp; Settings</a><br><br>-->
    </div>
</template>

<script>
    import {scientificInformationCount} from './Ajax/getData'
    export default{
        data(){
            return{
                dropHover: true,
                scientificInformationCount
            }
        },
        methods:{
            myAccFunc() {
                var vm = this
                console.log(1)
                var x = vm.$refs.dropdown;
                if (x.className.indexOf("w3-show") == -1) {
                    vm.dropHover = true
                    x.className += " w3-show";

                } else {
                    vm.dropHover = false
                    x.className = x.className.replace(" w3-show", " w3-hide");
                }
            }

        },
        computed: {
            routes: function () {
                var routes = [];
                for (var i in this.$router.options.routes) {
                    if (!this.$router.options.routes.hasOwnProperty(i)) {
                        continue
                    }
                    var route = this.$router.options.routes[i];
                    if(route.hasOwnProperty('title')) {
                        routes.push(route);
                    }
                }
                return routes;
            }
        }
    }
</script>
