const webpack = require('webpack')

let settings
try {
    settings = require('./vue.config.settings')
} catch (ex) {
    settings = {}
}

settings = Object.assign({}, require('./vue.config.settings.default'), settings)

const config = {
    lintOnSave: true,
    devServer: {
        host: settings.host,
        port: settings.port,
        disableHostCheck: true,
        proxy: {
            '/api': {
                target: settings.symfony,
                secure: false,
                changeOrigin: true
            }
        },
        watchOptions: {
            poll: 1000,
        }
    }
}

module.exports = config