<template>
  <div v-if="isMask"  class="mask animated fadeIn" :class="{'fadeOut' : isMask === false}">
    <div class="mask_inner">
     <slot></slot>
    </div>
  </div>
</template>
<script>
export default{
  data () {
    return {
    };
  },
  props: {
    isMask: Boolean
  },
  methods: {
  }
};
</script>
<style lang="less">
body{
  position: relative;
}
.mask{
  width: 100%;
  height: 100%;
  // padding: 20%; 
  position: fixed;
  // overflow: auto;
  top: 0;
  z-index: 11;
  left: 0;
  background: rgba(0, 0, 0, 0.6);
  .mask_inner{
    width: 70%;
    min-width: 350px;
    max-width: 500px;
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 12;
    transform: translate(-50%, -50%);
  }
}
</style>
