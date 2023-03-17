<script setup>
    import { ref, reactive } from 'vue'
    import { router, usePage } from '@inertiajs/vue3';

    import Close from 'vue-material-design-icons/Close.vue';
    import ArrowLeft from 'vue-material-design-icons/ArrowLeft.vue';
    import MapMarkerOutline from 'vue-material-design-icons/MapMarkerOutline.vue';
    import ChevronDown from 'vue-material-design-icons/ChevronDown.vue';

    // const user = usePage().props.auth.user

    const emit = defineEmits(['close'])

    const form = reactive({
        text: null,
        file: null,
    })

    let isValidFile = ref(null)
    let fileDisplay = ref('')
    let textarea = ref('')
    let error = ref({
        text: null,
        file: null,
    })

   const getUploadedImage = (e) =>{
        form.file = e.target.files[0] // get the file that has been uploaded and put it into form.file declared above
        let extention = form.file.name.substring(form.file.name.lastIndexOf('.') + 1); //get the file extension
        console.log(extention)

        if (extention == 'png' || extention == 'jpg' || extention == 'jpeg') {
            isValidFile.value = true
        } else {
            isValidFile.value = false
            return
        }
        fileDisplay.value = URL.createObjectURL(e.target.files[0])
       
        setTimeout(() => {
            document.getElementById('TextAreaSection').scrollIntoView({behavior: 'smooth'});
        }, 300);

   }

    const closeOverlay = () => {
        form.text = null
        form.file = null
        fileDisplay.value = ''
        //emmit this overlay to the parent so that you can close
        emit('close')
    }
</script>

<template>
    <div id="OverlaySection" class="fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 p-3">
        <button class="absolute right-3 cursor-pointer" @click="closeOverlay()">
            <Close :size="27" fillColor="#FFFFFF"/>
        </button>
        <div class="max-w-6xl h-[calc(100%-100px)] mx-auto mt-10 bg-white rounded-xl">
            <div class="flex items-center justify-between w-full rounded-t-xl p-3 border-b border-b-gray-300">
                <ArrowLeft :size="30" fillColor="#000000" @click="closeOverlay()"/>
                <div class="text-lg font-extrabold">New reel</div>
                <button @click="createPostFunc()" class=" text-lg text-blue-500 hover:text-gray-900 font-extrabold">
                    Share
                </button>
            </div>
            <div class="w-full md:flex h-[calc(100%-55px)] rounded-xl overflow-auto">
                <div class="flex items-center bg-gray-100 w-full h-full overflow-hidden">
                    <div v-if="!fileDisplay" class="flex flex-col items-center mx-auto">
                        <label
                            for="file"
                            class="hover:bg-blue-700 bg-blue-500 rounded-lg p-2.5 text-white font-extrabold cursor-pointer"
                        >
                            Select From Computer
                        </label>
                        <input
                            id="file"
                            class="hidden"
                            type="file"
                            @input="getUploadedImage($event)"
                        >
                        <div v-if="error && error.file" class="text-red-500 text-center p-2 font-extrabold">{{ error.file }}</div>
                        <div v-if="!fileDisplay && isValidFile === false" class="text-red-500 text-center p-2 font-extrabold">
                            File not accepted
                        </div>
                    </div>
                    <img v-if="fileDisplay && isValidFile === true" class=" min-w-[400px] p-4 mx-auto" :src="fileDisplay">
                </div>
                <div id="TextAreaSection" class="max-w-[720px] w-full relative">
                    <div class="flex items-center justify-between p-3">
                        <img class="rounded-full w-[38px] h-[38px]" 39,29:                 src="http://via.placeholder.com/640x640">
                        <div class="ml-4 font-extrabold text-[15px]">Name here</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>