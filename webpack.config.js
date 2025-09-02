const path = require("path")
const { merge } = require("webpack-merge")

const devConfig = require("./webpack.dev")
const prodConfig = require("./webpack.prod")

const modeConfig = process.env.NODE_ENV === "production" ? prodConfig : devConfig

const commonConfig = {
  mode: process.env.NODE_ENV === "production" ? "production" : "development",
  entry: {
    app: "./assets/scripts/index.js"
  },
  output: {
    path: path.resolve(__dirname, "dist")
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: ["babel-loader"]
      },
      {
        test: /\.(png|jpe?g|gif|mp4|svg|webp|ico)$/i,
        loader: "file-loader",
        options: {
          name: "./assets/[folder]/[name].[ext]"
        }
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: ["file-loader"]
      }
    ]
  },
  plugins: []
}

module.exports = merge(commonConfig, modeConfig)
