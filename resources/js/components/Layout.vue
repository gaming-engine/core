<template>
    <div>
        <slot @collapse=""></slot>
    </div>
</template>

<script>
export default {
  name: 'Layout',

  data: () => ({
    collapsed: true,
  }),

  methods: {
    test() {
      alert('hello');
    },
  },

  watch: {
    collapsed(newValue) {
      alert('hello');
    },
  },
};
</script>

<style scoped>

</style>
