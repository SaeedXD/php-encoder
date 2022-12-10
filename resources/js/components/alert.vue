<template>
    <div class="mx-auto w-fit px-4 py-1.5 rounded m-2" :style="{background:'#'+color+'44', border:'1px solid #'+color+'88', textShadow:'0 0 5px #'+color+'ff'}">
        {{ message }}
    </div>
</template>

<script>
export default {
    props:['message', 'color'],

    data() {
        return {
        }
    },

    mounted()
    {   
        let timeline = 0;
        this.$el.style.opacity = 0;
        timeline+=10;
        setTimeout(() => {
            this.$el.style.opacity = 1;
        }, timeline);

        timeline+=4000;
        setTimeout(()=>{
            this.$el.style.opacity = 0;
        }, timeline);

        timeline+=500;
        setTimeout(()=>{
            this.$el.remove();
        }, timeline);
    }
}
</script>