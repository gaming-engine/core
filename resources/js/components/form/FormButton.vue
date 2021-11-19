<template>
    <button
        ref="button"
        :class="{
            'bg-gray-100': disabled,
            'cursor-not-allowed': disabled,
            'hover:bg-gray-200': !disabled,
            'hover:text-gray-600': !disabled
        }"
        :disabled="disabled"
        class="
            inline-flex
            items-center
            px-6
            py-3
            bg-gray-100
            text-gray-500
            rounded-md
        "
        @click="$emit('click')">
        {{ text }}
    </button>
</template>

<script>
export default {
  name: 'form-button',

  props: {
    disabled: {
      required: false,
      type: Boolean,
      default: false,
    },
    text: {
      required: true,
      type: String,
    },
  },
};
</script>
