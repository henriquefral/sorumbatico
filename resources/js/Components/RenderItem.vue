<template>
    <div class="p-6 bg-white border-b border-gray-200 mb-2.5 m-2/6 max-w-[25%] cursor-pointer" 
    v-for="(item) in itens" :key="item.id" @click="updateModal(true,item)">                
        <div class="mt-8 text-2xl">
            {{ item.name }}
        </div>
        <div class="mt-6 text-gray-500">
            <div class="flex justify-between">
                <div v-if="itemName=='books'">
                    {{item.pages}}/{{item.current_page}}
                </div>
                <div v-if="itemName=='Mangas'">
                    {{item.chapters}}/{{item.current_chapter}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Icon from './Icons.vue';

    export default {
        emits: ["updateModal"],
        props:{
            itens: Object,
            itemName: String,
        },
        components:{
            Icon
        },
        methods:{

            updateModal(value, book){
                this.$emit('updateModal',{"value":value, "book":book});
            },
        }
    }
</script>

<style>

</style>