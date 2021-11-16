<template>
    <form ref="form" :action="action" :method="method" @submit.prevent="submit">
        <slot></slot>
    </form>
</template>

<script>
export default {
    name: "VirtualForm",

    props: {
        action: {
            type: String,
            required: false,
            default: '',
        },
        method: {
            type: String,
            required: false,
            default: 'POST',
        },
        apiAction: {
            type: String,
            required: false,
            default: undefined,
        }
    },

    data: () => ({
        state: 'idle',
    }),

    computed: {
        url() {
            return this.apiAction ?? this.action;
        },

        formElements() {
            const form = this.$refs.form;

            return Array.from(form.getElementsByTagName('input'))
                .concat(Array.from(form.getElementsByTagName('button')));
        }
    },

    methods: {
        setState(state) {
            this.state = state;
        },

        submit() {
            this.formElements.forEach(element => {
                element.disabled = true;
            });
        }
    }
}
</script>

<style scoped>

</style>
