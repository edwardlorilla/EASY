<template>
    <div>
    <div v-if="countDashboard" class="w3-row-padding w3-margin-bottom">
        <div class="w3-third">
            <div class="w3-container w3-red w3-padding-16">
                <div class="w3-left"><i class="fa fa-leaf w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>{{countDashboard.repositories}}</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Repositories</h4>
            </div>
        </div>
        <div class="w3-third">
            <div class="w3-container w3-teal w3-padding-16">
                <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>{{countDashboard.share}}</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Shares</h4>
            </div>
        </div>
        <div v-if="countDashboard.user" class="w3-third">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>{{countDashboard.user }}</h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Users</h4>
            </div>
        </div>
    </div>

    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">

            <div >
                <h5>Feeds</h5>
                <table class="w3-table w3-striped w3-white">
                    <tr  v-for="activity in userActivity.list">
                        <td>{{activity.user}}</td>
                        <td>{{activity.method}}</td>
                        <td><i class="fa w3-large" :class="activity.tag"></i></td>
                        <td>{{activity.subject}}</td>
                        <td><i>{{activity.updated_at | humanReadableTime}}</i></td>
                    </tr>
                </table>
            </div>
            <!--<div>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-user w3-text-blue w3-large"></i></td>-->
                    <!--<td>New record, over 90 views.</td>-->
                    <!--<td><i>10 mins</i></td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-bell w3-text-red w3-large"></i></td>-->
                    <!--<td>Database error.</td>-->
                    <!--<td><i>15 mins</i></td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-users w3-text-yellow w3-large"></i></td>-->
                    <!--<td>New record, over 40 users.</td>-->
                    <!--<td><i>17 mins</i></td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-comment w3-text-red w3-large"></i></td>-->
                    <!--<td>New comments.</td>-->
                    <!--<td><i>25 mins</i></td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>-->
                    <!--<td>Check transactions.</td>-->
                    <!--<td><i>28 mins</i></td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-laptop w3-text-red w3-large"></i></td>-->
                    <!--<td>CPU overload.</td>-->
                    <!--<td><i>35 mins</i></td>-->
                <!--</tr>-->
                <!--<tr>-->
                    <!--<td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>-->
                    <!--<td>New shares.</td>-->
                    <!--<td><i>39 mins</i></td>-->
                <!--</tr>-->
            <!--</div>-->
        </div>
    </div>


    </div>
</template>
<style>
</style>
<script>
    import {countDashboard, userActivity} from './Ajax/getData'
    export default{
        data(){
            return {
                countDashboard,
                userActivity
            }
        },

    }
</script>
