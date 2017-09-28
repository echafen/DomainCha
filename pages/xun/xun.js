
Page({

	//data: {},

	onLoad: function(options) {
		wx.showLoading({
			title: 'Loading',
			mask: true
		});
		var instance = this;
		var dd = options.d;
    var tt = options.t;

    
		wx.request({
      url: 'https://api.mabida.com/doma/?t=' + tt + '&d=' + dd ,
			method: 'GET',
			success: function(res) {
				instance.setData({
          dd: dd,
          tt: tt,
          info: res.data.msg,
          list: res.data.list,
				});
				wx.hideLoading();
			}
		});
	},

	onReady: function() {},

	onShow: function() {},

	onHide: function() {},

	onUnload: function() {},

  onPullDownRefresh: function () {
    wx.showToast({
      title: 'loading...',
      icon: 'loading'
    })
    console.log('onPullDownRefresh', new Date())
  },
  stopPullDownRefresh: function () {
    wx.stopPullDownRefresh({
      complete: function (res) {
        wx.hideToast()
        console.log(res, new Date())
      }
    })
  },

	onReachBottom: function() {},

	onShareAppMessage: function() {}

});