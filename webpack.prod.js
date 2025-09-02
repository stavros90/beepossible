const microtime = Date.now().toString()
const RemovePlugin = require("remove-files-webpack-plugin")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const CopyPlugin = require("copy-webpack-plugin")
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");


const prodConfig = {
  output: {
    filename: "./assets/scripts/[name].js",
    publicPath: `/wp-content/themes/beepossible/dist/`
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [MiniCssExtractPlugin.loader, "css-loader?url=false", "sass-loader"]
      },
      {
        test: /\.(png|jpe?g|gif|mp4|svg|webp|ico)$/i,
        loader: "file-loader",
        options: {
          name: "./assets/[folder]/[name].[ext]"
        }
      }
    ]
  },
  optimization: {
    minimize: true,
    minimizer: [
      new CssMinimizerPlugin({
        minimizerOptions: {
          preset: [
            "default",
            {
              discardComments: { removeAll: false },
            },
          ],
        },
      }),
      new TerserPlugin(),
    ],
  },
  plugins: [
    new RemovePlugin({ before: { include: ["./dist"] } }),
    new MiniCssExtractPlugin({ filename: "./style.css" }),
    new CopyPlugin({
      patterns: [
        {
          from: "**/*.php",
          transform(content) {
            return content.toString()
            .replace(`wp_enqueue_script( 'beepossible-script', 'http://localhost:8080/app.js', [], '1', true );`,
            `wp_enqueue_script( 'beepossible-script', get_template_directory_uri() . '/assets/scripts/app.js', [], '${microtime}', true );`)
            .replace(`// wp_enqueue_style( 'beepossible-style', get_stylesheet_uri() );`,
            `wp_enqueue_style( 'beepossible-style', get_stylesheet_uri(), [], '${microtime}', 'all' );`)
          }
        },
        {
          from: "includes/login",
          to: "includes/login"
        },
        {
          from: "assets/images",
          to: "assets/images"
        },
        {
          from: "assets/fonts",
          to: "assets/fonts"
        },
        {
          from: "screenshot.jpg",
          to: "screenshot.jpg"
        }
      ]
    })
  ]
}

module.exports = prodConfig
