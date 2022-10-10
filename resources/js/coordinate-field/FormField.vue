<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <div v-if="this.latitude !== null">
        <CoordinateMap
          :latitude="latitude"
          :longitude="longitude"
          :type="type"
          :editable="true"
          @update="handleCoordinateMapUpdate"
        />

        <a
          class="underline text-primary"
          @click.prevent="removeLocation"
        >
          Remove location
        </a>
      </div>
      <div v-else>
        No location, <a class="underline text-primary" @click.prevent="setDefaultLocation">add one.</a>
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import CoordinateMap from '../CoordinateMap'

export default {
  mixins: [FormField, HandlesValidationErrors],

  components: {
    CoordinateMap
  },

  props: {
    resourceName: String,
    resourceId: String,
    field: Object
  },

    // ['resourceName', 'resourceId', 'field'],

  data () {
    return {
      latitude: this.field.value.latitude ?? null,
      longitude: this.field.value.longitude ?? null,
    }
  },

  methods: {
    debug () {
      console.log(this.latitude, this.longitude, this.azimuth, this.type)
    },

    setDefaultLocation () {
      this.latitude = this.field.defaultCenter.latitude ?? 30
      this.longitude = this.field.defaultCenter.longitude ?? -90
    },

    removeLocation () {
      this.latitude = null
      this.longitude = null
    },

    fill (formData) {
      // null is not a valid FormData value, must be strings
      const value = this.latitude !== null
        ? JSON.stringify({ latitude: this.latitude, longitude: this.longitude, azimuth: this.azimuth })
        : ''

      formData.append(this.field.attribute, value)
    },

    handleCoordinateMapUpdate (latitudeLongitude) {
      this.latitude = latitudeLongitude[0]
      this.longitude = latitudeLongitude[1]
    }
  }
}
</script>
