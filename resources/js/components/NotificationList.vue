<template>
    <div class="dropdown self-stretch">
        <tippy>
            <button class="relative flex items-center h-full ltr:ml-1 rtl:mr-1 px-2 text-2xl leading-none la la-bell">
                <span id="notification-count"
                    class="absolute top-0 right-0 rounded-full border border-primary -mt-1 -mr-1 px-2 leading-tight text-xs font-body text-primary">{{ notifications.length }}</span>
            </button>

            <template #content class="custom-dropdown-menu">
                <div class="flex items-center px-5 py-2">
                    <h5 @click="notify" class="mb-0 uppercase mr-6">Notifications</h5>
                    <a :href="clearAllRoute" class="btn btn_outlined btn_warning uppercase ltr:ml-auto rtl:mr-auto">Clear All</a>
                </div>

                <hr>

                <div v-if="notifications.length">
                    <div v-for="notification in notifications" class="p-5 hover:bg-primary hover:bg-opacity-5">
                        <h6 class="uppercase">Heading One</h6>
                        <p>jkbh</p>
                        <small>Today</small>
                    </div>
                </div>
                <div class="p-5" v-else>
                    <p>No notifications.</p>
                </div>
            </template>
        </tippy>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'initialNotifications', 'clearAllRoute'],

        data() {
            return {
                notifications: this.initialNotifications
            }
        },

        methods: {
            notify() {
                window.axios.get('/settings/notifications/broadcast')
                    .catch(error => {
                        console.error(error);
                    })
            }
        },
        
        created() {
            window.Echo.private('App.Models.User.' + this.userId)
                .notification((notification) => {
                    this.notifications.unshift(notification);
                });
        },
    }
</script>
