<template>
    <app-layout title="Books">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Books
                </h2>
                
                <jet-button class="" @click.prevent="isModalActive = !isModalActive">
                    Add new book
                </jet-button>
            </div>

        </template>

 
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <template>
                    <jet-section-border />

                    <add-new-book class="mt-10 sm:mt-0"  @closeModal="closeModal" 
                    @submit="submit" :isModalActive="isModalActive" :processing="form.processing" 
                    title="Add new book"
                    >
                        <form @submit.prevent="submit">
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
                    </add-new-book>
                </template>
            </div>
        </div>
        
        <render-book :books="books"/>
        
        
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import JetButton from '@/Jetstream/Button.vue';
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
    import JetInput from '@/Jetstream/Input.vue';
    import JetCheckbox from '@/Jetstream/Checkbox.vue';
    import JetLabel from '@/Jetstream/Label.vue';
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
    import AddNewBook from '../../Components/ModalAddNew.vue';
    import RenderBook from '../../Components/RenderItem.vue';


    export default defineComponent({
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
            AddNewBook,
            RenderBook
        },
        created(){
            console.log(this.books)
        },
        data(){
            return{
                isModalActive: false,
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
            closeModal(){
                this.isModalActive = false;
            },
            submit() {
                this.form.post(this.route('books.store'), {
                    onFinish: () => {
                        if(this.$page.props.errors){
                            
                        } else {
                            this.closeModal()
                        }
                    }
                })
            },

        }
    })
</script>
