<template>
    <div class="w-full flex flex-col items-center justufy-center gap-5">
        <h2 class="w-full flex items-center justify-center border-b border-white/10 pb-5 font-extrabold text-xl">
            {{ title }}
        </h2>

        <div class="w-full flex flex-col items-center justufy-center gap-5" v-if="getToken()">
            <label @dragover.prevent="" @dragenter.prevent="" @drop.prevent="dropFile" for="file"
                class="relative h-36 md:h-52 w-full mx-5 md:mx-10 border-[6px] border-dashed border-neutral-300/70 bg-neutral-500/20 flex items-center justify-center flex-col font-mono cursor-pointer">
                <img src="/assets/images/upload.png" alt=""
                    class="h-2/3 brightness-200 drop-shadow-[0_4px_7px_#000] -mb-3">
                <span><b>Choose a file</b> or drag here.</span>
                <input @change="chooseFile" type="file" id="file" accept=".php" class="hidden" multiple>
            </label>

            <div class="relative w-full mx-5 md:mx-10 font-mono" v-if="(files.length > 0)">
                <div class="text-lg font-extrabold"><i class="fas fa-folder-open"></i> Stage Files:</div>

                <div class="w-full overflow-x-auto pb-2">
                    <table class="w-full">
                        <tr class="bg-neutral-600/30 divide-x-2 divide-neutral-200/30">
                            <th class="px-2 py-1">Name</th>
                            <th class="px-2 py-1">Size</th>
                            <th class="px-2 py-1">Action</th>
                        </tr>
                        <tr class="odd:bg-neutral-300/30 even:bg-neutral-400/30 divide-x-2 divide-neutral-200/30 hover:bg-red-400/30"
                            v-for="file in Object.entries(files)">
                            <td class="px-2 py-1"><i class="fas fa-file-code"></i> {{ file[1].name }}</td>
                            <td class="px-2 py-1 text-center">{{ formatBytes(file[1].size) }}</td>

                            <td v-if="(file[1].uploading !== false)" class="px-2 py-1 text-center text-blue-400" :class="{
                                'text-green-400': file[1].uploading == 'Encoded',
                                'text-red-400': file[1].uploading != 'Encoded' && file[1].uploading.length > 6
                            }">
                                <i class="fas fa-check-square text-sm mr-1" v-if="file[1].uploading == 'Encoded'"></i>{{
                                        file[1].uploading
                                }}
                            </td>

                            <td class="px-2 py-1 text-center" v-else>
                                <span @click="() => {
                                    uploadFile(file[0]);
                                }" class="text-blue-400 cursor-pointer">
                                    <i class="fas fa-cogs text-sm mr-1"></i>Encode
                                </span> /
                                <span @click="() => {
                                    deleteFile(file[0]);
                                }" class="text-red-400 cursor-pointer">
                                    <i class="fas fa-trash-alt text-sm mr-1"></i>Delete
                                </span>
                            </td>
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
            title: "Upload & Encode Files.",
            files: []
        }
    },

    methods: {
        dropFile(e) {
            this.addFile(e.dataTransfer.files);

        },

        chooseFile(e) {
            this.addFile(e.target.files);
        },

        addFile(e) {
            for (var i = 0; i < e.length; i++) {
                let file = e[i];
                if ((file.name.split('.').pop()).toLowerCase() == 'php') {
                    let info = {
                        file: file,
                        name: file.name,
                        size: file.size,
                        uploading: false,
                        data: '',
                    };
                    let reader = new FileReader();
                    reader.handle = this;
                    reader.onload = function (event) {
                        info.data = event.target.result;
                        this.handle.files.push(info);
                    }
                    reader.readAsDataURL(file);
                }
            }
        },

        deleteFile(i) {
            delete this.files[i];
        },

        uploadFile(i) {
            let formData = new FormData();
            formData.append("file", this.files[i].file);
            axios.post('api/upload/' + token, formData, {
                onUploadProgress: (e) => {
                    this.uploadingFile(i, e)
                }
            }).then((e) => {
                uploaded++;
            }).catch((e) => {
                this.files[i].uploading = e.response.data.message ?? e.message;
            });
        },

        uploadingFile(i, e) {
            let x = e.loaded / e.total * 100;
            if (x == 100) {
                this.files[i].uploading = 'Encoded';
            }
            else {
                this.files[i].uploading = x.toFixed(1) + '%';
            }
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
        }
    },
}
</script>