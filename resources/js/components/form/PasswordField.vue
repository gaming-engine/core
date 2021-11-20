/* eslint-disable max-len */
<template>
    <div>
        <label
            :for="id"
            class="block text-sm font-medium leading-5 text-gray-700"
        >
            {{ label }}:
            <small v-if="description" class="text-xs font-small">{{
                    description
                }}</small>
            <template v-if="required">*</template>
        </label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input
                :id="id"
                ref="field"
                v-model="value"
                :autocomplete="autocomplete"
                :class="{
                    'bg-gray-100': disabled,
                    'cursor-not-allowed': disabled,
                }"
                :disabled="disabled"
                :name="name ?? id"
                :placeholder="label"
                :required="required"
                :type="type"
                class="
                    mt-1
                    form-input
                    block
                    w-full
                    py-2
                    px-3
                    border border-gray-300
                    rounded-md
                    shadow-sm
                    focus:outline-none
                    focus:shadow-outline-blue
                    focus:border-blue-300
                    transition
                    duration-150
                    ease-in-out
                    sm:text-sm sm:leading-5
                "
            />
            <div
                ref="toggle"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                @click="showPassword = !showPassword"
            >
                <svg
                    v-if="showPassword"
                    class="h-5 w-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path
                        clip-rule="evenodd"
                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                        fill-rule="evenodd"
                    />
                </svg>
                <svg
                    v-else
                    class="h-5 w-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        clip-rule="evenodd"
                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                        fill-rule="evenodd"
                    />
                    <path
                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"
                    />
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'password-field',

  props: {
    id: {
      required: true,
      type: String,
    },
    name: {
      required: false,
      type: String,
    },
    disabled: {
      required: false,
      type: Boolean,
      default: false,
    },
    autocomplete: {
      required: false,
      type: String,
      default: '',
    },
    description: {
      required: false,
      type: String,
      default: undefined,
    },
    label: {
      required: true,
      type: String,
    },
    modelValue: {
      required: false,
      type: String,
      default: undefined,
    },
    required: {
      required: false,
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    value: '',
    showPassword: false,
  }),

  computed: {
    type() {
      return this.showPassword ? 'text' : 'password';
    },
  },

  created() {
    this.value = this.modelValue;
  },

  watch: {
    modelValue(newValue) {
      this.value = newValue;
    },

    value(newValue) {
      if (newValue === this.modelValue) {
        return;
      }

      this.$emit('update:modelValue', newValue);
    },
  },
};
</script>
