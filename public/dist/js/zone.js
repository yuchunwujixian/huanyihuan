/**
 * -----------------------------------------
 * Desc:
 * User: Yuanchang.xu
 * Date: 2017/3/12
 * Time: 10:28
 * File:
 * Project: DoctorVisit
 * -----------------------------------------
 */

(function($,exports){
    var Zone = function () {
    };
    /**
     * 原型
     * @type {*}
     */
    Zone.fn = Zone.prototype;
   
    /**
     * @name address
     * @desc 省/直辖市 市 区/县 三级联动
     * @since 2017年3月12日
     * @return void
     */
    Zone.fn.address = function () {
        /**
         * @param $province 省下拉菜单
         * @param $city 市下拉菜单
         * @param $area 区/县下拉菜单
         */
        var $province,$city,$area,address;
        $province = $('#province');
        $city = $('#city');
        $area = $('#area');
        address = [];
        /**
         * @name cityHtml
         * @desc 更新市级的下拉菜单
         * @since 2017年3月12日
         * @return void
         */
        var cityHtml = function () {
            // 响应的数据
            var cities =arguments[0];
            // 改变二/三级下拉菜单的html
            $city.empty();
            $area.empty() && $area.append($('<option value="">请选择</option>'));
            // 生成二级联动菜单
            var str = '',i,len;
            str +='<option value="">请选择</option>';
            for ( i=0,len=cities.length; i<len; i++) {
                str += '<option data-index="'+cities[i].code+'" value="'+cities[i].name+'|'+cities[i].code+'">'+cities[i].name+'</option>';
            }
            $city.append(str);
        };

        /**
         * @name areaHtml
         * @desc 更新区/县级的下拉菜单
         * @since 2017年3月12日
         * @return void
         */
        var areaHtml = function () {
            // 响应的数据
            var areas =arguments[0];
            // 改变三级下拉菜单的html
            $area.empty();
            // 生成三级联动菜单
            var str = '',i,len;
            for ( i=0,len=areas.length; i<len; i++) {
                str += '<option data-index="'+areas[i].code+'" value="'+areas[i].name+'|'+areas[i].code+'">'+areas[i].name+'</option>';
            }
            $area.append(str);
        };
        // 省市联动事件
        $province.on('change',function () {
              var $id =  $('#province option:selected').attr('data-index');
              // 不存在id
              if(!$id) {
                  address = [];
                  $city.empty();
                  $city.append($('<option value="">请选择</option>'));

                  $area.empty();
                  $area.append($('<option value="">请选择</option>'));
                  return;
              }
              address[0] = $('#province option:selected').val();
            $('#address').val(address[0]);
            $.ajax({
                  url:'/admin/address/city/'+$id,
                  method:'get',
                  beforeSend:function () {
                      loadShow();
                  },
                  success:function (res) {
                      cityHtml(res);
                      loadFadeOut();
                  }
              });
          });
        // 市区联动事件
        $city.on('change',function () {
            var $id =  $('#city option:selected').attr('data-index');
            if(!$id) {
                address[1] = null;
                $area.empty();
                $area.append($('<option value="">请选择</option>'));
                return;
            }

            address[1] = $('#city option:selected').val();
            $('#address').val($('#address').val()+address[1]);
            $.ajax({
                url:'/admin/address/area/'+$id,
                method:'get',
                beforeSend:function () {
                    loadShow();
                },
                success:function (res) {
                    areaHtml(res);
                    loadFadeOut();
                }
            });
        });
        // 区下拉事件
        $area.on('change',function () {
            var val = $('#city option:selected').val();
            if(!val) {
                address[2] = null;
                return;
            }
            address[2] = $('#area option:selected').val();
            $('#address').val($('#address').val()+address[2]);
        });

    };
    
    exports.zone = new Zone();
})(jQuery,window);
