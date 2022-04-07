<template>
    <app-layout title="Mangas">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mangas
                </h2>
                <jet-button class="" @click.prevent="isModalAddActive = !isModalAddActive"
                >
                    Add new manga
                </jet-button>
            </div>
        </template>    
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">    
            <add-new-manga :isModalAddActive="isModalAddActive" class="mt-10 sm:mt-0"
            @closeModal="closeAddModal()"/>
        </div>
        
        <div> 
            <render-mangas :mangas="mangas"/>
        </div>
        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetButton from '@/Jetstream/Button.vue';
    import Modal from '../../Components/Modal.vue';
    import AddNewManga from './Partials/AddNewManga';
    import RenderMangas from './Partials/RenderMangas';

    export default {
        props:{
            mangas: Object
        },
        components: {
            AppLayout,
            JetButton,
            Modal,
            AddNewManga,
            RenderMangas
        },
        data(){
            return{
                isModalAddActive: false
            }
        },
        methods:{
            closeAddModal(){
                this.isModalAddActive = false;
            }
        }
    }

</script>

<style>

</style>