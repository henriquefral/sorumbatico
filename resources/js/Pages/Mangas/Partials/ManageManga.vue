<template>
    <div>
        <template>
        <Modal :isModalActive="isModalActive" title="Update Manga" 
        class="mt-10 sm:mt-0" @closeModal="closeModal()" @update="update" :method="update"
        :processing="form.processing">
            <template #title>
                <icon name="delete" class="w-5 h-5 fill-current hover:text-red-900 cursor-pointer" @click="destroy(manga.id)"/>
            </template>
            <template #content>
                <div class="flex flex-row space-x-2">
                    <div class="max-w-[35%]">
                        <div>
                            Manga name: {{manga.name}}
                        </div>
                        <div>
                            Author: {{manga.author}}
                        </div>
                        <div>
                            Progress: {{manga.pages}}/{{manga.current_page}}
                        </div>
                        <div>
                            Is favorite? {{manga.favorite == 1 ? 'Yes' : 'No'}}
                        </div>
                    </div> 
                    <form @submit.prevent="update">
                        <div>
                            <jet-label class="mt-1 text-lg" value="Manga name"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                ref="name"
                                :modelValue="manga.name"
                                v-model="form.name" 
                            />
                            <jet-label class="mt-1 text-lg" value="Manga author"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Author"
                                ref="author"
                                :modelValue="manga.author"
                                v-model="form.author" 
                            />
                            <jet-label class="mt-1 text-lg" value="Total number of chapters"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Total chapters"
                                ref="chapters"
                                :modelValue="manga.chapters"
                                v-model="form.chapters" 
                            />
                            <jet-label class="mt-1 text-lg" value="Number of readed chapters"/> 
                            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Chapters readed"
                                ref="current_chapter"
                                :modelValue="manga.current_chapter"
                                v-model="form.current_chapter" 
                            />
                            <div class="flex items-center space-x-10 justify"> 
                                <div class="flex items-center">
                                    <jet-label class="mt-1 text-lg mr-1" 
                                    value="Is an favorite?"/> 
                                    <jet-checkbox class="mt-1 block" 
                                        :checked="manga.favorite == 0 ? false : true"
                                        ref="favorite"
                                        v-model="form.favorite" 
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
            manga: Object
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
                this.form.patch((`/mangas/${this.manga.id}`), {
                    onSuccess: () => {
                        this.closeModal();
                    },
                });
            },
            destroy(){
                this.$inertia.delete((`/mangas/${this.manga.id}`), {
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
        },
        
    }
</script>

