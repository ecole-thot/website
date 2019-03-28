var Encore = require('@symfony/webpack-encore')

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')

  .addEntry('app', './assets/js/app.js')
  .addEntry('admin', './assets/js/admin.js')

  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
// enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

// enables Sass/SCSS support
  .enableSassLoader()

  .autoProvidejQuery()

  .enableSingleRuntimeChunk()
  .splitEntryChunks()

  .configureTerserPlugin((options) => {
    if (Encore.isProduction()) {
      options.terserOptions = {
        compress: {
          drop_console: true
        }
      }
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
