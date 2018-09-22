var bootstrapCss = 'bootstrapmincss';
if (!document.getElementById(bootstrapCss))
{
    var head = document.getElementsByTagName('head')[0];
    var bootstrapWrapper = document.createElement('link');
    bootstrapWrapper.id = bootstrapCss;
    bootstrapWrapper.rel = 'stylesheet/less';
    bootstrapWrapper.type = 'text/css';
    bootstrapWrapper.href = '../wp-content/plugins/easycubes-app/admin/css/bootstrap-wrapper.less';
    bootstrapWrapper.media = 'all';
    head.appendChild(bootstrapWrapper);
	
    var lessjs = document.createElement('script');
    lessjs.type = 'text/javascript';
    lessjs.src = '../wp-content/plugins/easycubes-app/admin/js/less.min.js';
    head.appendChild(lessjs);

}