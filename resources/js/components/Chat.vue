<template>
    <div class="h-full">
        <div class="relative h-full">
            <div class="absolute flex flex-col gap-5 w-full top-0 bottom-0 overflow-y-scroll">
                <!-- Received -->
                <div v-for="message in messages" :key="message.id" class="card flex items-start w-11/12 p-5">
                    {{ message.content }}
                    <span
                        class="whitespace-nowrap ltr:ml-auto rtl:mr-auto ltr:text-right rtl:text-left ltr:pl-5 rtl:pr-5 text-muted">Yesterday
                        2:20PM</span>
                </div>

                <!-- Sent -->
                <div v-for="message in messages" :key="message.id" class="card flex items-start w-11/12 ltr:ml-auto rtl:mr-auto p-5 bg-primary text-component">
                    {{ message.content }}
                    <span
                        class="whitespace-nowrap ltr:ml-auto rtl:mr-auto ltr:text-right rtl:text-left ltr:pl-5 rtl:pr-5">Yesterday
                        2:20PM</span>
                </div>
            </div>
        </div>

        <div class="footer-bar absolute">
            <input v-model="newMessage" @keyup.enter="sendMessage" type="text" class="flex flex-auto ltr:mr-5 rtl:ml-5 bg-transparent outline-none placeholder:text-placeholder"
                placeholder="Enter message...">

            <div class="flex sm:flex-wrap gap-5 ltr:ml-auto rtl:mr-auto">
                <button class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                    <span class="la la-paperclip text-xl leading-none"></span>
                </button>

                <button @click.prevent="sendMessage" class="btn btn_primary uppercase">
                    <span class="la la-paper-plane text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Send
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['storeRoute'],

        data() {
            return {
                messages: [],
                newMessage: '',
            };
        },

        methods: {
            async sendMessage() {
                if (this.newMessage.trim() === '') return;

                const response = await window.axios.post(this.storeRoute, { content: this.newMessage });
                this.messages.push(response.data);
                this.newMessage = '';
            }
        },
    }
</script>
