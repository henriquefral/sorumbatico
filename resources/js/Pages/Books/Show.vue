<template>
    <app-layout title="Books">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Books
                </h2>
                
                <jet-button class="" @click.prevent="isModalAddActive = !isModalAddActive">
                    Add new book
                </jet-button>
            </div>

        </template>

 
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <template>
                    <jet-section-border />

                    <modal-add-new class="mt-10 sm:mt-0"  @closeModal="closeAddModal" 
                    @store="store" :isModalActive="isModalAddActive" :processing="form.processing" 
                    title="Add new book" :method="store"
                    >
                        <template #content> 
                            <form @submit.prevent="store">
                                <div class="mt-4">
                                    <jet-label class="mt-1 text-lg" value="Book's name"/> 
                                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                        ref="name"
                                        v-model="form.name" 
                                    />
                                    <jet-label class="mt-1 text-lg" value="Book's author"/> 
                                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Author"
                                        ref="author"
                                        v-model="form.author" 
                                    />
                                    <jet-label class="mt-1 text-lg" value="Total number of pages"/> 
                                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Total pages"
                                        ref="pages"
                                        v-model="form.pages" 
                                    />
                                    <jet-label class="mt-1 text-lg" value="Number of readed pages"/> 
                                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Pages readed"
                                        ref="current_page"
                                        v-model="form.current_page" 
                                    />
                                    <div class="flex items-center space-x-10 justify"> 
                                        <div class="flex items-center">
                                            <jet-label class="mt-1 text-lg mr-1" 
                                            value="Is an favorite?"/> 
                                            <jet-checkbox class="mt-1 block" 
                                                ref="favorite"
                                                v-model="form.favorite" 
                                            />
                                        </div>
                                        <div class="flex items-center ">
                                            <jet-label class="mt-1 text-lg mr-1" 
                                            value="Is for leisure?"/> 
                                            <jet-checkbox class="mt-1 block"
                                                :checked="true"
                                                ref="leisure"
                                                v-model="form.leisure" 
                                            />
                                        </div>
                                    </div>  
                                    <jet-validation-errors class="mt-4"/>
                                </div>
                            </form>
                        </template>
                    </modal-add-new>
                </template>
                <template>
                    <div>
                        <modal-add-new class="mt-10 sm:mt-0"  @closeModal="closeUpdateModal" 
                        @update="update" :isModalActive="isModalUpdateActive" :processing="form.processing" 
                        title="Update new book" :method="update"
                        >
                            <template #title>
                                <icon name="delete" class="w-5 h-5 fill-current hover:text-red-900 cursor-pointer" @click="destroy(book.id)"/>
                            </template>
                            <template #content>
                                <div class="flex flex-row space-x-1">
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
                                            <br/>
                                            Its for leisure? {{book.leisure == 1 ? 'Yes' : 'No'}}

                                        </div>
                                    </div>
                                    <div class="divide-x-2 divide-black mt-3"> </div>
                                    <form @submit.prevent="store">
                                        <div class="w-full ">
                                            <jet-label class="text-lg" value="Book's name"/> 
                                            <jet-input type="text" class="mt-1 block" placeholder="Name"
                                                ref="name"
                                                :modelValue="book.name"
                                                v-model="form.name" 
                                            />
                                            <jet-label class="mt-1 text-lg" value="Book's author"/> 
                                            <jet-input type="text" class="mt-1 block" placeholder="Author"
                                                ref="author"
                                                :modelValue="book.author"
                                                v-model="form.author" 
                                            />
                                            <jet-label class="mt-1 text-lg" value="Total number of pages"/> 
                                            <jet-input type="text" class="mt-1 block" placeholder="Total pages"
                                                ref="pages"
                                                :modelValue="book.pages"
                                                v-model="form.pages" 
                                            />
                                            <jet-label class="mt-1 text-lg" value="Number of readed pages"/> 
                                            <jet-input type="text" class="mt-1 block" placeholder="Pages readed"
                                                ref="current_page"
                                                :modelValue="book.current_page"
                                                v-model="form.current_page" 
                                            />
                                            <div class="flex items-center space-x-10 justify"> 
                                                <div class="flex items-center">
                                                    <jet-label class="mt-1 text-lg mr-1" 
                                                    value="Is an favorite?"/> 
                                                    <jet-checkbox class="mt-1" 
                                                        :checked="book.favorite == 0 ? false : true"
                                                        ref="favorite"
                                                        v-model="form.favorite" 
                                                    />
                                                </div>
                                                <div class="flex items-center ">
                                                    <jet-label class="mt-1 text-lg mr-1" 
                                                    value="Is for leisure?"/> 
                                                    <jet-checkbox class="mt-1"
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
                        </modal-add-new>
                    </div>
                </template>
            </div>
        </div>
        <div class="flex justify-center flex-wrap mx-44 space-x-2 ">
            <render-item :itens="books" :itemName="'books'"
            @updateModal="updateModal"
            />
        </div>
        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetButton from '@/Jetstream/Button.vue';
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
    import JetInput from '@/Jetstream/Input.vue';
    import JetCheckbox from '@/Jetstream/Checkbox.vue';
    import JetLabel from '@/Jetstream/Label.vue';
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
    import ModalAddNew from '../../Components/ModalAddNew.vue';
    import RenderItem from '../../Components/RenderItem.vue';
    import Icon from '../../Components/Icons.vue';


    export default {
        props:{
            books: Object
        },
        components: {
            AppLayout,
            JetButton,
            JetSectionBorder,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            ModalAddNew,
            RenderItem,
            Icon
        },
        created(){
            console.log(this.books)
        },
        data(){
            return{
                isModalAddActive: false,
                isModalUpdateActive: false,
                book: {},
                form: this.$inertia.form({
                    name: '',
                    author:'',
                    pages: '',
                    current_page: '',
                    favorite: false,
                    leisure: true
                }),
            }
        },
        methods:{
            closeAddModal(){
                this.form.reset();
                this.isModalAddActive = false;
            },
            closeUpdateModal(){
                this.form.reset();
                this.isModalUpdateActive = false;
            },
            updateModal(childProps){
                this.book = childProps.book;
                this.isModalUpdateActive = childProps.value;
            },
            store() {
                this.form.post(this.route('books.store'), {
                    onSuccess: () => {
                        this.closeAddModal();
                    }
                });
            },
            update() {
                this.form.patch((`/books/${this.book.id}`), {
                    onSuccess: () => {
                        this.closeUpdateModal();
                    },
                });
            },
            destroy(){
                this.$inertia.delete((`/books/${this.book.id}`), {
                    onSuccess: () => {
                        this.closeUpdateModal();
                    }
                });
            },

        }
    }
</script>
