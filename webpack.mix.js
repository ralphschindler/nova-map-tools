const mix = require('laravel-mix')
const path = require('path')

require('./nova.mix')

mix.setPublicPath('dist')
  .js('resources/js/index.js', 'nova-map-tools.js')
  // .css('resources/css/nova-map-tools.css', 'css')
  .options({
    terser: {
      extractComments: false,
    }
  })
  .alias({
    'laravel-nova': path.join(
      __dirname,
      'vendor/laravel/nova/resources/js/mixins/packages.js'
    )
  })
  .vue({ version: 3 })
  .nova('nova-map-tools')

if (! mix.inProduction()) {
  mix.sourceMaps()
}
