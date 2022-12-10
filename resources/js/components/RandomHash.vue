<template>
    <div ref="hash" class="absolute w-fit h-fit font-mono font-bold text-blue-400 bg-white/10 leading-4 min-w-[0.5rem] pr-2 break-keep whitespace-nowrap" :style="{left: left + 'px', top: top + 'px', transition: 'all 0.3s'}">
        {{ hash }}
        <div class="absolute right-0 top-0 w-2 h-full bg-blue-300 custom-animate-pulse"></div>
    </div>
</template>

<script>
export default {
    props: ['pos'],

    data() {
        return {
            hash:'$ ',
            left: rand(-30, window.innerWidth - 120),
            top: rand(10, window.innerHeight - 20),
            size: rand(15, 30),
            running: false
        }
    },

    methods: {
        addLetter()
        {
            this.hash += this.randomLetter();
        },
        
        delLetter()
        {
            this.hash = this.hash.substring(0, this.hash.length-1);
        },

        randomLetter() {
            let letters = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
            return letters[rand(0, letters.length-1)];
        },

        run()
        {
            let timeline = 0;
            for (let i = 1; i <= this.size; i++) {
                timeline += rand(100, 200);
                setTimeout(this.addLetter, timeline);
            }
            timeline += rand(800, 2500);

            setTimeout(()=>{
                this.$refs.hash.style.opacity = 0;
            }, timeline);
            setTimeout(this.finished, timeline+300);
        },

        finished() {
            this.$el.remove();
        }

    },

    mounted() {
        this.run();
    },
}

</script>