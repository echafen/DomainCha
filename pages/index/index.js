
Page({

	data: {
		Chaxun: null
	},

	onLoad: function(options) {},

	onReady: function() {},

	onShow: function() {
		this.loadChaxun();
	},

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

	onShareAppMessage: function() {},

	loadChaxun: function() {
		var instance = this;
		wx.showLoading({
			title: '查询列表',
			mask: false
		});
		wx.request({
      url: 'https://api.mabida.com/doma/?t=x',
			method: 'GET',
			success: function(res) {
        instance.setData({ Chaxun: res.data.item});
			},
			fail: function() {
				wx.showModal({
					title: '请求超时',
					content: '网络不太好，或者服务端出现了故障',
					confirmText: '重新加载',
					cancelText: '取消',
					success: function(res) {
						if (res.confirm) {
							instance.loadChaxun();
						}
					}
				});
			},
			complete: function() {
				wx.hideLoading();
			}
		});
	}

});