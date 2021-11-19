<template>
    <div>
        <label
            :for="id"
            class="block text-sm font-medium leading-5 text-gray-700"
        >
            {{ label }}:
            <small
                v-if="description"
                class="text-xs font-small"
            >{{ description }}</small>
            <template v-if="required">*</template>
        </label>
        <div class="mt-1 relative rounded-md shadow-sm">

            <input
                :id="id"
                ref="field"
                v-model="value"
                :class="{
                'bg-gray-100': disabled,
                'cursor-not-allowed': disabled
            }"
                :disabled="disabled"
                :placeholder="placeholder ?? label"
                :type="type"
                class="
                    appearance-none block
                    w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400
                    focus:outline-none focus:shadow-outline-blue focus:border-blue-300
                    transition duration-150 ease-in-out sm:text-sm sm:leading-5
                ">
            <div
                v-if="hasSuffix"
                ref="suffix"
                class="
                    absolute
                    inset-y-0
                    right-0
                    pr-3
                    flex
                    items-center
                    bg-gray-300
                    pl-3
                    rounded-r-md
                ">
                <slot name="suffix"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'input-field',

  props: {
    id: {
      required: true,
      type: String,
    },
    type: {
      required: false,
      type: String,
      default: 'text',
    },
    disabled: {
      required: false,
      type: Boolean,
      default: false,
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
    placeholder: {
      required: false,
      type: String,
      default: undefined,
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
  }),

  computed: {
    hasSuffix() {
      return !!this.$slots.suffix;
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
