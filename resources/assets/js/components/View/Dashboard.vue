<template>
    <v-ons-page id="main">
        <v-ons-toolbar>
            <div class="left">
                <v-ons-toolbar-button @click="changeView">
                    <v-ons-icon icon="ion-navicon, material:md-menu"></v-ons-icon>
                </v-ons-toolbar-button>
            </div>
            <div class="center">Dashboard</div>
        </v-ons-toolbar>
        <v-ons-list>
            <div class="w3-flat-wet-asphalt profile-card">

                <!-- <img src="images/profile-image-01.png" class="profile-image">
                 <div class="profile-name">Dave Graham</div>
                 <div class="profile-id">@davegraham</div>-->
                <div class="profile-desc">The Mount Hamiguitan range, with an area of 6,834 hectares (68.34 km2), was
                    declared a national park and a wildlife sanctuary in 2003. In 2014, the park was inscribed as a
                    UNESCO World Heritage Site, becoming the first in Mindanao.
                </div>

            </div>
            <section class="home-grid">
                <div class="grid-menu">
                    <div class="centering-and-alignment" v-for="grid in gridList">
                        <div v-for="list in grid" :class="list.color" @click="dashView( list.url, list.label)"
                             class="grid-menu-item list__item list__item--tappable">
                            <v-ons-icon :icon="list.icon"></v-ons-icon>
                            <div class="grid-menu-item-label">{{list.label}}</div>
                        </div>
                    </div>
                </div>
            </section>
        </v-ons-list>
    </v-ons-page>

    </div>
</template>
<style scoped>
    /* Profie */

    /* Grid Menu */
    .grid-menu {
        width: 100%;

    }

    .float-left {
        float: left;
    }

    .centering-and-alignment {
        display: box;
        display: -ms-box;
        display: -moz-box;
        display: -o-box;
        display: -webkit-box;
        box-align: center;
        -ms-box-align: center;
        -moz-box-align: center;
        -o-box-align: center;
        -webkit-box-align: center;
        box-pack: center;
        -ms-box-pack: center;
        -moz-box-pack: center;
        -o-box-pack: center;
        -webkit-box-pack: center;
    }

    .grid-menu-item {
        width: 50%;
        height: 100%;
        min-width: 100px;
        min-height: 100px;
        margin: 0;
        padding: 0;
        border-left: 1px solid #cecece !important;
        border-bottom: 1px solid #cecece !important;
        font-size: 48px;
        text-align: center;

    }

    .grid-menu-item:first-child {
        border-left: none !important;
    }

    .grid-menu-item ons-icon {
        margin-top: 20px;
        font-size: 36px;
    }

    .grid-menu-item-label {
        font-size: 16px;
    }

    .grid-menu-item.topcoat-list__item {
        border: none;
    }

    /* Onsen Ranges */
    .margin-top-adjust {
        margin-top: -1px;
    }

    .list-item-left {
        display: inline-block;
        width: 10%;
        text-align: center;
    }

    .list-item-center {
        display: inline-block;
        width: 75%;
        text-align: center;
    }

    .range-center {
        width: 100%;
        vertical-align: -10px;
    }

    .list-item-right {
        display: inline-block;
        width: 10%;
        text-align: center;
    }

    .lower {
        opacity: 0.4;
    }

    /* Extra style rule for the Home Grid home.html */
    .home-grid {
        padding: 0 0 20px 0;
    }

    /* Fix for Onsen 1.2.2 */
    .navigation-bar__title {
        text-overflow: ellipsis;
        overflow: hidden;
        height: auto;
    }

    .navigation-bar--android__center {
        max-width: 50%;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .row-center {
        text-align: center;
    }
</style>
<script>
    import {change_view, currentPageSwitcher}  from './../Ajax/getData'
    export default{
        data(){
            return {
                gridList: [
                    [
                        {
                            icon: 'fa-leaf',
                            color: 'w3-flat-turquoise',
                            label: 'Repositories of Plants',
                            url: 'plant-navigator'
                        },
                        {
                            icon: 'ion-images',
                            color: 'w3-flat-green-sea',
                            label: 'Gallery',
                            url: 'plant-navigator'
                        },
                    ],
                    [
                        {
                            icon: 'fa-map-marker',
                            color: 'w3-flat-peter-river',
                            label: 'Map',
                            url: 'navigation-map'
                        },
                        {
                            icon: 'fa-comment',
                            color: 'w3-flat-belize-hole',
                            label: 'Contact Us!',
                            url: 'chat-manage'
                        }
                    ],
                    [
                        {
                            icon: 'md-settings',
                            color: 'w3-flat-amethyst',
                            label: 'Setting',
                            url: 'view-settings'
                        },
                        {
                            icon: 'fa-history',
                            color: 'w3-flat-wisteria',
                            label: 'Recent',
                            url: 'navigation-timeline'
                        }
                    ],
                    [
                        {
                            icon: 'fa-comments',
                            color: 'w3-flat-alizarin',
                            label: 'Feedback',
                            url: 'view-settings'
                        },
                        {
                            icon: 'fa-question-circle',
                            color: 'w3-flat-pomegranate',
                            label: 'Help',
                            url: 'navigation-timeline'
                        }
                    ]
                ]
            }
        },
        mounted()
        {
            var vm = this;


        },
        methods: {
            changeView(){
                var vm = this
                change_view()
                vm.onBack = true
            },
            dashView(url, name){
                currentPageSwitcher(url, name)
            }
        }
    }
</script>
