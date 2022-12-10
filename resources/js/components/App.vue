<template>
    <div id="hashs" class="fixed w-screen h-screen top-0">
        <component v-for="component in components" v-bind:is="component.name" :key="component.id" />
    </div>

    <header class="rounded-lg flex items-center justify-between px-8 p-4 box">
        <div class="h-12 md:h-20 drop-shadow-[0_0_9px_#0554ffaa] flex items-center gap-2">
            <img src="/assets/images/logo.png" alt="Logo" class="h-full">
            <h1 class="text-xl md:text-3xl font-[hackdaddy]">SG PHP Encoder</h1>
        </div>
    </header>

    <section class="grow container px-7 flex justify-center items-center">
        <div class="w-full rounded-lg mb-2 flex flex-col justify-between items-center py-5 px-5 md:px-10 box">

            <component v-for="i in steps" v-show="i == step" :is="'step' + i" :key="i"></component>

            <div class="w-full flex items-center justify-between border-t border-white/10 pt-5 mt-5">
                <div class="w-1/3">
                    <button
                        class="text-sm md:text-base bg-blue-600 font-bold md:font-extrabold px-2 py-0.5 md:px-4 ms:py-2 rounded-lg active:scale-95"
                        :class="{ 'invisible': (step <= 1) }"
                        @click="() => { if (step > 1) setStep(step - 1); }">Previous</button>
                </div>
                <span class="text-base md:text-xl font-extrabold">{{ step }}/{{ steps }}</span>
                <div class="w-1/3 flex justify-end">
                    <button
                        class="text-sm md:text-base bg-blue-600 font-bold md:font-extrabold px-2 py-0.5 md:px-4 ms:py-2 rounded-lg active:scale-95"
                        :class="{ 'invisible': (step >= steps) }"
                        @click="() => { if (step < steps) setStep(step + 1); }">Next</button>
                </div>
            </div>
        </div>
    </section>

</template>

<script>

export default {
    data() {
        return {
            title: '',
            steps: 4,
            step: 1,
            components_counter: 1,
            components: [],
        }
    },

    methods: {
        createRandomHash() {
            this.components.push({
                'name': 'RandomHash',
                id: this.components_counter++,
            });
        },

        setStep(id) {
            this.step = id;
        },
    },

    mounted() {
        setInterval(this.createRandomHash, 1200);
    }
};

</script>