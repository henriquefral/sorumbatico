<template>
    <div class="flex justify-center flex-wrap mx-44 space-x-2 ">
        <div class="p-6 bg-white border-b border-gray-200 mb-2.5 m-2/6 max-w-[25%]" v-for="(book) in books" :key="book.id">                
            <div class="mt-8 text-2xl">
                {{ book.name }}
            </div>

            <div class="mt-6 text-gray-500">
                {{book.pages}}/{{book.current_page}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            books: Object
        },
    }
</script>

<style>

</style>