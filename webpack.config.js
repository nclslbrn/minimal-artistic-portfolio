// Webpack uses this to work with directories
const path = require('path');

const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const ImageminPlugin = require('imagemin-webpack-plugin').default

const CopyWebpackPlugin = require('copy-webpack-plugin');

const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const backConfig = {
    entry: './src/js/back.js',
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'js/back-bundle.js'
    },
    mode: 'development',
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /(node_modules)/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }, { // Apply rule for .sass, .scss or .css files
            test: /\.(sa|sc|c)ss$/,

            // Set loaders to transform files.
            // Loaders are applying from right to left(!)
            // The first loader will be applied after others
            use: [{
                    // After all CSS loaders we use plugin to do his work.
                    // It gets all transformed CSS and extracts it into separate
                    // single bundled file
                    loader: MiniCssExtractPlugin.loader
                },
                {
                    // This loader resolves url() and @imports inside CSS
                    loader: "css-loader",
                    options: {
                        url: false,
                        sourceMap: true
                    }
                },
                {
                    // Then we apply postCSS fixes like autoprefixer and minifying
                    loader: "postcss-loader",
                    options: {
                        ident: 'postcss',
                        plugins: (loader) => [
                            require('autoprefixer'),
                            require('cssnano')
                        ]
                    }
                },
                {
                    // First we transform SASS to standard CSS
                    loader: "sass-loader",
                    options: {
                        implementation: require("sass"),
                        sourceMap: true
                    }
                }
            ]
        }]
    },
    plugins: [

        new MiniCssExtractPlugin({
            filename: "../editor-preview.css"
        }),
        new CopyWebpackPlugin([{
            from: 'src/img',
            to: 'images',
            force: true
        }]),
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i
        }),
        new BrowserSyncPlugin({
            // browse to http://localhost:3000/ during development,
            // ./public directory is being served
            host: 'localhost',
            port: 3030,
            proxy: 'nicolas-lebrun.test'
        })
    ]
};

const editorConfig = {
    entry: './src/js/editor.js',
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'js/editor.js'
    },
    mode: 'development',
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /(node_modules)/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }]
    }
};

const frontConfig = {

    entry: './src/js/front.js',
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'js/front-bundle.js'
    },
    mode: 'development',
    devtool: "source-map",
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /(node_modules)/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }, {
            test: require.resolve('jquery'),
            use: [{
                loader: 'expose-loader',
                options: 'jQuery'
            }, {
                loader: 'expose-loader',
                options: '$'
            }]
        }, { // Apply rule for .sass, .scss or .css files
            test: /\.(sa|sc|c)ss$/,

            // Set loaders to transform files.
            // Loaders are applying from right to left(!)
            // The first loader will be applied after others
            use: [{
                    // After all CSS loaders we use plugin to do his work.
                    // It gets all transformed CSS and extracts it into separate
                    // single bundled file
                    loader: MiniCssExtractPlugin.loader
                },
                {
                    // This loader resolves url() and @imports inside CSS
                    loader: "css-loader",
                    options: {
                        url: false,
                        sourceMap: true
                    }
                },
                {
                    // Then we apply postCSS fixes like autoprefixer and minifying
                    loader: "postcss-loader",
                    options: {
                        ident: 'postcss',
                        plugins: (loader) => [
                            require('autoprefixer'),
                            require('cssnano')
                        ]
                    }
                },
                {
                    // First we transform SASS to standard CSS
                    loader: "sass-loader",
                    options: {
                        implementation: require("sass"),
                        sourceMap: true
                    }
                }
            ]
        }]
    },
    plugins: [

        new MiniCssExtractPlugin({
            filename: "../style.css"
        }),
        new CopyWebpackPlugin([{
            from: 'src/img',
            to: 'images',
            force: true
        }]),
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i
        }),
        new BrowserSyncPlugin({
            // browse to http://localhost:3000/ during development,
            // ./public directory is being served
            host: 'localhost',
            port: 3030,
            proxy: 'nicolas-lebrun.test'
        })
    ]

};

module.exports = [frontConfig, backConfig, editorConfig]