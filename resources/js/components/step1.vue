<template>
    <div class="w-full">
        <h2 class="w-full flex items-center justify-center border-b border-white/10 pb-5 mb-5 font-extrabold text-xl">
            {{ title }}
        </h2>
        <ul class="relative font-mono list-disc w-full text-lg">
            <li class="mx-5 md:mx-10" v-for="description in descriptions">{{ description }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "About This System",
            descriptions: [
                "This is a free service to make your php scripts uneditable.",
                "All PHP encoder and obfuscator may be decoded, but the difference is in their level of difficulty.",
                "Our service protects your scripts to a good extent.",
                "Encryption will be done with completely random functions and in different layers, and it will be very difficult for abusers to access the original source.",
                "In the next steps, enter your information and add as many scripts as you want"
            ]
        }
    },
}
</script>