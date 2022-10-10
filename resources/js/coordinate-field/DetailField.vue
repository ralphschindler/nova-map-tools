<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <div v-if="this.latitude !== null">
        <coordinate-map
          v-bind:latitude="latitude"
          v-bind:longitude="longitude"
          v-bind:type="type"
        ></coordinate-map>
      </div>
      <div v-else>
        No Location
      </div>
    </template>
  </PanelItem>
</template>

<script>
import CoordinateMap from '../CoordinateMap'

export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  components: {
    CoordinateMap
  },

  data () {
    return {
      latitude: this.field.value.latitude ?? null,
      longitude: this.field.value.longitude ?? null,
    }
  }
}
</script>
