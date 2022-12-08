<template>
<div id="hashs" class="fixed w-screen h-screen top-0">
        <component v-for="component in components" v-bind:is="component.name" :key="component.id" @finished="destroyHash" />
        </div>
        <header class="rounded-lg flex items-center justify-between px-8 p-4 backdrop-blur-sm bg-black/5">
            <div class="h-12 md:h-20 drop-shadow-[0_0_7px_#0554ff] flex items-center gap-2">
                <img src="/assets/images/logo.png" alt="Logo" class="h-full">
                <h1 class="text-xl md:text-3xl font-[hackdaddy]">PHP Encoder</h1>
            </div>
        </header>
        <section class="container px-7">
            <div class="w-full bg-gradient-to-t from-[#00000055] to-[#00000011] backdrop-blur-sm rounded-lg mb-2 flex flex-col justify-between items-center py-5 px-5 md:px-10">

                <h2 class="w-full flex items-center justify-center border-b border-white/10 pb-5 mb-5 font-extrabold text-xl">
                    {{ step.message }}
                </h2>

                <component class="px-5 md:px-8 font-mono" v-bind:is="step.name" :key="step.id" @message="(msg)=>{step.message = msg;}"></component>

                <div class="w-full flex items-center justify-between border-t border-white/10 pt-5 mt-5">
                    <div class="w-1/3">
                        <button class="text-sm md:text-base bg-blue-600 font-bold md:font-extrabold px-2 py-0.5 md:px-4 ms:py-2 rounded-lg" :class="{'invisible':(step.id <= 1)}" @click="()=>{if(step.id > 1) setStep(step.id-1);}">Previous</button>
                    </div>
                    <span class="text-base md:text-xl font-extrabold">{{ step.id }}/{{  steps }}</span>
                    <div class="w-1/3 flex justify-end">
                        <button class="text-sm md:text-base bg-blue-600 font-bold md:font-extrabold px-2 py-0.5 md:px-4 ms:py-2 rounded-lg" :class="{'invisible':(step.id >= steps)}" @click="()=>{if(step.id < steps) setStep(step.id+1);}">Next</button>
                    </div>
                </div>
            </div>
        </section>
</template>

<script>

export default {
    data() {
        return {
            steps: 4,
            step: {
                id:1,
                component: 'step1',
            },
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

        destroyHash(e)
        {
            e.remove();
        },

        setStep(id)
        {
            this.step = {
                message:'',
                'name': 'step'+id,
                id: id,
            };
        },

    },

    mounted() {
        setInterval(this.createRandomHash, 500);
        this.setStep(1);
    }
};

</script>