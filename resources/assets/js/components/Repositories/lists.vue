<template>


    <table class="w3-table w3-bordered w3-striped w3-border test w3-hoverable">
        <tr class="w3-green">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Points</th>
        </tr>
        <tbody>
        <tr>
            <td>Jill</td>
            <td>Smith</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Eve</td>
            <td>Jackson</td>
            <td>94</td>
        </tr>
        <tr>
            <td>Adam</td>
            <td>Johnson</td>
            <td>67</td>
        </tr>
        <tr>
            <td>Bo</td>
            <td>Nilsson</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Mike</td>
            <td>Ross</td>
            <td>35</td>
        </tr>
        </tbody>
    </table>

</template>
<style>
</style>
<script>
    export default{
        props: ['item'],
        data(){
            return{
                msg:'hello vue'
            }
        },
    }
</script>
