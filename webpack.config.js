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
    path: path.resolve(__dirname, 'dist')
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
