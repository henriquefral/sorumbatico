<template>
    <div>
        <template>
        <Modal :isModalActive="isModalActive" title="Update Book" 
        class="mt-10 sm:mt-0" @closeModal="closeModal()" @update="update" :method="update"
        :processing="form.processing">
            <template #title>
                <icon name="delete" class="w-5 h-5 fill-current hover:text-red-900 cursor-pointer" @click="destroy(book.id)"/>
            </template>
            <template #content>
                <div class="flex flex-row space-x-2">
                    <div class="max-w-[35%]">
                        <div>
                            Book name: {{book.name}}
                        </div>
                        <div>
                            Author: {{book.author}}
                        </div>
                        <div>
                            Progress: {{book.pages}}/{{book.current_page}}
                        </div>
                        <div>
                            Is favorite? {{book.favorite == 1 ? 'Yes' : 'No'}}
                        </div>
                    </div> 
                    <form @submit.prevent="update">
                        <div>
                            <jet-label class="mt-1 text-lg" value="Book name"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                ref="name"
                                :modelValue="book.name"
                                v-model="form.name" 
                            />
                            <jet-label class="mt-1 text-lg" value="Book author"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Author"
                                ref="author"
                                :modelValue="book.author"
                                v-model="form.author" 
                            />
                            <jet-label class="mt-1 text-lg" value="Total number of pages"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Total pages"
                                ref="pages"
                                :modelValue="book.pages"
                                v-model="form.pages" 
                            />
                            <jet-label class="mt-1 text-lg" value="Number of readed pages"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Pages readed"
                                ref="current_page"
                                :modelValue="book.current_page"
                                v-model="form.current_page" 
                            />
                            <div class="flex items-center space-x-10 justify"> 
                                <div class="flex items-center">
                                    <jet-label class="mt-1 text-lg mr-1" 
                                    value="Is an favorite?"/> 
                                    <jet-checkbox class="mt-1 block" 
                                        :checked="book.favorite == 0 ? false : true"
                                        ref="favorite"
                                        v-model="form.favorite" 
                                    />
                                    <jet-label class="mt-1 text-lg mr-1" 
                                    value="Is for leisure?"/> 
                                    <jet-checkbox class="mt-1 block" 
                                        :checked="book.leisure == 0 ? false : true"
                                        ref="leisure"
                                        v-model="form.leisure" 
                                    />
                                </div>
                            </div>  
                            <jet-validation-errors class="mt-4"/>
                        </div>
                    </form>
                </div>
            </template>
        </Modal>
        </template>
    </div>
</template>

<script>
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
    import JetCheckbox from '@/Jetstream/Checkbox.vue';
    import JetInput from '@/Jetstream/Input.vue';
    import JetLabel from '@/Jetstream/Label.vue';
    import Modal from '../../../Components/Modal.vue';
    import Icon from '../../../Components/Icons.vue';

    export default {
        props: {
            isModalActive: Boolean,
            book: Object
        },

        components: {
            JetSectionBorder,
            JetValidationErrors,
            JetCheckbox,
            JetInput,
            JetLabel,
            Modal,
            Icon
        },
        methods:{
            closeModal(){
                this.$emit('closeModal');
            },
            update() {
                this.form.patch((`/books/${this.book.id}`), {
                    onSuccess: () => {
                        this.closeModal();
                    },
                });
            },
            destroy(){
                this.$inertia.delete((`/books/${this.book.id}`), {
                    onSuccess: () => {
                        this.closeModal();
                    }
                });
            },
        },
        data(){
            return{
                form: this.$inertia.form({
                    name: '',
                    author:'',
                    pages: '',
                    current_page: '',
                    favorite: false,
                    leisure: false,
                }),
            }
        },
        
    }
</script>

