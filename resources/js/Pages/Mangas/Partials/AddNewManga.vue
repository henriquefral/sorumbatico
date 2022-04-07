<template>
    <div>
        <template>
        <Modal :isModalActive="isModalAddActive" title="Add new Manga" 
        class="mt-10 sm:mt-0" @closeModal="closeModal()" @store="store" :method="store"
        :processing="form.processing">
            <template #content> 
                <form @submit.prevent="store">
                    <div class="mt-4">
                        <jet-label class="mt-1 text-lg" value="Manga name"/> 
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                            ref="name"
                            v-model="form.name" 
                        />
                        <jet-label class="mt-1 text-lg" value="Manga author"/> 
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Author"
                            ref="author"
                            v-model="form.author" 
                        />
                        <jet-label class="mt-1 text-lg" value="Total number of chapters"/> 
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Total chapters"
                            ref="chapters"
                            v-model="form.chapters" 
                        />
                        <jet-label class="mt-1 text-lg" value="Number of readed chapters"/> 
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Chapters readed"
                            ref="current_page"
                            v-model="form.current_chapter" 
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
                        </div>  
                        <jet-validation-errors class="mt-4"/>
                    </div>
                </form>
            </template>
        </Modal>
        </template>
    </div>
</template>

<script>
    import Modal from '../../../Components/Modal.vue';
    import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
    import JetCheckbox from '@/Jetstream/Checkbox.vue';
    import JetInput from '@/Jetstream/Input.vue';
    import JetLabel from '@/Jetstream/Label.vue';

    export default {
        emits: ["closeModal"],
        props: {
            isModalAddActive: Boolean,
        },

        components: {
            JetSectionBorder,
            JetValidationErrors,
            JetCheckbox,
            JetInput,
            JetLabel,
            Modal
        },
        methods:{
            closeModal(){
                this.$emit('closeModal');
            },
            store() {
                this.form.post(this.route('mangas.store'), {
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
                    chapters: '',
                    current_chapter: '',
                    favorite: false,
                }),
            }
        }
    }
</script>

