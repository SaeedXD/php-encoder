<template>
    <div class="flex flex-wrap gap-5 items-center justify-center w-full">

        <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
            <label for="owner" class="w-full">Name/Company:</label>
            <input ref="owner" id="owner" type="text" class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50" pattern=".{3,64}" required>
        </div>

        <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
            <label for="email" class="w-full">Email:</label>
            <input ref="email" id="email" type="email" class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50" required>
        </div>

        <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
            <label for="password" class="w-full">Files Password:</label>
            <input ref="password" id="password" type="text" class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50" pattern=".{8,64}" required>
        </div>

    </div>
    <div class="w-full flex justify-center mt-5">
        <button class="text-sm md:text-base bg-teal-600 font-bold md:font-extrabold px-2 py-0.5 md:px-4 ms:py-2 rounded-lg" :class="{'cursor-wait':registering, 'bg-slate-500':registering}" @click="()=>{if(!registering) register();}">Register</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            registering: false,
            message:"Your Information"
        }
    },

    methods: {
        register()
        {
            this.registering = true

            axios()
        }
    },

    mounted()
    {
        this.$emit('message', this.message);
    }
}
</script>