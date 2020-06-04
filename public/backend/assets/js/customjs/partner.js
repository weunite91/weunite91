var Partner = function () {
    
    var PartnerList = function(){
       
        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#partner-datatable',
            'ajaxURL': baseurl + "user-ajaxAction",
            'ajaxAction': 'get-partner-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function () {
            PartnerList();
        },
       
    }
}();