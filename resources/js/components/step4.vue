<template>
    <div class="w-full flex flex-col items-center justufy-center gap-5">
        <h2 class="w-full flex items-center justify-center border-b border-white/10 pb-5 font-extrabold text-xl">
            {{ title }}
        </h2>

        <div class="w-full flex flex-col items-center justufy-center gap-5 font-mono text-xl"
            v-if="(getToken() && getUploadCount() > 0)">

            <div class="w-full">
                <span><i class="fas fa-info-circle mr-2"></i>Click on the button below and create a link to download
                    your latest changes.</span>
                <br>
                <span class="text-rose-500 text-lg font-extrabold"><i
                        class="fas fa-exclamation-triangle mr-1.5 ml-0.5 text-base"></i>Note:</span><span
                    class="text-base underline-offset-4 text-white/70"> Each link can be downloaded only once</span>
            </div>

            <alert v-for="a in alert" :key="a.id" :message="a.message" :color="a.color" />

            <button class="bg-emerald-600 px-4 py-2 rounded-lg active:scale-95"
                :class="{ 'bg-slate-500': creating, 'cursor-pointer': creating }" @click="createLink"><i
                    class="fas fa-cogs"></i> Create New Link</button>

            <div class="relative w-full mx-5 md:mx-10 font-mono text-base" v-if="(links.length > 0)">
                <div class="text-lg font-extrabold">Download Links:</div>

                <div class="w-full overflow-x-auto pb-2">
                    <table class="w-full">
                        <tr class="bg-neutral-600/30 divide-x-2 divide-neutral-200/30">
                            <th class="px-2 py-1">File Name</th>
                            <th class="px-2 py-1">Files</th>
                            <th class="px-2 py-1">Size</th>
                            <th class="px-2 py-1">Copy</th>
                            <th class="px-2 py-1">Preview</th>
                            <th class="px-2 py-1">Download</th>
                        </tr>
                        <tr class="odd:bg-neutral-300/30 even:bg-neutral-400/30 divide-x-2 divide-neutral-200/30 hover:bg-red-400/30"
                            v-for="link in Object.entries(links)">
                            <td class="px-2 py-1"><i class="fas fa-file-archive text-sm mr-1"></i>{{ link[1].file }}</td>
                            <td class="px-2 py-1 text-center">{{ link[1].files }}</td>
                            <td class="px-2 py-1 text-center">{{ formatBytes(link[1].size) }}</td>
                            <td class="px-2 py-1 text-center"><span class="text-neutral-300 cursor-pointer"
                                    @click="(e) => { copy(e, link[1].url) }"><i
                                        class="fas fa-clipboard text-sm mr-1"></i>Copy Url</span></td>
                            <td class="px-2 py-1 text-center"><a :href="link[1].url" target="_blank"
                                    class="text-blue-400"><i class="fas fa-eye text-sm mr-1"></i>Donwload Page</a></td>
                            <td class="px-2 py-1 text-center"><span class="text-blue-400"
                                    :class="{ 'cursor-pointer': !link[1].use }" @click="(e) => { download(e, link[0]) }"><i
                                        class="fas fa-download text-sm mr-1"></i>Download</span></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>


        <div v-else
            class="w-full h-44 flex items-center justify-center font-extrabold text-lg md:text-2xl drop-shadow-[0_0_5px_#aa0033]">
            Please complete previous step.
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "Create Download links.",
            creating: false,
            alert: [],
            links: []
        }
    },

    methods: {

        createLink() {
            if (!this.creating) {
                this.creating = true;
                axios.get('api/newlink/' + token).then(this.created).catch(this.failCreate);
            }
        },

        created(e) {
            this.creating = false;
            e.data.data.use = false;
            this.links.push(e.data.data);
        },

        failCreate(e) {
            this.creating = false;
            this.alert.push({
                id: this.alert.length,
                message: e.response.data.message ?? e.message,
                color: "ff1155"
            })
        },

        download(el, i) {
            if (!this.links[i].use) {
                this.links[i].use = true;
                let link = this.links[i];
                axios.get(link.download_url, {
                    responseType: 'blob',
                    onDownloadProgress: (e) => {
                        this.downloadingFile(el, e);
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
                    el.target.style.color = '#11ff99';
                    el.target.innerHTML = '<i class="fas fa-check-square text-sm mr-1"></i>Downloaded';
                }).catch((e) => {
                    el.target.style.color = '#ff1155';
                    el.target.innerHTML = '<i class="fas fa-exclamation-triangle text-sm mr-1"></i>Error';
                });
            }
        },

        downloadingFile(el, e) {
            let x = e.loaded / e.total * 100;
            el.target.innerHTML = x.toFixed(1) + '%';
        },

        copy(e, str) {
            navigator.clipboard.writeText(str);
            let color = e.target.style.color, text = e.target.innerHTML;
            e.target.style.color = '#11ff99';
            e.target.innerHTML = '<i class="fas fa-clipboard-check text-sm mr-1"></i>Copied!';
            setTimeout(() => {
                e.target.style.color = color;
                e.target.innerHTML = text;
            }, 1500);
        },

        formatBytes(bytes, decimals = 2) {
            if (!+bytes) return '0 Bytes'
            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
            const i = Math.floor(Math.log(bytes) / Math.log(k))
            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        },

        getToken() {
            return token;
        },
        getUploadCount() {
            return uploaded;
        }
    },
}
</script>