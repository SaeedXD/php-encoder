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

            <div class="w-full">
                <h2 class="w-full flex items-center justify-center border-b border-white/10 pb-5 mb-5 font-extrabold text-xl">
                    Download Encoded Files
                </h2>
                <div class="flex flex-wrap gap-5 items-center justify-center w-full font-mono">

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="owner" class="w-full"><i class="fas fa-crown"></i> Name/Company: (owner)</label>
                        <input
                            :value="data.owner" 
                            id="owner" type="text"
                            class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                            disabled>
                    </div>

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="email" class="w-full"><i class="fas fa-envelope"></i> Email:</label>
                        <input
                            :value="data.email" 
                            id="email" type="email"
                            class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                            disabled>
                    </div>

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="file" class="w-full"><i class="fas fa-file-archive"></i> File Name:</label>
                        <input
                            :value="data.file" 
                            id="file" type="text"
                            class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                            disabled>
                    </div>

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="size" class="w-full"><i class="fas fa-box-open"></i> File Size:</label>
                        <input
                            :value="formatBytes(data.size)" 
                            id="size" type="text"
                            class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                            disabled>
                    </div>

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="files" class="w-full"><i class="fas fa-folder-open"></i> Number Of Files:</label>
                        <input
                            :value="data.files + (data.files == 1 ? ' File' : ' Files')" 
                            id="files" type="text"
                            class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                            disabled>
                    </div>

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="views" class="w-full"><i class="fas fa-eye"></i> Number Of Views:</label>
                        <input
                        :value="data.views + (data.views == 1 ? ' View' : ' Views')" 
                            id="views" type="text"
                            class="w-full h-8 outline-none bg-blue-300/10 rounded px-2 border border-transparent valid:border-teal-400/50 focus:invalid:border-red-400/50"
                            disabled>
                    </div>

                    <div class="relative w-10/12 sm:w-8/12 lg:w-1/3">
                        <label for="views" class="w-full"><i class="fas fa-download"></i> Download:</label>
                        <button ref="dl" class="w-full h-8 outline-none bg-blue-600/50 rounded px-2 active:scale-95" :class="{'bg-emerald-600/50': downloadstate === 1, 'bg-red-600/50': downloadstate === 2, 'bg-red-600/50': data.used === 1}" @click="download">
                            {{ data.used === 0 ? 'Download' : 'Link Has Been Expired.' }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>

</template>

<script>

export default {
    props: ['linkdata'],

    data() {
        return {
            downloadstate: 0,
            downloading: false,
            data: {},
            components_counter: 1,
            components: [],
        }
    },

    methods: {
        download(el) {
            if (this.data.used == 0 && this.downloading == false) {
                this.downloading = true;
                axios.get(this.data.url, {
                    responseType: 'blob',
                    onDownloadProgress: (e) => {
                        this.downloadingFile(e);
                    }
                }).then((e) => {
                    const url = window.URL.createObjectURL(e.data);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = e.headers['content-disposition'].replace('attachment; filename=', '');
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    this.downloadstate = 1;
                    this.$refs.dl.innerHTML = '<i class="fas fa-check-square"></i> Downloaded';
                }).catch((e) => {
                    this.downloadstate = 2;
                    this.$refs.dl.innerHTML = '<i class="fas fa-exclamation-triangle"></i>Error';
                });
            }
        },

        downloadingFile(e) {
            let x = e.loaded / e.total * 100;
            this.$refs.dl.innerHTML = x.toFixed(1) + '%';
        },

        createRandomHash() {
            this.components.push({
                'name': 'RandomHash',
                id: this.components_counter++,
            });
        },

        formatBytes(bytes, decimals = 2) {
            if (!+bytes) return '0 Bytes'
            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
            const i = Math.floor(Math.log(bytes) / Math.log(k))
            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        },
    },

    mounted()
    {
        this.data = JSON.parse(this.linkdata);
        console.log(this.data);
        setInterval(this.createRandomHash, 1200);
    }
}

</script>