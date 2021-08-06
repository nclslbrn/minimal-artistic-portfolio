// Webpack uses this to work with directories
const path = require('path')
const webpack = require('webpack')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const WebpackBar = require('webpackbar')
const { extendDefaultPlugins } = require('svgo')
module.exports = (env, argv) => {
    const mode = argv.mode
    const backConfig = {
        entry: './src/js/back.js',
        output: {
            path: path.resolve(__dirname, 'build'),
            filename: 'js/back-bundle.js'
        },
        mode: argv.mode,
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
            new CleanWebpackPlugin(),
            new MiniCssExtractPlugin({
                filename: '../../admin-css-hack.css'
            }),
            new WebpackBar()
        ]
    }

    const frontConfig = {
        entry: './src/js/front.js',
        output: {
            path: path.resolve(__dirname, 'build'),
            filename: 'js/front-bundle.js'
        },
        mode: mode,
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
                    // Apply rule for .sass, .scss or .css files
                    test: /\.(sa|sc|c)ss$/,

                    // Set loaders to transform files.
                    // Loaders are applying from right to left(!)
                    // The first loader will be applied after others
                    use: [
                        {
                            // After all CSS loaders we use plugin to do his work.
                            // It gets all transformed CSS and extracts it into separate
                            // single bundled file
                            loader: MiniCssExtractPlugin.loader
                        },
                        {
                            // This loader resolves url() and @imports inside CSS
                            loader: 'css-loader',
                            options: {
                                url: false,
                                sourceMap: true
                            }
                        },
                        /* {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    plugins: [
                                        [
                                            'postcss-preset-env',
                                            {
                                                // Options
                                            }
                                        ]
                                    ]
                                }
                            }
                        }, */
                        {
                            // First we transform SASS to standard CSS
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
                    include: path.resolve(__dirname, './src/img'),
                    exclude: path.resolve(__dirname, './src/fonts'),
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].[ext]',
                                outputPath: 'img/'
                            }
                        },
                        {
                            loader: 'image-webpack-loader',
                            options: {
                                bypassOnDebug: true, // webpack@1.x
                                disable: true // webpack@2.x and newer
                            }
                        }
                    ]
                },
                {
                    // fonts
                    test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                    include: path.resolve(__dirname, './src/fonts'),
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].[ext]',
                                outputPath: 'fonts/'
                            }
                        }
                    ]
                }
            ]
        },
        plugins: [
            new CleanWebpackPlugin(),
            new MiniCssExtractPlugin({
                filename: '../../style.css'
            }),
            new CopyWebpackPlugin({
                patterns: [
                    {
                        from: path.resolve('./src/fonts'),
                        to: path.resolve('./build/fonts'),
                        force: true
                    },
                    {
                        from: path.resolve('./src/img'),
                        to: path.resolve('./build/img'),
                        force: true
                    }
                ]
            }),
            new BrowserSyncPlugin({
                host: 'localhost',
                port: 3030,
                proxy: 'nicolas-lebrun.localhost',
                open: true
            }),
            new WebpackBar()
        ],

        devServer: {
            writeToDisk: true,
            contentBase: './build'
            //hot: true
        }
        //stats: 'minimal'
    }

    if (mode === 'development') {
        frontConfig.devtool = 'source-map'
        backConfig.devtool = 'source-map'
    }
    return [frontConfig, backConfig]
}
