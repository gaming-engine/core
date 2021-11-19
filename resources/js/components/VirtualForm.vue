<template>
    <form ref="form" :action="action" :method="method" @submit.prevent="submit">
        <slot></slot>

        <span ref="spinner" class="hidden">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4">
                </circle>
                <path class="opacity-75"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                      fill="currentColor"></path>
            </svg>
        </span>
    </form>
</template>

<script>
export default {
  name: 'VirtualForm',

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
    },
  },

  data: () => ({
    state: 'idle',
    buttonContent: '',
  }),

  computed: {
    url() {
      return this.apiAction ?? this.action;
    },

    formElements() {
      const { form } = this.$refs;

      return Array.from(form.querySelectorAll('input, button'));
    },

    submitButton() {
      return this.$refs.form
        .querySelector('button[type="submit"]');
    },
  },

  methods: {
    setState(state) {
      this.state = state;
    },

    disableForm() {
      this.formElements.forEach((element) => {
        /* eslint no-param-reassign: ["error", { "props": false }] */
        element.disabled = true;
      });

      this.submitButton.innerHTML = `${this.$refs.spinner.innerHTML}${this.buttonContent}`;
    },

    enableForm() {
      this.formElements.forEach((element) => {
        /* eslint no-param-reassign: ["error", { "props": false }] */
        element.disabled = false;
      });

      this.submitButton.innerHTML = this.buttonContent;
    },

    submit() {
      this.disableForm();

      setTimeout(() => {
        this.enableForm();
      }, 1000);
    },
  },

  mounted() {
    this.buttonContent = this.submitButton.innerHTML;
  },
};
</script>

<style scoped>
input[type=text]:disabled {
    background-color: green !important;
}
</style>
