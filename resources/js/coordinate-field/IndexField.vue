<template>
    <span>
      {{ fieldValue }}
    </span>
</template>

<script>
export default {
  props: ['resourceName', 'field'],

  computed: {
    fieldValue() {
      if (this.field.displayedAs) {
        return this.field.displayedAs
      }

      if (this.field.value) {
        debugger
        return this.field.value.latitude + ' / ' + this.field.value.longitude
      }

      return 'n/a'
    },
  }
}
</script>
