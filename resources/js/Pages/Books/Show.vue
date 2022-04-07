<template>
    <app-layout title="Books">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Books
                </h2>
                <jet-button class="" @click.prevent="isModalAddActive = !isModalAddActive"
                >
                    Add new book
                </jet-button>
            </div>
        </template>    
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">    
            <add-new-book :isModalAddActive="isModalAddActive" class="mt-10 sm:mt-0"
            @closeModal="closeAddModal()"/>
        </div>
        
        <div> 
            <render-books :books="books"/>
        </div>
        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetButton from '@/Jetstream/Button.vue';
    import Modal from '../../Components/Modal.vue';
    import AddNewBook from './Partials/AddNewBook';
    import RenderBooks from './Partials/RenderBooks';

    export default {
        props:{
            books: Object
        },
        components: {
            AppLayout,
            JetButton,
            Modal,
            AddNewBook,
            RenderBooks
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