<template>
    <div>
        <div >{{data.color}}this is template body</div>
    </div>
</template>
<style>

</style>
<script>
    export default{
        name: 'PopupContent',
        props: {
            data: {
                type: Object,
                default: () => ({ type: '', color: '#ffffff'}),
        },
    }
    }
</script>
