<template>
    <div>
        <manage-book :isModalActive="isModalActive" class="mt-10 sm:mt-0"
        @closeModal="closeModal()" :book="book"/>
    </div>
    <div  class="flex justify-center flex-wrap mx-44 space-x-2 ">
        <render-item :items="books" :itemName="'books'" @updateModal="updateModal"
        />
    </div>

</template>

<script>
    import RenderItem from '../../../Components/RenderItem.vue';
    import ManageBook from './ManageBook.vue';
    export default {
        props:{
            books: Object
        },
        components: {
            RenderItem,
            ManageBook
        },
        data(){
            return{
                isModalActive: false,
                book: {}
            }
        },
        methods:{
            updateModal(childProps){
                this.book = childProps.item
                this.isModalActive = childProps.value;
            },
            closeModal(){
                this.isModalActive = false;
            }
        }
    }
</script>

