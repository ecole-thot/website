var Encore = require('@symfony/webpack-encore')

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')

  .addEntry('js/app', './assets/js/app.js')
  .addEntry('js/admin', './assets/js/admin.js')
  .addStyleEntry('css/app', './assets/css/app.scss')
  .addStyleEntry('css/admin', './assets/css/admin.scss')

  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
// enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

// enables Sass/SCSS support
  .enableSassLoader()

  .autoProvidejQuery()

  .configureUglifyJsPlugin((uglifyJsPluginConfig) => {
    if (Encore.isProduction()) {
      uglifyJsPluginConfig.compress = { drop_console: true }
    }
  })

// Retrieve the config
const config = Encore.getWebpackConfig()

// Change the kind of source map generated in
// development mode
if (!Encore.isProduction()) {
  config.devtool = 'eval-source-map'
}

// Export the config
module.exports = config
