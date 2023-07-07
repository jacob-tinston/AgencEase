<template>
    <div class="w-fit xl:p-4">
        <h4 class="mb-4 whitespace-nowrap">Notifications</h4>

        <div class="my-4">
            <button @click.prevent="testApp" class="btn btn_secondary btn_outlined uppercase">Test app notifications</button>
        </div>

        <div class="my-4">
            <button @click.prevent="testEmail" class="btn btn_secondary btn_outlined uppercase">Test email notifications</button>
        </div>

        <div class="my-4">
            <button @click.prevent="testSMS" class="btn btn_secondary btn_outlined uppercase">Test SMS notifications</button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            testApp() {
                window.axios.get('/notifications/test/app')
                    .catch(error => {
                        console.error(error);
                    })
            },

            testEmail() {
                window.axios.get('/notifications/test/email')
                    .catch(error => {
                        console.error(error);
                    })
            },

            testSMS() {
                window.axios.get('/notifications/test/sms')
                    .catch(error => {
                        console.error(error);
                    })
            },
        },
    }
</script>
