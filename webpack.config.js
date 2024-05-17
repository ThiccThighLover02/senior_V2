const path = require('path');

module.exports = {
  entry: {
    calendar: "./src/calendar.js",
    createPost: "./src/createPost.js",
    formCheck: "./src/formCheck.js",
    getRequests: "./src/getRequests.js",
    getResponses: "./src/getResponses.js",
    getSeniors: "./src/getSeniors.js",
    requestInfo: "./src/requestInfo.js",
    seniorProfile: "./src/seniorProfile.js",
    serivce: "./src/service.js",
    signUp: "./src/signUp.js",
  },
  output: {
    filename: '[name].bundle.js',
    path: path.resolve(__dirname, 'htdocs')
  },
  devServer: {
    static: {
      directory: path.join(__dirname, 'htdocs'),
    },
    compress: true,
    port: 9000,
    hot: true, // Enable hot module replacement
    open: false, // Open the browser after server has been started
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader'
        }
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader']
      }
    ]
  },
  mode: 'development'
};
