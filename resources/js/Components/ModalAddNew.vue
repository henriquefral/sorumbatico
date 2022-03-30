<template>
    <jet-action-section>
        <template #content> 
            <jet-dialog-modal :show="isModalActive" @close="closeModal">
                <template #title>
                    Add new book
                </template>

                <template #content>
                    <slot/>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>
                    <jet-button class="ml-3" :class="{ 'opacity-25': processing }" :disabled="processing" @click="submit">
                        Add 
                    </jet-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button.vue'
    import JetActionSection from '@/Jetstream/ActionSection.vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default {    
        props:{
            isModalActive:Boolean,
            processing: Boolean,
            title: String,
        },
        components: {
            JetDialogModal,
            JetActionSection,
            JetSecondaryButton,
            JetDangerButton,
            JetButton
        },
        methods:{
            closeModal(){
                this.$emit('closeModal');
            },
            submit(){
                this.$emit('submit');
            },
        }
    }
</script>
