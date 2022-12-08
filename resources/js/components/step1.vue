<template>
    <ul class="list-disc w-full text-lg">
        <li v-for="description in descriptions">{{ description }}</li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            message:"About This System",
            descriptions : [
                "This is a free service to make your php scripts uneditable.",
                "All PHP encoder and obfuscator may be decoded, but the difference is in their level of difficulty.",
                "Our service protects your scripts to a good extent.",
                "Encryption will be done with completely random functions and in different layers, and it will be very difficult for abusers to access the original source.",
                "In the next steps, enter your information and add as many scripts as you want"
            ]
        }
    },

    mounted()
    {
        this.$emit('message', this.message);
    }
}
</script>