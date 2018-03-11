<template>
    <div @click="edit(item)">
        <img v-if="item.photos[0]" :src="item.photos[0] ? '/images/thumb_' + item.photos[0].file : ''"
             :alt="item.title"

             style="object-fit: cover;width: 100%; height:200px;" class="w3-hover-opacity"/>
        <vue-initials-img size="200" v-else :name="item.title || 'admin'"/>
        <div class="w3-container w3-white">
            <p><b>{{item.title}}</b></p>
            <p>{{item.description ? item.description.substring(0, 30) : item.description  }}</p>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default{
       props:['item', 'edit']
    }
</script>
