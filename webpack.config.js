// Webpack uses this to work with directories
const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const { extendDefaultPlugins } = require('svgo')

const backConfig = (mode = {
    entry: ['@babel/polyfill', './src/js/back.js'],
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'js/back-bundle.js'
    },
    // -> add it contextually to env  mode: 'development',
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            implementation: require('sass'),
                            sourceMap: true
                        }
                    },
                    'postcss-loader'
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../admin-css-hack.css'
        })
    ]
})

const editorConfig = (mode = {
    entry: ['@babel/polyfill', './src/js/editor.js'],
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'js/editor.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader'
                }
            }
        ]
    }
})

const frontConfig = (mode = {
    entry: './src/js/front.js',
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'js/front-bundle.js'
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader'
                }
            },
            {
                test: require.resolve('jquery'),
                loader: 'expose-loader',
                options: {
                    exposes: {
                        globalName: '$',
                        override: true
                    }
                }
            },
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                ident: 'postcss',
                                plugins: (loader) => [
                                    require('autoprefixer'),
                                    require('cssnano')
                                ]
                            }
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            implementation: require('sass'),
                            sourceMap: true
                        }
                    }
                ]
            },
            {
                test: /\.(gif|png|jpe?g|svg)$/i,
                use: [
                    'file-loader',
                    {
                        loader: 'image-webpack-loader',
                        options: {
                            bypassOnDebug: true, // webpack@1.x
                            disable: true // webpack@2.x and newer
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../style.css'
        }),
        new CopyWebpackPlugin({
            patterns: [
                {
                    from: 'src/fonts',
                    to: 'fonts',
                    force: true
                },
                {
                    from: 'src/img',
                    to: 'img',
                    force: true
                }
            ]
        }),
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3030,
            proxy: 'nicolas-lebrun.test',
            browser: 'firefox -start-debugger-server',
            open: true
        })
    ],
    stats: 'minimal'
})

module.exports = (env, argv) => {
    console.log('MODE ' + argv.mode.toUpperCase())

    if (argv.mode === 'development') {
        frontConfig.devtool = 'source-map'
        backConfig.devtool = 'source-map'

        //editorConfig.devtool = 'source-map'
    }
    return [frontConfig, backConfig, editorConfig]
}
