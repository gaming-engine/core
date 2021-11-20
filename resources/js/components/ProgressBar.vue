<template>
    <div class="relative pt-1">
        <div :class="`bg-${colour}-200`" class="overflow-hidden h-2 text-xs flex rounded">
            <div
                :class="`bg-${colour}-400`"
                :style="{
                    width: `${percentage}%`
                }"
                class="
                shadow-none
                flex flex-col
                text-center
                whitespace-nowrap
                text-white
                justify-center
              "
            ></div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'ProgressBar',

  props: {
    percentage: {
      type: Number,
      required: true,
    },
    colour: {
      type: String,
      required: false,
      default: 'purple',
    },
  },
};
</script>
