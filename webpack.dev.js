const chokidar = require("chokidar")

const devConfig = {
  output: {
    publicPath: `http://${process.env.npm_package_name}.local/`
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: ["style-loader", "css-loader", "sass-loader"]
      }
    ]
  },
  devServer: {
    client: {
      webSocketTransport: 'ws',
      logging: 'none'
    },

    webSocketServer: 'ws',
    setupMiddlewares: (middlewares, devServer) => {
      chokidar.watch(["./**/*.php"]).on("all", function (event, path) {
        devServer.sendMessage(devServer.webSocketServer.clients, "content-changed")
      })
      middlewares.push(devServer);
      return middlewares;
    },
    port: 8080,
    compress: true,
    devMiddleware: {
      stats: 'errors-only',
    },
    historyApiFallback: true,
    allowedHosts: "all",
  }
}

module.exports = devConfig
