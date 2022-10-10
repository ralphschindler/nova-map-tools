import IndexCoordinatesField from './coordinate-field/IndexField'
import DetailCoordinatesField from './coordinate-field/DetailField'
import FormCoordinatesField from './coordinate-field/FormField'

Nova.booting((app) => {
  app.component('index-coordinates-field', IndexCoordinatesField)
  app.component('detail-coordinates-field', DetailCoordinatesField)
  app.component('form-coordinates-field', FormCoordinatesField)
})
