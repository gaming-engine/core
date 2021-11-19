<template>
    <div>
        <label :for="id" class="block text-sm font-medium leading-5 text-gray-700">
            {{ label }}:
            <small
                v-if="description"
                class="text-xs font-small"
                role="note"
            >{{ description }}</small>
        </label>
        <select
            :id="id"
            ref="select"
            v-model="value"
            :class="{
                'bg-gray-100': disabled,
                'cursor-not-allowed': disabled
            }"
            :disabled="disabled"
            class="
            mt-1
            block
            form-select
            w-full
            py-2
            px-3
            border
            border-gray-300
            bg-white
            rounded-md
            shadow-sm
            focus:outline-none
            focus:shadow-outline-blue
            focus:border-blue-300
            transition
            duration-150
            ease-in-out
            sm:text-sm
            sm:leading-5
        "
        >
            <option v-for="option in options" :key="`${id}-${option.value}`" :value="option.value">
                {{ option.text }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
  name: 'drop-down',

  props: {
    id: {
      required: true,
      type: String,
    },
    description: {
      required: false,
      type: String,
      default: undefined,
    },
    disabled: {
      required: false,
      type: Boolean,
      default: false,
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
    options: {
      required: true,
      type: Array,
    },
  },

  data: () => ({
    value: '',
  }),

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
