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

    var bootstrapWrapper = document.createElement('link');
    bootstrapWrapper.rel = 'stylesheet';
    bootstrapWrapper.type = 'text/css';
    bootstrapWrapper.href = 'http://cdn.datatables.net/v/dt/dt-1.10.18/af-2.3.2/sl-1.2.6/datatables.min.css';
    head.appendChild(bootstrapWrapper);
	
    var lessjs = document.createElement('script');
    lessjs.type = 'text/javascript';
    lessjs.src = '../wp-content/plugins/easycubes-app/admin/js/less.min.js';
    head.appendChild(lessjs);

    var lessjs = document.createElement('script');
    lessjs.type = 'text/javascript';
    lessjs.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js';
    head.appendChild(lessjs);

    var lessjs = document.createElement('script');
    lessjs.type = 'text/javascript';
    lessjs.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js';
    head.appendChild(lessjs);

    var lessjs = document.createElement('script');
    lessjs.type = 'text/javascript';
    lessjs.src = '../wp-content/plugins/easycubes-app/admin/js/bootstrap-typehead.min.js';
    head.appendChild(lessjs);

    var lessjs = document.createElement('script');
    lessjs.type = 'text/javascript';
    lessjs.src = 'http://cdn.datatables.net/v/dt/dt-1.10.18/af-2.3.2/sl-1.2.6/datatables.min.js';
    head.appendChild(lessjs);

}