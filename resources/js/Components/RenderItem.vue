<template>
    <div class="p-6 bg-white border-b border-gray-200 mb-2.5 m-2/6 max-w-[25%]" v-for="(item) in itens" :key="item.id">                
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
                <icon name="delete" class="w-5 h-5 fill-current hover:text-red-900 cursor-pointer" 
                @click="destroy(item)"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Icon from './Icons.vue';

    export default {
        props:{
            itens: Object,
            itemName: String,
        },
        components:{
            Icon
        },
        methods:{
            destroy(item){
                this.$inertia.delete(`/${this.itemName}/${item.id}`);
            }
        }
    }
</script>

<style>

</style>