<template>
    <div>
        <component v-bind:is="currentView"></component>
    </div>
</template>
<style>

</style>
<script>
    import {getData} from './Ajax/getData'
    export default{

        data(){
            return {}
        },
        mounted(){
            getData()
        },
        computed: {
            currentView(){
                var vm = this
                return vm.$ons.platform.isBlackBerry() || vm.$ons.platform.isAndroidTablet() || vm.$ons.platform.isAndroidPhone() || vm.$ons.platform.isIPhone() || vm.$ons.platform.isIPad() || vm.$ons.platform.isIOS7above()  ? 'splitter-content' : 'app-browser'
            }
        }
    }
</script>
