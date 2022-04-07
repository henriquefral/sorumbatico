<template>
    <div>
        <manage-manga :isModalActive="isModalActive" class="mt-10 sm:mt-0"
        @closeModal="closeModal()" :manga="manga"/>
    </div>
    <div  class="flex justify-center flex-wrap mx-44 space-x-2 ">
        <render-item :items="mangas" :itemName="'mangas'" @updateModal="updateModal"
        />
    </div>

</template>

<script>
    import RenderItem from '../../../Components/RenderItem.vue';
    import ManageManga from './ManageManga.vue';
    export default {
        props:{
            mangas: Object
        },
        components: {
            RenderItem,
            ManageManga
        },
        data(){
            return{
                isModalActive: false,
                manga: {}
            }
        },
        created(){
            console.log(this.mangas);
        },
        methods:{
            updateModal(childProps){
                this.manga = childProps.item
                this.isModalActive = childProps.value;
            },
            closeModal(){
                this.isModalActive = false;
            }
        }
    }
</script>

