
Page({

	data: {
		tiaojian: null
	},

  onLoad: function (options) {
    var instance = this;
    instance.loadtiaojian(options.id);
  },

	onReady: function() {},

  onShow: function (options) {
    //var instance = this;
    //instance.loadtiaojian(options.id);
	},

	onHide: function() {},

	onUnload: function() {},

	onReachBottom: function() {},

	onShareAppMessage: function() {},

  formSubmit: function (e) {
    //var value = e.detail.value;
    var formData = e.detail.value;
    console.log("参数", formData)
    var link = '/pages/xun/xun?t=' + formData.t + '&d=' + formData.d;
    wx.navigateTo({ url: link });
  },

  loadtiaojian: function(id) {
		var instance = this;
    var names = id;
    instance.setData({ type: names });
	}

});