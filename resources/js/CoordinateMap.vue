<template>
  <div>
    <div v-if="editable">
      <div>
        <label>
          Latitude
          <input
            class="w-full form-control form-input form-input-bordered"
            :value="latLngInput.lat"
            @input="handleLatLngInputUpdate($event, 'lat')"
          >
        </label>
      </div>

      <div>
        <label>
          Longitude:
          <input
            class="w-full form-control form-input form-input-bordered"
            :value="latLngInput.lng"
            @input="handleLatLngInputUpdate($event, 'lng')"
          >
        </label>
      </div>
    </div>
    <div v-else>
      Lat/Lng: {{ latitude }}, {{ longitude }}
    </div>

    <l-map v-bind:zoom="18" v-bind:center="latLngInput" style="height: 200px" ref="map">
      <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
      <l-marker
        :lat-lng="latLngInput"
        :draggable="editable"
        :options="{ autoPan: true }"
        :icon="getIcon()"
        @update:lat-lng="handleMarkerUpdate"
      />
    </l-map>
  </div>
</template>

<script>

import L, { Icon, latLng } from 'leaflet'
import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from '@vue-leaflet/vue-leaflet'

import 'leaflet/dist/leaflet.css'

delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});

export default {

  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip
  },

  props: {
    latitude: Number,
    longitude: Number,
    editable: {
      type: Boolean,
      default: false
    }
  },

  data () {
    return {
      latLngInput: this.latitude ? latLng(this.latitude, this.longitude) : latLng(30, -90),
    }
  },

  methods: {
    handleLatLngInputUpdate (e, attr) {
      this.latLngInput[attr] = e.target.value
      this.$refs.map.mapObject.panTo(this.latLngInput)
    },

    handleMarkerUpdate (latLng) {
      this.latLngInput.lat = latLng.lat
      this.latLngInput.lng = latLng.lng
      this.emitUpdate()
    },

    emitUpdate () {
      this.$emit('update', [this.latLngInput.lat, this.latLngInput.lng])
    },

    getIcon () {
      return L.divIcon({
        iconSize: [20, 20],
        iconAnchor: [10, 40], // move the tip to the exact coordinates
        className: '', // remove the border and background
        html: '<img src="/vendor/nova-map-tools/marker-icon.png">'
      })
    }
  }
}

</script>
