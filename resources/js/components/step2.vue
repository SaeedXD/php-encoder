<template>
    <div class="w-full">
        <h2 class="w-full flex items-center justify-center border-b border-white/10 pb-5 mb-5 font-extrabold text-xl">
            {{ title }}
        </h2>
        <alert v-for="a in alert" :key="a.id" :message="a.message" :color="a.color" />

        <div class="flex flex-wrap gap-5 items-center justify-center w-full font-mono">

            <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                <label for="owner" class="w-full"><i class="fas fa-crown"></i> Name/Company: (owner)</label>
                <input ref="owner" id="owner" type="text"
                    class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                    pattern=".{3,64}" required>
            </div>

            <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                <label for="email" class="w-full"><i class="fas fa-envelope"></i> Email:</label>
                <input ref="email" id="email" type="email"
                    class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                    required>
            </div>

            <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                <label for="password" class="w-full"><i class="fas fa-unlock-alt"></i> Files Password:</label>
                <input ref="password" id="password" type="password"
                    class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                    pattern=".{8,64}" required>
            </div>
        
        </div>
        <div class="w-full flex justify-center mt-5" v-if="(getToken() === false)">
            <button
                class="text-sm md:text-base bg-emerald-600 font-bold md:font-extrabold px-2 py-0.5 md:px-4 ms:py-2 rounded-lg active:scale-95"
                :class="{ 'cursor-wait': registering, 'bg-slate-500': registering }"
                @click="() => { if (!registering) register(); }"><i class="fas fa-cog"></i> Register</button>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            registering: false,
            title: "Your Information",
            alert: []
        }
    },

    methods: {
        register() {

            if ((this.$refs.owner.value.length >= 3 && this.$refs.owner.value.length <= 64) && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.$refs.email.value)) && (this.$refs.password.value.length >= 8 && this.$refs.password.value.length <= 64)) {
                this.registering = true;
                axios.post('api/register', {
                    owner: this.$refs.owner.value,
                    email: this.$refs.email.value,
                    password: this.$refs.password.value,
                }).then(this.registered).catch(this.failRegister);
            }

        },

        registered(e) {
            token = e.data.data.token;
            this.$refs.owner.disabled = true;
            this.$refs.email.disabled = true;
            this.$refs.password.disabled = true;
            this.registering = false;
            this.alert.push({
                id: this.alert.length,
                message: "You have been registred.",
                color: "11ff55"
            });
        },

        failRegister(e) {
            this.registering = false;
            this.alert.push({
                id: this.alert.length,
                message: e.response.data.message ?? e.message,
                color: "ff1155"
            })
        },

        getToken() {
            return token;
        }
    },
}
</script>